<?php    
$getActionParams = new App();
$arrayCrumbs = $getActionParams->urlProcess();

$param = !empty($arrayCrumbs[1]) ? $arrayCrumbs[1] : 'statistics';

$admin = new Admin($param);

class Admin extends Controller {
    private $access;
    private $param;

    public function __construct($param = 'statistics') {
        $this->access = new General;
        $this->param = $param;
    }
    
    public function index() {
        if ($this->checkPermissions() !== 1) {
            require_once("./mvc/errors/404.php");
            exit(0);
        }

        $this->view('masterlayout', [
            'page' => 'admin/index',
            'resources' => [
                'title' => 'Quản lý website - Chia sẻ powerpoint miễn phí',
                'css' => '_index',
                'js' => '_index',
                '_lite' => $this->correlateResources($this->param),
            ],
        ]);
    }

    public function correlateResources() {
        $resources = [
            'statistics' => [
                '_css' => '_statistics',
                '_js' => '_statistics'
            ],
            'managefile' => [],
            'managephoto' => [],
            'requesttrade' => [],
            'fileservice' => [],
            'photoservice' => []
        ];

        if (!isset($resources[$this->param])) {
            require_once 'dashboard.php';
            return [];
        }

        return $resources[$this->param];
    }

    // SQL 
    public function checkPermissions(): mixed {
        $userId = $this->access->accessUserId();
        return $this->access->MyModelsOther->getRows("SELECT * FROM ug_users 
        WHERE id = '$userId' AND ug_type = 1");
    }
}
