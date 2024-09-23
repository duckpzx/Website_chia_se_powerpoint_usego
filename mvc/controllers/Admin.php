<?php    
    $getActionParams = new App();
    $arrayCrumbs = $getActionParams->urlProcess();

    $param = 'statistics';  
    if (!empty($arrayCrumbs[1])) 
    {
        $param = $arrayCrumbs[1];
    }

    $admin = new Admin( $param );

    class Admin extends Controller {
        private $access;
        private $param;

        public function __construct( $param = 'statistics' ) 
        {
            $this->access = new General;
            
            $this->param = $param;
        }
        
        public function index() 
        {
            if ($this->checkPermissions() !== 1)
            {
                require_once ("./mvc/errors/404.php");
                exit(0);
            }

            $this->view('masterlayout', [
                'page' => 'admin/index',
                'resources' => [
                    'title' => 'Quản lý website - Chia sẻ powerpoint miễn phí',
                    'css' => '_index',
                    'js' => '_index',
                    '_lite' => $this->correlateResources( $this->param )
                ],
            ]);
        }
    
        public function correlateResources()
        {
            switch ( $this->param ) 
            {
                case 'statistics':
                    return 
                    [
                        '_css' => '_statistics',
                        '_js' => '_statistics'
                    ];

                case 'managefile':
                    require_once 'dashboard.php';
                break;

                case 'managephoto':
                    require_once 'dashboard.php';
                break;

                case 'requesttrade':
                    require_once 'dashboard.php';
                break;

                case 'fileservice':
                    require_once 'dashboard.php';
                break;

                case 'photoservice':
                    require_once 'dashboard.php';
                break;

                default: 
                    require_once 'dashboard.php';
                break;
            }
        }

        // SQL 
        public function checkPermissions(): mixed 
        {
            $userId = $this->access->accessUserId();
            return $this->access->MyModelsOther->getRows("SELECT * FROM ug_users 
            WHERE id = '$userId' AND ug_type = 1");
        }
    }
