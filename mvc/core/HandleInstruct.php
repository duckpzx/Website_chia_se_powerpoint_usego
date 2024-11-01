<?php
    require_once (__DIR__  . "/Shared/General.php"); 
    require_once (__DIR__  . "/Request.php");

class HandleInstruct extends General {
    private $userId;
    private $data;
    
    public $error, $response;
    private $access;


    public function __construct()
    {
        $this->access = new General;
        $this->userId = $this->access->accessUserId();
    }
 
    // New Feeds 
    public function newFeeds() 
    {
        if ($this->access->attributeEmpty(['title', 'content', 'images'])) 
        {
            $hot = ""; $topic = ""; $tokenTrade = "";

            $userId = $this->access->accessUserId();
            $hot = $_POST['hot'];
            $topic = $_POST['topic']; 
            $title = $_POST['title'];
            $contentBase64 = $_POST['content'];
            $content = urldecode(base64_decode($contentBase64));
            $images = $_POST['images'];

            if ($images === "") {
                if ( $topic === 'service' ) {
                    $images = _TEMPLATE . 'images/posts/service_common_mid.png';
                }
                else {
                    $images = _TEMPLATE . 'images/posts/post_common_mid.png';
                }
            } 

            if ( $topic === 'service' ) {
                $tokenTradePrepare = $this->access->generateCode('UGO') . $userId;
                $tokenTrade = strtoupper($tokenTradePrepare);
            }
            
            $data = [
                'userId' => $this->access->accessUserId(),
                'topic' => $topic,
                'hot' => $hot,
                'title' => $title,
                'content' => $content,
                'images' => $images,
                'token_trade' => $tokenTrade,
                'createAt' => date('Y-m-d H:i:s')
            ];

            $query = $this->access->MyModelsCrud->insert('ug_new_feeds', $data);

            if ($query) 
                $this->response = 'Đăng tải bài viết thành công';
            else 
                $this->error = 'Xảy ra lỗi, thử lại sau!';
        }
    }

    public function uploadImagePost() 
    {
        if( $this->access->attributeEmpty( [ 'class', 'file' ] ) )
        {
            $Fast = new HandleDataUpload();
            $url = $Fast->updateImages('file', 'post', 'image', null, false);
            $url = _TEMPLATE . 'images/uploads/post/' . $url;
            $this->response = $url;
        }
    }

    public function sendService()
    {
        if ($this->access->attributeEmpty(['id_trade', 'id_onwser', 'money'])) 
        {
            $idTrade = $_POST['id_trade'];
            $idOnwser = $_POST['id_onwser'];
            $money = $_POST['money'];
            $userId = $this->access->accessUserId();

            $check = $this->access->MyModelsOther->getRows("
            SELECT * 
            FROM 
                ug_service
            WHERE 
                userId = '$userId' AND id_trade = '$idTrade'");

            if ( !empty( $check ) ) 
            {
                $this->error = 'Lỗi, bạn đã gửi yêu cầu trước đó rồi!'; 
                return false;
            } 

            $data = [
                'id_trade' => $idTrade,
                'userId' => $userId,
                'id_onwser' => $idOnwser,
                'money_agrees' => $money,
                'status' => 'PD',
                'createAt' => date('Y-m-d H:i:s')
            ];

            $query = $this->access->MyModelsCrud->insert("ug_service", $data);
            if ( $query )
                $this->updateStatusPost('PD', $idTrade);
            else 
                $this->error = 'Lỗi xảy ra, không thể thực hiện!';
        }
    }

    public function getDataTrade()
    {
        if ( $this->access->attributeEmpty( ['id_post', 'id_service'] ) )
        {
            $idService = $_POST['id_service'];
            $idPost = $_POST['id_post'];
            
            $this->updateStatusPost('XN',  $idPost);
            $this->response = $this->access->MyModelsCrud->getRaw("
            SELECT *
            FROM 
                ug_service
            WHERE 
                id = '$idService'
            ");
        }
    }

    public function acceptService() 
    {
        if ( $this->access->attributeEmpty( ['id'] ) )
        {
            $idService = $_POST['id'];
    
            $this->updateStatusService('XN', $idService);
            $query = $this->updateStatusPost('XN', $idService);
            if ( $query ) $this->response = 'Thực hiện thành công';
        }
    }

    public function satisfied() 
    {
        if ( $this->access->attributeEmpty(['id']) )
        {
            $idService = $_POST['id'];
            $idPost = $this->getIdPost( $idService );

            $this->updateStatusPost('HT', $idService);
            $query = $this->updateStatusService('HT', $idPost);
            if ( $query )
            $this->response = $this->access->MyModelsCrud->getRaw("
            SELECT *
            FROM 
                ug_service
            WHERE 
                id = '$idService'
            ");
        }
    }

    public function notSatisfied()
    {
        if ( $this->access->attributeEmpty(['id']) )
        {
            $idService = $_POST['id'];
            $idPost = $this->getIdPost( $idService );

            $this->data = [
                'status' => 'TB',
            ];
            
            $query = $this->updateStatusService('TB', $idPost);
            if ( $query )
            $this->response = 'Đã gửi yêu cầu, chờ kiểm duyệt!';
        }
    }

    public function displayMode() 
    {
        if ( $this->access->attributeEmpty(['id']) )
        {
            $idPost = $_POST['id'];
         
            $result = $this->access->MyModelsCrud->getRaw("
            SELECT 
                hide
            FROM 
                ug_new_feeds
            WHERE 
                id = '$idPost'");

            $hide = ( $result[0]['hide'] === 'true' ) ? 'false' : 'true';
            $this->data = [
                'hide' => $hide,
            ];
            
            $query = $this->access->MyModelsCrud->update('ug_new_feeds', $this->data, "id = '$idPost'");
            if ( $query )
            $this->response = 'Cập nhật thành công!';
        }
    }

    public function getIdPost( $idPost )
    {
        return $this->access->MyModelsCrud->getRaw("
        SELECT 
            id 
        FROM 
            ug_service
        WHERE 
            id_trade = '$idPost'")[0]['id'];
    }

    public function updateStatusService( $status, $id ) 
    {
        $this->data = [
            'status' => $status
        ];

        return $this->access->MyModelsCrud->update('ug_service', $this->data, "id = '$id'");
    }

    public function updateStatusPost( $status, $id ) 
    {
        $this->data = [
            'status' => $status
        ];

        return $this->access->MyModelsCrud->update('ug_new_feeds', $this->data, "id = '$id'");
    }
}

class definesInstructAction extends General {
    private $handle; 
    private $method;
    private $access;

    public function __construct() 
    {
        $this->access = new General;
        $this->handle = new HandleInstruct();
        $this->performDetermination();
    }

    public function performDetermination()
    {
        if ( $this->access->attributeEmpty( ['class'] ) )
        { 
            $this->method = $_POST['class'];

            switch ( $this->method )
            {
                case 'GetDataTrade':
                    $this->handle->getDataTrade();
                    break;

                case 'AcceptService':
                    $this->handle->acceptService();
                    break;

                case 'Satisfied':
                    $this->handle->satisfied();
                    break;

                case 'NotSatisfied':
                    $this->handle->notSatisfied();
                    break;

                case 'NewFeeds':
                    $this->handle->newFeeds();
                    break;

                case 'UploadImageNewFeeds':
                    $this->handle->uploadImagePost();
                    break;

                case 'SendService':
                    $this->handle->sendService();
                    break;  

                case 'DisplayMode':
                    $this->handle->displayMode();
                    break;  
            }

            $this->access->sendJsonResponse($this->handle->response, $this->handle->error);
        }
    }
}

$handle = new definesInstructAction();