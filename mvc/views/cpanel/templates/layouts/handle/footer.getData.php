<?php 
require_once ("mvc/core/Controller.php");

class showDataFooter extends Controller {
    private $status;
    private $MyModels;

    public function __construct() 
    {
        $this->MyModels = $this->models('MyModelsCrud');
    }

    // Get alert hot
    public function getAlertHot() 
    {
        return $this->MyModels->getRaw("SELECT ug_users.firstName, 
        ug_users.lastName, ug_new_feeds.* FROM ug_new_feeds
        INNER JOIN ug_users ON ug_users.id = ug_new_feeds.userId 
        WHERE ug_new_feeds.hot = 'on'
        ORDER BY ug_new_feeds.id DESC LIMIT 2;");
    }
}
