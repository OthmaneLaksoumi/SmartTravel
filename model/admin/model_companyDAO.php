<?php

require_once("model/database.php");
require_once("model_company.php");

class companyDAO
{
    private $db;

    public function __construct()
    {
        $conn = new database();
        $this->db = $conn->getConnection();
    }

    public function get_all_company()
    {
        $sql = "SELECT * FROM company";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultArray = $stmt->fetchAll(PDO::FETCH_OBJ);
        $resultObject = array();
        foreach ($resultArray as $row) {
            $resultObject[] = new company($row->name, $row->img);
        }
        return $resultObject;
    }

    public function get_company_by_name($name)
    {
        foreach ($this->get_all_company() as $company) {
            if ($company->getName() == $name) {
                return $company;
            }
        }
    }

    public function model_add_company()
    {
        extract($_POST);
        $img = "public/images/company/" . $_FILES["img"]['name'];
        $sql = "INSERT INTO company VALUES (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $img]);
        move_uploaded_file($_FILES["img"]['tmp_name'], 'C:\xampp\htdocs\SmartTravel\public\images\company\\' . $_FILES["img"]['name']);
    }

    public function model_update_company()
    {
        extract($_POST);
        if (empty($_FILES["img"]['name'])) {
            $sql = "UPDATE company SET name = ? WHERE name = '$oldName'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$name]);
        } else {
            $img = "public/images/company/" . $_FILES["img"]['name'];
            $sql = "UPDATE company SET name = ?, img = ? WHERE name = '$oldName'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$name, $img]);
            move_uploaded_file($_FILES["img"]['tmp_name'], 'C:\xampp\htdocs\SmartTravel\public\images\company\\' . $_FILES["img"]['name']);
        }

    }

    public function model_delete_company($name){
        $sql = "DELETE FROM company WHERE `name` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name]);
    }
}
