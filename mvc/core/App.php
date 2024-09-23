<?php 
    $currentDir = __DIR__;
    $coreDir = dirname(dirname($currentDir));
    // PHP Mailler
    require_once( $coreDir ."/mvc/views/cpanel/templates/libary/phpmailer/vendor/autoload.php");
    // Check and load Routes.php if exists
    require_once( $coreDir ."/mvc/configs/Routes.php");
    // Check traffic and load Router.php if exists
    require_once( $coreDir ."/mvc/configs/Router.php");
    require_once( $coreDir ."/mvc/core/Controller.php");

    class App {
        private $controller = 'home';
        private $action = 'index';
        private $params = [];

        public function __construct()
        {
            $arrayUrl = $this->urlProcess();
            // Check exist value
            if($arrayUrl != NULL) 
            {
                if(file_exists("./mvc/controllers/". ucfirst($arrayUrl[0]) .".php"))
                {
                    $this->controller = $arrayUrl[0];
                    unset($arrayUrl[0]);
                    // If exists ArrayUrl[0] Assign this->controller
                } else {
                    require_once ("./mvc/errors/404.php");
                    exit(0);
                }
            }            

            if(file_exists("./mvc/controllers/". $this->controller .".php"))
            {
                require_once ("./mvc/controllers/". $this->controller .".php");
            } else {
                require_once ("./mvc/errors/404.php");
                exit(0);
            }

            $this->controller = new $this->controller;

            if(isset($arrayUrl[1])) 
            {
                // Check exist acction 
                if(method_exists($this->controller, $arrayUrl[1]))
                {
                    $this->action = $arrayUrl[1];
                    unset($arrayUrl[1]);
                } 
            }
            
            if(!empty($this->params))
            {
                $this->params = $arrayUrl ? array_values($this->params) : array();
            } 
                $this->params = call_user_func_array([$this->controller, $this->action], $this->params);
        }
        

        public function urlProcess() 
        {
            if(isset($_GET['url']))
            {
                return explode("/", filter_var(trim($_GET['url'], '/')));
            }
        }
    }
