<?php
// Config path to link 
define('HD_Home', 'home');
define('HD_Topic', 'powerpoint');
define('HD_Talk', 'talk');
define('HD_Instruct', 'instruct');
define('HD_Contact', 'contact');
define('HD_Admin', 'admin');

class Active {
    public $page = 'home';
    public $arrayPage, $pageController;

    public function __construct()
    {
        if (!empty($_GET['url'])) 
        {
            $this->pageController = trim($_GET['url'], '/');
            $this->arrayPage = $this->pageController;
        } else 
        {
            $this->arrayPage = $this->page;
        }
        $this->setActive();
    }

    public function setActive() 
    {
        $arrayPathPage = explode('/', $this->arrayPage);
        return $arrayPathPage[0];
    }   
}

$active = new Active();
?>
