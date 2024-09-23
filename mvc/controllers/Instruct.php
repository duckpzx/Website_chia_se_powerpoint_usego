<?php 
    require_once ( dirname( __DIR__ ) ) . "/core/Shared/General.php";

    class Instruct extends General {
        private $access;
        public function __construct()
        {
            $this->access = new General;
        }

        public function index()
        {
            $this->instruct();
        }

        public function instruct()
        {
            $allPosts = $this->access->MyModelsCrud->getRaw(" SELECT 
            ug_users.firstName, 
            ug_users.lastName, 
            ug_new_feeds.*,
            CASE 
                WHEN ug_new_feeds.status IS NULL THEN 'Chờ đợi' 
                WHEN ug_new_feeds.status = 'PD' THEN 'Phê duyệt'
                WHEN ug_new_feeds.status = 'XN' THEN 'Xác nhận'
                WHEN ug_new_feeds.status = 'HT' THEN 'Hoàn tất'
                ELSE 'Trạng thái khác' 
            END AS status
            FROM 
                ug_new_feeds
            INNER JOIN 
                ug_users ON ug_users.id = ug_new_feeds.userId
            ORDER BY 
                ug_new_feeds.id DESC; ");

            $this->view('masterlayout', [
                'page' => 'users/instruct',
                'resources' => [
                    'title' => 'Usego - Chủ đề đặc biệt và thiết kế xuất sắc',
                    'css' => 'instruct',
                    'js' => 'instruct',
                ],
                // Database SQL Server ( My SQL ) - Data
                'dataSql' => [
                    'allPosts' => $allPosts
                ], 
            ]);
        }

        public function newpost() 
        {
            $userId = $this->access->accessUserId();
            $checkType = $this->access->MyModelsCrud->getRaw("SELECT ug_type FROM ug_users 
            WHERE id = '$userId'");

            $this->view('masterlayout', [
                'page' => 'users/newpost',
                'resources' => [
                    'title' => 'Usego - Tạo bài viết mới',
                    'css' => 'newpost',
                    'js' => [
                        'core/editor',
                        'views/newpost'
                    ],
                    'editor' => true
                ],
  
                'dataSql' => [
                    'checkType' => $checkType 
                ], 
            ]);
        }
        
        public function read() 
        {
            if (!empty( $this->access->accessGetUserId( 'id' )))
            {
                $userId = $this->access->accessUserId();
                $idPost = $this->access->accessGetUserId( 'id' );

                $dataRead = $this->access->MyModelsCrud->getRaw("SELECT ug_users.firstName, 
                ug_users.lastName, ug_new_feeds.* FROM ug_new_feeds
                INNER JOIN ug_users ON ug_users.id = ug_new_feeds.userId 
                WHERE ug_new_feeds.id = '$idPost'
                ORDER BY ug_new_feeds.id DESC ");

                if(empty( $dataRead ))
                {
                    require_once ("./mvc/errors/404.php");
                    exit(0);
                }

                $dataService = $this->access->MyModelsCrud->getRaw("SELECT * 
                FROM ug_service WHERE userId = '$userId' AND id_trade = '$idPost' ");

                $dataServiceOnwer = $this->access->MyModelsCrud->getRaw("SELECT * 
                FROM ug_service WHERE id_trade = '$idPost' AND status = 'XN' ");

                $dataStatus = $this->access->MyModelsOther->getRows("SELECT * 
                FROM ug_service WHERE id_trade = '$idPost' AND status = 'HT' ");

                $this->view('masterlayout', [
                    'page' => 'users/read',
                    'resources' => [
                        'title' => 'Usego - Các câu hỏi tổng hợp của người dùng',
                        'css' => 'read',
                        'js' => 'read'
                    ],
    
                    'dataSql' => [
                        'dataRead' => $dataRead,
                        'dataService' => $dataService,
                        'dataServiceOnwer' => $dataServiceOnwer,
                        'dataStatus' => $dataStatus
                    ], 
                ]);
            } 
            else {
                    header("Location: /usego/instruct");
            }
        }
    }
