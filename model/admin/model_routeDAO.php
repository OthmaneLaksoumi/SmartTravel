<?php

require_once("model/database.php");
require_once("model_route.php");

class routeDAO
{
    private $db;

    public function __construct()
    {
        $conn = new database();
        $this->db = $conn->getConnection();
    }

    public function get_all_route()
    {
        $sql = "SELECT * FROM `route`";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $resultObj = array();
        foreach ($result as $row) {
            $resultObj[] = new route($row->departure_city, $row->destination_city, $row->distance, $row->duration);
        }
        return $resultObj;
    }

    public function get_route_by_depart_et_arrive($depart, $arrive)
    {
        foreach ($this->get_all_route() as $route) {
            if ($arrive == $route->getDestination_city() && $depart == $route->getDepartue_city()) {
                return $route;
            }
        }
    }

    public function model_add_route()
    {
        extract($_POST);
        $sql = "INSERT INTO `route` VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$depart, $arrive, $distance, $duration]);
    }

    public function model_update_route() {
        extract($_POST);
        $sql = "UPDATE route SET departure_city = ?, destination_city = ?, distance = ?, duration = ? WHERE departure_city = ? AND destination_city = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$depart, $arrive, $distance, $duration, $old_depart, $old_arrive]);
    }

    public function model_delete_route($depart, $arrive) {
        $sql = "DELETE FROM `route` WHERE `departure_city` = ? AND`destination_city` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$depart, $arrive]);

    }
}
