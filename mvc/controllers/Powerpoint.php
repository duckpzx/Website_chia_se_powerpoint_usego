<?php 
require_once ( dirname( __DIR__ ) ) . "/core/Shared/General.php";

class Powerpoint extends General {
    private $access;

    public function __construct() {
        $this->access = new General;
    }

    public function index() {
        $this->lists();
    }

    public function lists() {
        $countPosts = $this->getPostCount();
        
        $this->view('masterlayout', [
            'page' => 'users/lists',
            'resources' => [
                'title' => 'Usego - Danh sách các file tải lên powerpoint',
                'css' => 'lists',
                'js' => [
                    'core/follow',
                    'core/pagination',
                    'views/lists',
                ]
            ],
            'dataSql' => [
                'dataPowerpoint' => $this->getFilePowerpoints(),
                'dataCountPost' => $countPosts,
            ], 
        ]);
    }

    public function detail() {
        $getDataDetailPpt = $this->getDataDetailPpt();

        if (empty($getDataDetailPpt)) {
            $this->access->loadError404();
        }

        $this->view('masterlayout', [
            'page' => 'users/detail',
            'resources' => [
                'title' => 'Usego - Chi tiết bài thuyết trình',
                'css' => 'detail',
                'js' => [
                    'views/detail',
                    'core/comment'
                ], 
                'swiper' => 'swiper-bundle.min',
            ],
            'dataSql' => [
                'dataDetail' => $getDataDetailPpt,
                'totalComments' => $this->totalComments(),
            ], 
        ]);
    }

    private function getPostCount() {
        return $this->access->MyModelsOther->getRows("SELECT * FROM ug_power_point");
    }

    private function getDataDetailPpt() {
        $userId = $this->access->accessUserId();
        $idPost = $this->access->accessGetUserId('id');

        if (empty($idPost)) {
            return null; // Return null if no post ID is found
        }

        return $this->access->MyModelsCrud->getRaw("
            SELECT 
                ug_users.id, ug_users.firstName, ug_users.lastName, ug_users.avatar, ug_users.ug_type, ug_power_point.*,
                (SELECT COUNT(*) FROM ug_like_post WHERE ug_like_post.id_onwser = '$idPost') as total_likes,
                (SELECT COUNT(*) FROM ug_like_post WHERE ug_like_post.id_onwser = '$idPost' AND ug_like_post.userId = '$userId') as check_likes,
                (SELECT COUNT(*) FROM ug_collection_post WHERE ug_collection_post.id_onwser = '$idPost') as total_collections,
                (SELECT COUNT(*) FROM ug_collection_post WHERE ug_collection_post.id_onwser = '$idPost' AND ug_collection_post.userId = '$userId') as check_collections,
                (SELECT COUNT(*) FROM ug_archive WHERE ug_archive.idPost = '$idPost') as total_archive
            FROM 
                ug_users
            INNER JOIN 
                ug_power_point ON ug_users.id = ug_power_point.userId  
            WHERE 
                ug_power_point.id = '$idPost'");
    }

    protected function getFilePowerpoints() {
        $topicSerarch = $this->access->getValueParams();
        $titleTagConditions = !empty($topicSerarch) ? "WHERE ug_power_point.title LIKE '%$topicSerarch%' OR ug_power_point.tags LIKE '%$topicSerarch%'" : '';

        $userId = $this->access->accessUserId();
        $followCondition = !empty($userId) ? "ug_follow.userId = '$userId' AND" : '';
        $offSet = $this->access->calculateaPagination();
        $totalNumberOn1Page = _MAXIMUM_PAGE;

        $subquery = empty($followCondition) ? "0 as total_follow" : "(SELECT COUNT(*) FROM ug_follow WHERE $followCondition ug_follow.id_onswer = ug_power_point.userId) as total_follow";
        
        $query = "
            SELECT ug_users.id, ug_users.firstName, ug_users.lastName, ug_users.avatar, ug_users.ug_type,
                ug_power_point.*, COUNT(ug_like_post.id) AS like_count, $subquery
            FROM ug_users 
            INNER JOIN ug_power_point ON ug_users.id = ug_power_point.userId
            LEFT JOIN ug_like_post ON ug_power_point.id = ug_like_post.id_onwser
            $titleTagConditions
            GROUP BY ug_users.id, ug_power_point.id
            ORDER BY ug_power_point.id DESC 
            LIMIT $offSet, $totalNumberOn1Page";

        return $this->access->MyModelsCrud->getRaw($query);
    }

    protected function totalComments() {
        $idPost = $this->access->accessGetUserId('id');

        if (empty($idPost)) {
            return null; 
        }

        return $this->access->MyModelsCrud->getRaw("
            SELECT 
                (COUNT(ug_comment.id_cmt) + COUNT(ug_respond_comment.id_cmt)) AS total_comments
            FROM 
                ug_comment
            LEFT JOIN 
                ug_respond_comment ON ug_comment.id_cmt = ug_respond_comment.id_cmt
            WHERE 
                ug_respond_comment.idPost = '$idPost' OR ug_comment.idPost = '$idPost'");
    }
}
