<?php 
require_once ( __DIR__ . "/Connect.php");

class Database {
    protected $conn;

    function __construct() {
        global $db_config;
        $this->conn = Connection::getInstance($db_config)->getConnection(); 
    }
}
