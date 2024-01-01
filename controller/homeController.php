<?php

require_once("model/admin/citiesDAO.php");
require_once("model/admin/model_horaireDAO.php");

class homeController
{
    public function afficheHome()
    {
        $citiesDAO = new CitiesDAO();
        $cities = $citiesDAO->get_all_cities();
        include("view/home.php");
    }

    public function search_voyage() {
        extract($_POST);
        $horaireDAO = new horaireDAO();
        $horaires = $horaireDAO->get_horaire_for_search($depart, $arrive, $date);
        $names = $horaireDAO->get_companies_for_horaire( $depart, $arrive, $date);
        // $names = $horaires->get_companyName();
        include("view/search_result.php");
    }

}
