<?php
include("model\database.php");
include("cities.php");
class CitiesDAO {
    private $db;

    public function __construct() {
        $conn = new database();
        $this->db = $conn->getConnection();
    }

    public function get_all_cities() {
        $sql = "SELECT * FROM city";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultArray = $stmt->fetchAll(PDO::FETCH_OBJ);
        $resultObject = array();
        foreach ($resultArray as $row) {
            $resultObject[] = new cities($row->name);
        }
        return $resultObject;
    }
}



?>