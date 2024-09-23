<?php 
require_once ("mvc/core/Controller.php");
require_once ("mvc/core/Request.php");

define('_USERS_PATH', './mvc/views/cpanel/users/');
// SetDefine Users 

class checkStatusLoginUser extends Controller {
    public static function checkLogin()
    {
        $status = new isLogin();
        if($status->checkLogin())
        {
            return true;
        }
    }
}

class Layout extends controller {
    private $allPageData, $dataResources, $dataSql;

    public function loadLayout($data, $layoutType) 
    {
        if(!empty($data['resources']))
        {
            $this->dataResources = $data['resources'];
        } else {
            $this->dataResources = [];
        }

        if(!empty($data['dataSql']))
        {
            $this->dataSql = $data['dataSql'];
        } else {
            $this->dataSql = [];
        }
        
        $this->allPageData = array_merge($this->dataResources, $this->dataSql);

        // Connect two arrays value
        $this->resources($layoutType, $this->allPageData);
    }

    public function render()
    {
        return $this->allPageData;
    }
}

$layout = new Layout();

class getData {
    public static function getDataView($dataPage, $dataSql) 
    {
        if(file_exists("./mvc/views/cpanel/" . $dataPage . ".php"))
        {
            require_once "./mvc/views/cpanel/" . $dataPage . ".php";
        } 
    }
}

// Data dependent url layout Users || Admin
if(empty($_GET['url'])) 
{
    $dataLayout = [
        'header' => 'layouts/header',
        'footer' => 'layouts/footer'
    ];
} else 
{
    $dataLayout = [
        'header' => 'layouts/header',
        'footer' => 'layouts/footer'
    ];
}

if(empty($data['dataSql'])) {
    $data['dataSql'] = null;
}

// Load Header
$layout->loadLayout($data, $dataLayout['header']);
$layout->render();

// Main page
getData::getDataView($data['page'], $data['dataSql']);

// Load Footer
$layout->loadLayout($data, $dataLayout['footer']);
$layout->render();


