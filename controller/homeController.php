<?php

require_once("model/admin/citiesDAO.php");

class homeController
{
    public function afficheHome()
    {
        $citiesDAO = new CitiesDAO();
        $cities = $citiesDAO->get_all_cities();
        include("view/home.php");
    }
}
