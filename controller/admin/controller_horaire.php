<?php

require_once("model/admin/citiesDAO.php");
require_once("model/admin/model_busDAO.php");
require_once("model/admin/model_horaireDAO.php");
require_once("model/admin/model_routeDAO.php");


class horaireController
{
    public function affiche_horaire()
    {
        $horaireDAO = new horaireDAO();
        $horaires = $horaireDAO->get_all_horaire();
        include("view/admin/horaire/affiche_horaire.php");
    }

    public function add_horaire()
    {
        $routeDAO = new routeDAO();
        $routes = $routeDAO->get_all_route();
        $busDAO = new busDAO();
        $buses = $busDAO->get_all_bus();
        include("view/admin/horaire/add_horaire.php");
    }

    public function add_horaire_action()
    {
        $horaireDAO = new horaireDAO();
        $horaireDAO->model_add_horaire();
        header("location: index.php?action=horaire");
        exit;
    }

    public function update_horaire()
    {
        extract($_GET);
        $horaireDAO = new horaireDAO();
        $horaire = $horaireDAO->get_horaire_by_primaries_key($matricule, $departure_time, $destination_time);
        $routeDAO = new routeDAO();
        $routes = $routeDAO->get_all_route();
        $busDAO = new busDAO();
        $buses = $busDAO->get_all_bus();
        include("view/admin/horaire/update_horaire.php");
    }

    public function update_horaire_action()
    {
        $horaireDAO = new horaireDAO();
        $horaireDAO->model_update_horaire();
        header("location: index.php?action=horaire");
        exit;
    }
    public function delete_horaire() {
        extract($_GET);
        $horaireDAO = new horaireDAO();
        $horaireDAO->model_delete_horaire($matricule, $departure_time, $destination_time);
        header("location: index.php?action=horaire");
        exit;
    }
}

    

?>
