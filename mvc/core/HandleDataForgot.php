<?php 
require_once ( __DIR__ . "/Sendemail.php");
require_once ( __DIR__ . "/Request.php");

class HandleDataForgot extends General {
    private $emailForgot, $token, $forgot_token, $password;
    private $data;
    private $access;
    public $error, $response;

    public function __construct()
    {
        $this->access = new General;
    }

    // Check email exists
    public function checkemailexists() 
    {
        $this->emailForgot = $_POST['emailForgot'];

        $query = $this->emailExists();
        if($query != 1)
        {
            $this->error = 'Không tìm thấy email';
        }
    }

    public function sendactivetoken()
    {
        $path =  _ROOT_URL . 'mvc/core/content/ForgotPassword.html';
        // Path to the content file
        $urlHandle = $_POST['url'] . '?token=' . $_POST['token'];
        $contentMessage = file_get_contents($path);
        $contentMessage = str_replace("{{forgot_token}}", $_POST['forgot_token'], $contentMessage);
        $contentMessage = str_replace("{{urlHandle}}", $urlHandle, $contentMessage);
        $toEmail = $_POST["emailForgot"];
        $subject = $_POST['forgot_token'] . ' Là mã khôi phục tài khoản của bạn';
        mailerSend($toEmail, $subject, $contentMessage);
    }

    public function savedforgot() 
    {
        $this->emailForgot = $_POST['emailForgot'];
        $this->token = $_POST['token'];
        $this->forgot_token = $_POST['forgot_token'];
        
        $this->data = [
            'token' => $this->token,
            'forgotToken' => $this->forgot_token
        ];

        // Save token and token_forgot data to the database
        $this->savedDataForgot();
    }

    public function checkforgottoken() 
    {
        $this->emailForgot = $_POST['emailForgot'];
        $this->forgot_token = $_POST['forgot_token'];
        // Check the correctness of the otp code entered by the user
        $query = $this->correctnessOfOtp();
    
        if( $query < 1 )
        {
            $this->error = 'Mã xác thực không chính xác';
        } 
    }

    public function updatepassword() 
    { 
        $encryptedPassword = base64_decode($_POST['passwordForgot']);
        // Decryption password
        $this->emailForgot = $_POST['emailForgot'];
        $this->password = password_hash($encryptedPassword, PASSWORD_DEFAULT);
        $this->forgot_token = null;
        $this->token = null;

        $this->data = [
            'password' => $this->password,
            'forgotToken' => $this->forgot_token,
            'token' => $this->token
        ];

        // Update new password database 
        $this->updateNewPassword();
    }

    private function emailExists() 
    {
        return $this->access->MyModelsOther->getRows("SELECT id FROM ug_users WHERE email = '$this->emailForgot' LIMIT 1");
    }

    private function savedDataForgot() 
    {
        $this->access->MyModelsCrud->update('ug_users', $this->data,  "email = '$this->emailForgot'");
    }

    private function correctnessOfOtp()
    {
        return $this->access->MyModelsOther->getRows("SELECT id FROM ug_users 
        WHERE email = '$this->emailForgot' AND forgotToken = '$this->forgot_token'");
    }

    private function updateNewPassword()
    {
        $this->access->MyModelsCrud->update('ug_users', $this->data,  "email = '$this->emailForgot'");
    }
}

class actionsTaken extends General {
    private $handle; 
    private $method;
    private $access;

    public function __construct() 
    {
        $this->access = new General;
        $this->handle = new HandleDataForgot();
        $this->performDetermination();
    }

    public function performDetermination()
    {
        if ( $this->access->attributeEmpty( ['class'] ) )
        {
            $this->method = $_POST['class'];
            
            switch ($this->method)
            {
                case 'checkemailexists':
                    $this->handle->checkemailexists(); 
                    break;
                
                case 'sendactivetoken':
                    $this->handle->sendactivetoken();
                    break;
    
                case 'savedforgot':
                    $this->handle->savedforgot();
                    break;
            
                case 'checkforgottoken':
                    $this->handle->checkforgottoken();
                    break;
    
                case 'updatepassword':
                    $this->handle->updatepassword();
                    break;
            }

            $this->access->sendJsonResponse( $this->handle->response, $this->handle->error );
        } 
    }
}

$handle = new actionsTaken();
