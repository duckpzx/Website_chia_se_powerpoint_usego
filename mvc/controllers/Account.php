<?php 
    class Account extends Controller {

        public function index() 
        {
            $this->logind();
        }

        public function logind()
        {
            $this->view('accountlayout', [
                'page' => 'account/logind',
                'resources' => [
                    'title' => 'Đăng nhập UseGo | Website Share Free PowerPoint',
                    'css' => 'register&login',
                    'js' => 'logind'
                ]
            ]);
        }

        public function register()
        {
            $this->view('accountlayout', [
                'page' => 'account/register',
                'resources' => [
                    'title' => 'Đăng kí Usego | Website Share Free PowerPoint',
                    'css' => 'register&login',
                    'js' => 'register'
                ]
            ]);
        }

        public function google()
        {
            $this->view('accountlayout', [
                'page' => 'account/google',
                'resources' => [
                    'title' => 'Đăng nhập Google Usego | Trải nghiệm ngay ',
                    'css' => '',
                    'js' => ''
                ]
            ]);
        }
        
        public function facebook()
        {
            $this->view('accountlayout', [
                'page' => 'account/facebook',
                'resources' => [
                    'title' => 'Đăng nhập Facebook Usego | Trải nghiệm ngay ',
                    'css' => '',
                    'js' => ''
                ]
            ]);
        }

        public function logout()
        {
            $this->view('accountlayout', [
                'page' => 'account/logout',
                'resources' => [
                    'title' => 'Đăng xuất | Usego !',
                    'css' => 'logout',
                    'js' => 'logout'
                ]
            ]);
        }
    }
