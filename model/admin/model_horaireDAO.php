<?php

require_once("model/database.php");
require_once("model/admin/model_horarie.php");

class horaireDAO
{
    private $db;

    public function __construct() {
        $conn = new database();
        $this->db = $conn->getConnection();
    }
 
    public function get_all_horaire() {
        $sql = "SELECT * FROM horaire";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $resultObj = [];
        foreach ($result as $row) {
            $resultObj[] = new horaire($row->departure_time, $row->destination_time, $row->matricule, $row->date, $row->available_seats, $row->departure_city, $row->destination_city);
        }
        return $resultObj;
    }
}
