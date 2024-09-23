<?php
    use Google\Service\Oauth2;

    require_once ( dirname ( dirname( dirname( __DIR__ ) ) ) ) . "/core/Shared/General.php";
    require_once ( dirname ( dirname ( dirname ( dirname ( __DIR__ ) ) ) ) ) . "/vendor/autoload.php";

Class GoogleLogin extends General {
    private $access, $session;
    private $data, $Client;

    private $error, $response;
    
    public function __construct() 
    {
        $this->access = new General;
        $this->session = new Session();
        $this->handleGoogleLogin();
        $this->access->sendJsonResponse( $this->response, $this->error );
    }

    private function handleFullName($fullName) 
    {
        $firstName = ""; $lastName = "";
        // Remove leading and trailing spaces
        $fullName = trim($fullName);

        // Split full name into parts
        $nameParts = explode(' ', $fullName);

        // Extract first and last name
        $firstName = $nameParts[0];
        $lastName = end($nameParts);

        return $firstName . ' ' . $lastName;
    }

    private function handleGoogleLogin() 
    {
        $client_id = _GOOGLE_APP_ID;
        $client_secret = _GOOGLE_APP_SECRET;
        $redirect_uri = _GOOGLE_APP_CALLBACK_URL;
    
        $client = new Google_Client();
        $this->Client = $client;

        $client->setClientId( $client_id );
        $client->setClientSecret( $client_secret );
        $client->setRedirectUri( $redirect_uri ); 
        $client->addScope('profile');
        $client->addScope('email');
    
        if ( isset ( $_GET ['code'] ) ) 
        {
            $token = $client->fetchAccessTokenWithAuthCode( $_GET ['code'] );
        } 
    
        if (! $client->isAccessTokenExpired() ) 
        {
            $gauth = new Google_Service_Oauth2( $client );
            $google_info = $gauth->userinfo->get(); 

            $email = $google_info->getEmail(); 
            $name = $google_info->getName();
            $avatarUrl = $google_info->getPicture(); 
    
            $pathName = explode(' ', $this->handleFullName( $name ) );
            $firstName = $pathName [0];
            $lastName = $pathName [1];

            if (!empty( $this->emailAlreadyExists( $email )))
            {
                $user = $this->emailAlreadyExists( $email );
                $login = new HandleDataLogind();
                $login->checkloginGoogle( $user['id'] );
            } 
            else {
                // PrePare data 
                $this->data = [
                    'email' => $email,
                    'firstName' => $firstName,
                    'lastName' => $lastName, 
                    'avatar' => $avatarUrl,
                    'createAt' => date('l, d m Y')
                ];

                $query = $this->access->MyModelsCrud->insert( "ug_users", $this->data );
                // Check result 
                if ( !$query ) 
                {
                    $this->error = _on_error;
                    $this->session::setFastData( "erorr_login_google", $this->error );
                    Request::Redirect('/usego/account/logind');
                } 
            }
        }
    }

    private function emailAlreadyExists( $email ) 
    {
        return $this->access->MyModelsOther->firstRaw(" SELECT id FROM ug_users 
        WHERE email = '$email' ");
    }

    public function getClient() 
    {
        return $this->Client;
    }
}

$google = new GoogleLogin();
$client = $google->getClient();