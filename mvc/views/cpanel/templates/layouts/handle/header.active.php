<?php
// Config path to link 
define('HD_Home', 'home');
define('HD_Topic', 'powerpoint');
define('HD_Talk', 'talk');
define('HD_Instruct', 'instruct');
define('HD_Contact', 'contact');
define('HD_Admin', 'admin');

class Active {
    private $page = 'home';
    private $pageController;

    public function __construct() {
        $this->pageController = !empty($_GET['url']) ? trim($_GET['url'], '/') : $this->page;
    }

    public function setActive() {
        $arrayPathPage = explode('/', $this->pageController);
        return $arrayPathPage[0];
    }
}

$active = new Active();
