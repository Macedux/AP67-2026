<?php

require_once "autoload.php";
session_start();

$gestor = new GestorNebula();
$controller = new Controller($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'registro':
        $controller->registro();
        break;
    case 'editarFormaDeVida':
        $controller->editarFormaDeVida();
        break;
    case 'editarMineralRaro':
        $controller->editarMineralRaro();
        break;
    case 'editarArtefacto':
        $controller->editarArtefacto();
        break;
    case 'expulsion':
        $controller->expulsion();
        break;
    default:
        $controller->index();
        break;
}