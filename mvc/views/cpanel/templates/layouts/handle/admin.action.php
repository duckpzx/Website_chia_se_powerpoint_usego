<?php 
    class Header extends App {
        public $actionAdmin, $arrayUrl = array();

        public function __construct() 
        {
            $this->getURL();
        }

        public function getURL() 
        {
            $this->actionAdmin = $this->urlProcess();
            return $this->actionAdmin;
        }

        public function pathUrl() 
        {
            $arrayUrl = $this->getURL();
        
            if (!empty($arrayUrl[1])) 
            {
                return $this->actionAdmin = $arrayUrl[1];
            } 
            return 'index';
        }        
    }
?>
<?php
    $action = new Header();
    $actionUrlPath = $action->pathUrl();
    // Get current web action

    $sidebarMenu = [
        [
            'href' => '/usego/admin/index',
            'icon' => 'fa-solid fa-house',
        ],
        // Login & register
        [
            'href' => '/usego/admin/create_product',
            'icon' => 'fa-solid fa-plus',
        ],
        //  Other...
    ];

