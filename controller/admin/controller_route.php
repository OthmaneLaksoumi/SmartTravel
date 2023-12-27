<?php

require_once("model/admin/citiesDAO.php");
require_once("model/admin/model_routeDAO.php");

class routeController {


    public function affiche_route() {
        $routeDAO = new routeDAO();
        $routes = $routeDAO->get_all_route();
        include("view/admin/route/affiche_route.php");
    }

    public function add_route() {
        $citiesDAO = new CitiesDAO();
        $cities = $citiesDAO->get_all_cities();
        include("view/admin/route/add_route.php");
    }

    public function add_route_action() {
        $routeDAO = new routeDAO();
        $routeDAO->model_add_route();
        header("location: index.php?action=route");
        exit;
    }

    public function update_route() {

        
    }

}





?>