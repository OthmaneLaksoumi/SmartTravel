<?php

require_once("model/admin/model_companyDAO.php");
require_once("model/admin/model_busDAO.php");

class busController {

    public function affiche_bus() {
        $busDAO = new busDAO();
        $buses = $busDAO->get_all_bus();
        include("view/admin/bus/affiche_bus.php");
    }

    public function add_bus() {
        $companyDAO = new companyDAO();
        $companies = $companyDAO->get_all_company();
        include("view/admin/bus/add_bus.php");
    }

    public function add_bus_action() {
        $busDAO = new busDAO();
        $busDAO->model_add_bus();
        header("location: index.php?action=bus");
        exit;
    }

    public function update_bus() {
        $matricule = $_GET['matricule'];
        $companyDAO = new companyDAO();
        $companies = $companyDAO->get_all_company();
        $busDAO = new busDAO();
        $bus = $busDAO->get_bus_by_matricule($matricule);
        include("view/admin/bus/update_bus.php");
    }

    public function update_bus_action() {
        $busDAO = new busDAO();
        $busDAO->model_update_bus();
        header("location: index.php?action=bus");
        exit;
    }

    public function delete_bus() {
        $matricule = $_GET["matricule"];
        $busDAO = new busDAO();
        $busDAO->model_delete_bus($matricule);
        header("location: index.php?action=bus");
        exit;
    }
}









?>