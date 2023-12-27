<?php

require_once("model/admin/citiesDAO.php");
require_once("model/admin/model_companyDAO.php");


class companyController
{


    public function affiche_home() {
        $cityDAO = new CitiesDAO();
        $cities = $cityDAO->get_all_cities();
        include("view\home.php");
    }

    public function affiche_company()
    {
        $companyDAO = new companyDAO();
        $companies = $companyDAO->get_all_company();
        include("view/admin/company/affiche_company.php");
    }
    public function add_company()
    {

        include("view/admin/company/add_company.php");
    }

    public function add_company_action()
    {
        $companyDAO = new companyDAO();
        $companyDAO->model_add_company();
        header("location: index.php?action=company");
        exit;
    }

    public function update_company()
    {
        $name = $_GET['name'];
        $companyDAO = new companyDAO();
        $company = $companyDAO->get_company_by_name($name);
        include("view/admin/company/update_company.php");
    }

    public function update_company_action() {
        $companyDAO = new companyDAO();
        $companyDAO->model_update_company();
        header("location: index.php?action=company");
        exit;
    }

    public function delete_company() {
        $name = $_GET["name"];
        $companyDAO = new companyDAO();
        $companyDAO->model_delete_company($name);
        header("location: index.php?action=company");
        exit;
    }
}
