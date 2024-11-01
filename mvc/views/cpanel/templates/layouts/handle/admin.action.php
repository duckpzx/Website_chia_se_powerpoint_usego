<?php 
class Header extends App {
    public $actionAdmin;
    public $arrayUrl = [];

    public function __construct() {
        $this->actionAdmin = $this->getURL();
    }

    private function getURL() {
        return $this->urlProcess();
    }

    public function pathUrl() {
        $urlSegment = $this->getURL();
        return !empty($urlSegment[1]) ? $urlSegment[1] : 'index';
    }        
}

$action = new Header();
$actionUrlPath = $action->pathUrl();

$sidebarMenu = [
    [
        'href' => '/usego/admin/index',
        'icon' => 'fa-solid fa-house',
    ],
    [
        'href' => '/usego/admin/create_product',
        'icon' => 'fa-solid fa-plus',
    ],
];
