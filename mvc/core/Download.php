<?php 
    require_once (__DIR__  . "/Shared/General.php"); 
    require_once (__DIR__  . "/Request.php");

class Download extends Controller {
    private $idPost, $userId, $file;
    private $data;
    
    public $error, $response;
    private $access;
  
    public function __construct()
    {
        $this->access = new General;
        $this->userId = $this->access->accessUserId();
    }

    public function actionDownload() 
    {
        if ( !empty( $_POST['id'] ) && !empty ( $_POST['file'] ) ) 
        {
            $this->idPost = $_POST['id'];
            $this->file = basename( $_POST['file'] );
            $filePath = _WEB_PATH_UPLOADS . 'powerpoint/' . $this->file;
        
            if (file_exists( $filePath )) {
                // Read data from file and encode into base64
                $base64Data = base64_encode( file_get_contents( $filePath ) );    

                // Save your downloads
                $this->savePostHistory();

                $this->response = [ 'base64Data' => $base64Data ];
            } else {
                $this->error =  'Tệp không tồn tại.';
            }
        } else {
            $this->error =  'Tải xuống thất bại, thử lại.';
        }
    }

    // save the article to your download history 
    private function savePostHistory() 
    {
        if(!empty( $this->userId )) 
        {
            $this->data = [
                'userId' => $this->userId,
                'idPost' => $this->idPost,
                'createAt' => date('Y-m-d H:i:s')
            ];

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $this->access->MyModelsCrud->insert('ug_archive', $this->data);
        }
    }

}

class definesDownloadAction extends General {
    private $handle; 
    private $method;
    private $access;

    public function __construct() 
    {
        $this->access = new General;
        $this->handle = new Download();
        $this->performDetermination();
    }

    public function performDetermination()
    {
        if ( $this->access->attributeEmpty( ['class'] ) )
        { 
            $this->method = $_POST['class'];

            switch ( $this->method )
            {
                case 'download':
                    $this->handle->actionDownload();
                    $this->access->sendJsonResponse( $this->handle->response, $this->handle->error );
                    break;
            }
        }
    }
}

$handle = new definesDownloadAction();