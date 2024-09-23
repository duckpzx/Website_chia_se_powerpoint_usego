<?php 
require_once (__DIR__ . "/Session.php");
require_once (__DIR__ . "/Request.php");

class HandleDataLogind extends General {
    private $access; 
    private $email, $password, $passwordDb, $userId, $tokenLogin; 
    private $method, $data;
    public $response, $error;

    public function __construct() 
    {
        $this->access = new General;
        $this->access->MyModelsCrud = $this->models('MyModelsCrud');
        $request = new Request();

        if ( Request::isPost() ) 
        {
            if (!empty( $_POST['class'] )) 
            {
                $this->method = $request->getBody()['class'];
            
                if ( $this->method === 'checklogin' )
                {
                    $this->checklogin();
                }
            }
        }
    }

    public function checklogin() 
    {
        $encryptedPassword = base64_decode( $_POST['password'] );
        // decryption password

        $this->email = $_POST['email'];
        $this->password = $encryptedPassword;

        $user = $this->getUserByEmail();

        if ( !empty( $user )) 
        {
            $this->passwordDb = $user['password'];
            $this->userId = $user['id'];
            
            if( password_verify( $this->password, $this->passwordDb )) 
            {
                $this->tokenLogin = sha1(uniqid() . time());
                $this->data = [
                    'userId' => $this->userId,
                    'tokenLogin' => $this->tokenLogin,
                ];              

                // token existence
                $tokenExists = $this->tokenUserAlreadyExists( $this->userId );

                // If it already exists, it will update the new token to the logged in user
                (!empty( $tokenExists )) ? $this->updateNewData( $this->userId, $this->tokenLogin ) : $this->addNewData( $this->tokenLogin );

                $this->checkFirstLogin();
                // Login success 
                $this->response = 'Đăng nhập thành công';
            } 
            else {
                $this->error = 'Mật khẩu không đúng!';
            }

        } 
        else {
            $this->error = 'Không tìm thấy email';
        }
        $this->access->sendJsonResponse( $this->response, $this->error );
    }

    public function checkloginGoogle( $userId ) 
    {
        $tokenLogin = sha1(uniqid() . time());
        $this->data = [
            'userId' => $userId,
            'tokenLogin' => $tokenLogin,
        ]; 
        // Token existence
        $tokenExists = $this->tokenUserAlreadyExists( $userId );
        // If it already exists, it will update the new token to the logged in user
        (!empty( $tokenExists )) ? $this->updateNewData( $userId, $tokenLogin ) : $this->addNewData( $tokenLogin );
        Request::Redirect('/usego');
    }

    public function checkFirstLogin() 
    {
        $status = $this->getStatusFirstLogin();
        if ( $status ['firstLogin'] == 'true' ) 
        {
            $this->sendFirtLogin();
            $this->updateStatusFirstLogin();
        }
    }

    private function getUserByEmail()
    {
        return $this->access->MyModelsOther->firstRaw("SELECT id, password FROM ug_users 
        WHERE email = '$this->email' AND status = 1");
    }

    private function tokenUserAlreadyExists( $userId )
    {
        return $this->access->MyModelsOther->firstRaw("SELECT id FROM ug_login_token
        WHERE userId = '$userId'");
    }

    private function updateNewData( $userId, $token )
    {
        $this->access->MyModelsCrud->update('ug_login_token', $this->data, "userId = '$userId'");
        $this->createSessionLogin( $token );
    } 

    private function addNewData( $token ) 
    {
        $this->access->MyModelsCrud->insert('ug_login_token', $this->data);
        $this->createSessionLogin( $token );
    }

    private function createSessionLogin( $token )
    {
        Session::setSession('login_token_usego_userid', $token);
    }

    // Check first Login 
    private function getStatusFirstLogin() 
    {
        return $this->access->MyModelsOther->firstRaw("SELECT firstLogin FROM ug_users WHERE id = '$this->userId'");
    }  

    private function updateStatusFirstLogin() 
    {
        $this->data = [
            'firstLogin' => 'false',
        ];
        $this->access->MyModelsCrud->update('ug_users', $this->data, "id = '$this->userId'");
    }

    // if firstlogin = true send data index
    private function sendFirtLogin() 
    {
        Session::setSession('first_login_usego_userid', 'true');
    }
}

$handle = new HandleDataLogind();

