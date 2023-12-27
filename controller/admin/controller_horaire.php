<?php

require_once("model/admin/citiesDAO.php");
require_once("model/admin/model_horaireDAO.php");


class horaireController
{
    public function affiche_horaire() {
        $horaireDAO = new horaireDAO();
        $horaires = $horaireDAO->get_all_horaire();
        include("view/admin/horaire/affiche_horaire.php");
    }
}
