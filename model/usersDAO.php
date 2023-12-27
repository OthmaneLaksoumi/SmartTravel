<?php

require_once("database.php");
require_once("users.php");

class usersDAO
{
    private $db;
    public function __construct() {
        $connObject = new database();
        $this->db = $connObject->getConnection();
    }

    public function get_users($state, $role) {
        $sql = "SELECT * FROM users WHERE `state` = '$state' AND `role` = '$role'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resultObject = array();
        foreach( $resultArray as $user ) {
            $resultObject[] = new users($user['email'], $user['username'], $user['pass'], $user['state'], $user['role']);
        }
        return $resultObject;
    }

}
?>
