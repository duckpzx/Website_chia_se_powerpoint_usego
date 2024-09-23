<?php 
    require_once ( dirname( __DIR__ ) ) . "/core/Shared/General.php";

    class Search extends General {
        private $access;
        public function __construct()
        {
            $this->access = new General;
        }

        public function index()
        {
            
            $this->view('masterlayout', [
                'page' => 'users/search',
                'resources' => [
                    'title' => 'Usego - Tìm kiếm các mẫu thuyết trình',
                    'css' => 'search',
                    'js' => 'search',
                ],
                'dataSql' => [

                ], 
            ]);
        }
    }
