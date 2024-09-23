<?php 
class Download extends Controller {
    private $method, $data, $error;
    private $MyModelsCrud;
    private $userId, $idPost, $file;
    public $response = [];
    public function __construct()
    {
        $this->MyModelsCrud = $this->models('MyModelsCrud');
        $this->authenticAction();
    }
    
    private static function statusLogin() {
        $check = new isLogin();
        return $check->checkLogin();
        // Output Id user Login 
    }

    public function sendJsonResponse()
    {
        if (!empty( $this->response) || !empty( $this->error )) 
        {
            header('Content-Type: application/json');
            $properties = ( !empty( $this->error ) ) ? 'error' : 'data';
            $response = ( !empty( $this->error ) ) ? $this->error : $this->response;
            // Action response client 
            echo json_encode( [ $properties => $response ], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }

    public function authenticAction()
    {
        if (!empty( $_POST['class'] ))
        {
            $this->method = $_POST['class'];
            switch ( $this->method )
            {
                case 'download':
                    $this->actionDownload();
                    $this->sendJsonResponse();
                    break;

                default: break;
            }
        }
    } 

    private function actionDownload() 
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

                $this->response = array( 'base64Data' => $base64Data );
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
        if(!empty( Download::statusLogin()['userId'] )) 
        {
            $this->userId = Download::statusLogin()['userId'];
        
            $this->data = [
                'userId' => $this->userId,
                'idPost' => $this->idPost,
                'createAt' => date('Y-m-d H:i:s')
            ];

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $this->MyModelsCrud->insert('ug_archive', $this->data);
        }
    }

}

$handle = new Download();
