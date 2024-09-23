<?php 
    require_once ( dirname( __DIR__ ) ) . "/core/Shared/General.php";
    
    class Contact extends General {
        
        private $access;

        public function __construct()
        {
            $this->access = new General;
        }

        public function index()
        {
            $this->contact();
        }

        public function contact()
        {   
            $this->view('masterlayout', [
                'page' => 'users/contact',
                'resources' => [
                    'title' => 'Usego - Chủ đề đặc biệt và thiết kế xuất sắc',
                    'css' => 'contact',
                    'js' => 'contact',
                ],
                // Database SQL Server ( My SQL ) - Data
                'dataSql' => [
         
                ], 
            ]);
        }
    }
?>