<?php 
require_once ( dirname( __DIR__ ) ) . "/core/Shared/General.php";

class Instruct extends General {
    private $access;

    public function __construct() {
        $this->access = new General;
    }

    public function index() {
        $this->instruct();
    }

    public function instruct() {
        $allPosts = $this->allPosts() ?? null;
        $topPost = $this->topPost() ?? null;
        $serviceUnfinished = $this->serviceUnfinished() ?? $this->topPost('post');

        $this->view('masterlayout', [
            'page' => 'users/instruct',
            'resources' => [
                'title' => 'Usego - Chủ đề đặc biệt và thiết kế xuất sắc',
                'css' => 'instruct',
                'js' => 'instruct',
            ],
            'dataSql' => [
                'allPosts' => $allPosts,
                'topPost' => $topPost,
                'serviceUnfinished' => $serviceUnfinished,
            ], 
        ]);
    }

    public function newpost() {
        $userId = $this->access->accessUserId();
        $checkType = $this->access->MyModelsCrud->getRaw("
        SELECT 
            ug_type 
        FROM 
            ug_users 
        WHERE 
            id = '$userId'");

        $this->view('masterlayout', [
            'page' => 'users/newpost',
            'resources' => [
                'title' => 'Usego - Tạo bài viết mới',
                'css' => 'newpost',
                'js' => [
                    'core/editor',
                    'views/newpost',
                ],
                'editor' => true,
            ],
            'dataSql' => [
                'checkType' => $checkType,
            ], 
        ]);
    }

    public function read() {
        $idPost = $this->access->accessGetUserId('id');
        if (!empty($idPost)) {
            $userId = $this->access->accessUserId();
            $dataRead = $this->dataRead($idPost) ?? null;

            if (empty($dataRead)) {
                $this->access->loadError404();
            }

            $dataService = $this->dataService($userId, $idPost) ?? null;
            $dataServiceOnwer = $this->dataServiceOnwer($idPost);
            $dataStatus = $this->dataStatus($idPost);

            $this->view('masterlayout', [
                'page' => 'users/read',
                'resources' => [
                    'title' => 'Usego - Các câu hỏi tổng hợp của người dùng',
                    'css' => 'read',
                    'js' => 'read',
                ],
                'dataSql' => [
                    'dataRead' => $dataRead,
                    'dataService' => $dataService,
                    'dataServiceOnwer' => $dataServiceOnwer,
                    'dataStatus' => $dataStatus,
                ], 
            ]);
        } else {
            header("Location: /usego/instruct");
        }
    }

    private function allPosts() {
        return $this->access->MyModelsCrud->getRaw("
            SELECT 
                ug_users.firstName, 
                ug_users.lastName, 
                ug_users.avatar,
                ug_new_feeds.*
            FROM 
                ug_new_feeds
            INNER JOIN 
                ug_users ON ug_users.id = ug_new_feeds.userId
            WHERE 
                ug_new_feeds.hide != 'false'
            ORDER BY 
                ug_new_feeds.id DESC;
        ");
    }

    private function topPost($type = '') {
        $topics = [
            'post' => 'post',
            'service' => 'service'
        ];
        $identify = $type !== '' && array_key_exists($type, $topics) ? "AND topic = '{$topics[$type]}'" : '';
        
        return $this->access->MyModelsCrud->getRaw("
            SELECT 
                ug_users.firstName, 
                ug_users.lastName, 
                ug_users.avatar,
                ug_new_feeds.*
            FROM 
                ug_new_feeds
            INNER JOIN 
                ug_users ON ug_users.id = ug_new_feeds.userId
            WHERE 
                ug_new_feeds.hide != 'false' $identify
            ORDER BY 
                ug_new_feeds.view DESC
            LIMIT 4;
        ");
    }

    private function serviceUnfinished() {
        return $this->access->MyModelsCrud->getRaw("
            SELECT
                ug_users.firstName, 
                ug_users.lastName, 
                ug_users.avatar,
                ug_new_feeds.*
            FROM 
                ug_new_feeds
            INNER JOIN 
                ug_users ON ug_users.id = ug_new_feeds.userId
            WHERE 
                ug_new_feeds.topic = 'service' AND
                (ug_new_feeds.status IS NULL OR ug_new_feeds.status = 'PD') AND
                ug_new_feeds.hide != 'false'
            ORDER BY 
                ug_new_feeds.id DESC
            LIMIT 6;
        ") ?: null;
    }

    private function dataRead($idPost) {
        return $this->access->MyModelsCrud->getRaw("
            SELECT 
                ug_users.firstName, ug_users.lastName, ug_new_feeds.* 
            FROM 
                ug_new_feeds
            INNER JOIN 
                ug_users ON ug_users.id = ug_new_feeds.userId 
            WHERE 
                ug_new_feeds.id = '$idPost'
            ORDER BY 
                ug_new_feeds.id DESC;
        ");
    }

    private function dataService($userId, $idPost) {
        return $this->access->MyModelsCrud->getRaw("
            SELECT * 
            FROM 
                ug_service 
            WHERE 
                userId = '$userId' AND 
                id_trade = '$idPost';
        ");
    }

    private function dataServiceOnwer($idPost) {
        return $this->access->MyModelsCrud->getRaw("
            SELECT * 
            FROM 
                ug_service 
            WHERE 
                id_trade = '$idPost' AND 
                (status = 'XN' OR status = 'TB' OR status = 'HT');
        ");
    }

    private function dataStatus($idPost) {
        return $this->access->MyModelsOther->getRows("
            SELECT * 
            FROM 
                ug_service 
            WHERE 
                id_trade = '$idPost' AND 
                status = 'HT';
        ");
    }
}
