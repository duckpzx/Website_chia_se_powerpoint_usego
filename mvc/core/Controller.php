<?php 
require_once ( __DIR__ . "/Session.php");
require_once ( __DIR__ . "/../models/MyModelsCrud.php");
require_once ( __DIR__ . "/../models/MyModelsOther.php");
require_once __DIR__  . "/Shared/General.php";

class Controller {
    private static $loadedModels = [];

    public function view( $view, $data = [] )
    {
        if (file_exists("./mvc/views/cpanel/" . $view . ".php")) {
            require_once ("./mvc/views/cpanel/" . $view . ".php");
        }
    }

    public function models( $models )
    {
        if (!isset(self::$loadedModels[ $models ])) {
            if (file_exists(__DIR__  . "/../models/" . $models . ".php")) {
                require_once (__DIR__  . "/../models/" . $models . ".php");
                self::$loadedModels[$models] = new $models;
            } 
        }
        
        return self::$loadedModels[ $models ];
    } 

    // Load resources of views
    public function resources( $layoutName, $dataUsego = [] )
    {
        if (file_exists("./mvc/views/cpanel/templates/" . $layoutName . ".php")) {
            require_once "./mvc/views/cpanel/templates/" . $layoutName . ".php";
        }
    }

    public function pagination( $layoutName, $typePagination ) 
    {
        if (file_exists("./mvc/views/cpanel/users/core/" . $layoutName . ".php")) {
            require_once "./mvc/views/cpanel/users/core/" . $layoutName . ".php";
        } 
    }

    public function comment( $layoutName ) 
    {
        if (file_exists("./mvc/views/cpanel/users/core/" . $layoutName . ".php")) {
            require_once "./mvc/views/cpanel/users/core/" . $layoutName . ".php";
        } 
    }
}

class isLogin extends General {
    private $access;
    public function __construct()
    {
        $this->access = new General;
    }

    public static function checkLogin()
    {
        $checkLogin = false;
        if ( Session::getSession('login_token_usego_userid') ) 
        {
            $tokenLogin = Session::getSession('login_token_usego_userid');
            $isLoginInstance = new self(); 
            $query = $isLoginInstance->checkLoginToken( $tokenLogin );
            if (!empty( $query )) 
            {
                $checkLogin = $query;
            } 
            else {
                Session::removeSession('login_token_usego_userid');
            }
        }
        return $checkLogin;
    }

    private function checkLoginToken( $tokenLogin ) 
    {
        $query = $this->access->MyModelsOther->firstRaw("SELECT userId FROM ug_login_token 
        WHERE tokenLogin = '$tokenLogin'");
        return $query;
    }
}
