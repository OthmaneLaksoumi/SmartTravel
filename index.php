<?php
include("controller/homeController.php");
include("controller/admin/controller_company.php");
include("controller/admin/controller_bus.php");
include("controller/admin/controller_route.php");
include("controller/admin/controller_horaire.php");

$homeController = new homeController();
$comanyController = new companyController();
$busController = new busController();
$routeController = new routeController();
$horaireController = new horaireController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'admin':
            $comanyController->affiche_home();
            break;
        case 'company':
            $comanyController->affiche_company();
            break;
        case 'add_company':
            $comanyController->add_company();
            break;
        case 'add_company_action':
            $comanyController->add_company_action();
            break;
        case 'update_company':
            $comanyController->update_company();
            break;
        case 'update_company_action':
            $comanyController->update_company_action();
            break;
        case 'delete_company':
            $comanyController->delete_company();
            break;
        case 'bus':
            $busController->affiche_bus();
            break;
        case 'add_bus':
            $busController->add_bus();
            break;
        case 'add_bus_action':
            $busController->add_bus_action();
            break;
        case 'update_bus':
            $busController->update_bus();
            break;
        case 'update_bus_action':
            $busController->update_bus_action();
            break;
        case 'delete_bus':
            $busController->delete_bus();
            break;
        case 'route':
            $routeController->affiche_route();
            break;
        case 'add_route':
            $routeController->add_route();
            break;
        case 'add_route_action':
            $routeController->add_route_action();
        case 'update_route':
            $routeController->update_route();
            break;
        case 'update_route_action':
            $routeController->update_route_action();
            break;
        case 'delete_route':
            $routeController->delete_route();
            break;
        case 'horaire':
            $horaireController->affiche_horaire();
            break;
        case 'add_horaire':
            $horaireController->add_horaire();
            break;
        case 'add_horaire_action':
            $horaireController->add_horaire_action();
            break;
        case 'update_horaire':
            $horaireController->update_horaire();
            break;
        case 'update_horaire_action':
            $horaireController->update_horaire_action();
            break;
        case 'delete_horaire':
            $horaireController->delete_horaire();
            exit;
        case 'search':
            $homeController->search_voyage();
            break;
    }
} else {
    $homeController->afficheHome();
}
