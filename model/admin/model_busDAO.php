<?php

require_once("model/database.php");
require_once("model_bus.php");

class busDAO
{
    private $db;

    function __construct()
    {
        $conn = new database();
        $this->db = $conn->getConnection();
    }

    function get_all_bus()
    {
        $sql = "SELECT * FROM bus ORDER BY number_of_bus";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $resultObj = [];
        foreach ($result as $row) {
            $resultObj[] = new bus($row->matricule, $row->number_of_bus, $row->capacity, $row->company_name);
        }
        return $resultObj;
    }

    function get_bus_by_matricule($matricule)
    {
        foreach ($this->get_all_bus() as $bus) {
            if ($bus->getMatricule() === $matricule) return $bus;
        }
    }

    function model_add_bus()
    {
        extract($_POST);
        $sql = "INSERT INTO bus VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$matricule, $number_of_bus, $capacity, $company_name]);
    }

    function model_update_bus()
    {
        extract($_POST);
        $sql = "UPDATE bus SET matricule = ?, number_of_bus = ?, capacity = ?, company_name = ? WHERE matricule = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$matricule, $number_of_bus, $capacity, $company_name, $old_matricule]);
    }

    function model_delete_bus($matricule)
    {
        $sql = "DELETE FROM bus WHERE matricule = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$matricule]);
    }
}
