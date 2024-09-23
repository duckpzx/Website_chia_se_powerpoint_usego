<?php 
    require_once ( dirname( __DIR__ ) ) . "/core/Shared/General.php";

    class Profile extends General {
        private $access, $dataAvatars;
        public function __construct()
        {
            $this->access = new General;
        }

        public function index() 
        {
            $this->profile();
        }
        
        public function profile() 
        {
            $userId = $this->access->accessUserId();
            $dataInfoUser = (!empty( $this->getDataUser() )) ? $this->getDataUser() : [];
            $dataPowerpoints = (!empty( $this->getDataHashPosted( $userId ) )) ? $this->getDataHashPosted( $userId ) : [];
            $dataCheckFollow = (!empty( $this->checkFollower() )) ? $this->checkFollower() : [];
            if(empty(array_filter($dataInfoUser)))
            {
                require_once ("./mvc/errors/404.php");
                exit(0);
            }
            
            $this->view('masterlayout', [
                'page' => 'users/profile', 
                'resources' => [
                    'title' => 'Usego Chia sẽ các mẫu thiết kế - PowerPoint Miễn Phí',
                    'css' => 'profile',
                    'js' => [
                        'views/profile',
                        'views/profile-ppt',
                        'core/follow'
                    ],
                    'jszip' => true
                ],

                'dataSql' => [
                    'dataUser' => $dataInfoUser,
                    'dataAvatars' => $this->dataAvatars,
                    'dataPowerpoints' => $dataPowerpoints,
                    'dataCheckFollow' => $dataCheckFollow
                ] 
            ]);
        }

        public function archive() 
        {
            $dataArchive = !empty( $this->getDataArchive() ) ? $this->getDataArchive() : '';

            $this->view('masterlayout', [
                'page' => 'users/archive',
                'resources' => [
                    'title' => 'Usego - Danh sách các file tải xuống powerpoint',
                    'css' => 'archive',
                    'js' => 'archive',
                ],

                'dataSql' => [
                    'dataArchive' => $dataArchive
                ], 
            ]);
        }

        public function action() 
        {
            if(!empty( $this->access->accessGetUserId( 'id' ) ))
            {
                $dataAction = !empty( $this->getDataAction() ) ? $this->getDataAction() : '';
                $userId = $this->access->accessUserId();
                
                if ( !empty( $dataAction[0]['id_onwser'] ) )
                if( $userId !== $dataAction[0]['id_onwser'] )
                { 
                    require_once ("./mvc/errors/404.php");
                }
            }

            $this->view('masterlayout', [
                'page' => 'users/action',
                'resources' => [
                    'title' => 'Usego - Danh sách các file tải xuống powerpoint',
                    'css' => 'action',
                    'js' => 'action',
                ],

                'dataSql' => [
                    'dataAction' => $dataAction
                ], 
            ]);
        }

        private function getDataUser()
        {
            if (!empty( $this->access->accessGetUserId( 'id' ) ))
            {
                $getId = $this->access->accessGetUserId( 'id' );
                return $this->access->MyModelsCrud->getRaw(" SELECT ug_users.id, ug_users.firstName, 
                ug_users.lastName, ug_users.email,
                ug_users.avatar, ug_users.describes,
                ug_users.ug_type,
                (SELECT COUNT(*) FROM ug_follow WHERE ug_follow.id_onswer = '$getId') as total_follow
                FROM ug_users 
                WHERE id = '$getId' ");
            }
        }

        private function getAvatarHistory($userId) 
        {
            $currentAvatar =
            $this->access->MyModelsCrud->getRaw("SELECT avatar FROM ug_users WHERE id = $userId");

            $currentAvatarImage = implode('', $currentAvatar[0]);

            return $this->access->MyModelsCrud->getRaw(" SELECT avatar FROM ug_save_old_avatars 
                WHERE userId = $userId AND avatar != '$currentAvatarImage'
                ORDER BY id ASC LIMIT 0, 3 ");
        }

        private function getDataHashPosted( $userId ) 
        {
            if(!empty( $this->access->accessGetUserId( 'id' ) ))
            {
                $getId = $this->access->accessGetUserId( 'id' );
                
                if( $userId == $getId )
                { 
                    $this->dataAvatars = $this->getAvatarHistory( $userId );
                }

                return $this->access->MyModelsCrud->getRaw(" SELECT ug_power_point.*,
                (SELECT COUNT(*) FROM ug_power_point WHERE userId = '$getId') as total_topics,
                (SELECT COUNT(*) FROM ug_like_post WHERE ug_like_post.id_onwser = ug_power_point.id) as total_likes
                FROM ug_power_point
                WHERE ug_power_point.userId = '$getId' 
                ORDER BY ug_power_point.id DESC; ");
            }
        }

        private function getIdPostArchive() 
        {
            $userId = $this->access->accessUserId();
            // Get data from downloaded articles
            return $this->access->MyModelsCrud->getRaw(" SELECT * FROM ug_archive 
            WHERE userId = '$userId' ORDER BY id DESC ");
        }

        private function getDataArchive()
        {
            $userId = $this->access->accessUserId();
    
            return $this->access->MyModelsCrud->getRaw("SELECT ug_power_point.*, 
            latest_archive.maxCreateAt AS timeAt
            FROM ug_power_point
            INNER JOIN (
                SELECT idPost, MAX(createAt) AS maxCreateAt
                FROM ug_archive
                WHERE userId = '$userId'
                GROUP BY idPost
            ) AS latest_archive
            ON ug_power_point.id = latest_archive.idPost
            ORDER BY latest_archive.maxCreateAt DESC; ");
        }

        private function checkFollower() 
        {
            if(!empty( $this->access->accessGetUserId( 'id' ) ))
            {
                $idUser = $this->access->accessGetUserId( 'id' );
                $userId = $this->access->accessUserId();
                return $this->access->MyModelsOther->getRows(" SELECT * FROM ug_follow 
                WHERE userId = '$userId' AND id_onswer = '$idUser' ");
            }
        }

        private function getDataAction() 
        {
            $idTrade = $this->access->accessGetUserId( 'id' );

                return $this->access->MyModelsCrud->getRaw(" SELECT 
                ROW_NUMBER() OVER (ORDER BY ug_new_feeds.id) AS stt,
                ug_new_feeds.id as nfId,
                ug_new_feeds.title,
                ug_new_feeds.createAt as time,
                ug_service.*, ug_users.id as userId,
                ug_users.firstName, ug_users.lastName,
                (SELECT COUNT(*) FROM ug_power_point WHERE userId = ug_service.userId) as total_topics,
                CASE 
                    WHEN (SELECT COUNT(*) FROM ug_power_point WHERE userId = ug_service.userId) = 
                         (SELECT MAX(topic_count) FROM (SELECT COUNT(*) as topic_count FROM ug_power_point GROUP BY userId) AS subquery) 
                    THEN 'Cao'
                    WHEN (SELECT COUNT(*) FROM ug_power_point WHERE userId = ug_service.userId) >= 3 
                    THEN 'Trung bình'
                    ELSE 'Thấp'
                END AS topic_level
            FROM 
                ug_new_feeds
            LEFT JOIN 
                ug_service ON ug_new_feeds.id = ug_service.id_trade
            LEFT JOIN 
                ug_users ON ug_users.id = ug_service.userId 
            WHERE ug_service.id_trade = '$idTrade'
            ORDER BY total_topics DESC ");
        }
    }
