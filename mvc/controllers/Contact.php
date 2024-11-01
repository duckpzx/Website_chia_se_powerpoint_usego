<?php 
require_once(dirname(__DIR__)) . "/core/Shared/General.php";

class Contact extends General {
    private $access;

    public function __construct() {
        $this->access = new General;
    }

    public function index() {
        $this->renderContactPage();
    }

    private function renderContactPage() {   
        $this->view('masterlayout', [
            'page' => 'users/contact',
            'resources' => $this->getResources(),
            'dataSql' => [] 
        ]);
    }

    private function getResources() {
        return [
            'title' => 'Usego - Chủ đề đặc biệt và thiết kế xuất sắc',
            'css' => 'contact',
            'js' => 'contact',
        ];
    }
}

