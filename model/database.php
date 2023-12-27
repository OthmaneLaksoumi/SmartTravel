<?php

require_once("db_config.php");

class database {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    public function getConnection() {
        return $this->db;
    }
}

?>

