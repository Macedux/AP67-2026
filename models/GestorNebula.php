<?php

class GestorNebula
{
    public function __construct()
    {
        if (!isset($_SESSION['entidades'])) {
            $_SESSION['entidades'] = [];
        }
    }

    public function crear($entidad)
    {
        $_SESSION['entidades'][] = $entidad;
    }

    public function todos()
    {
        return $_SESSION['entidades'];
    }

    public function buscar($idUnico)
    {
        foreach ($_SESSION['entidades'] as $entidad) {
            if ($entidad->getIdUnico() == $idUnico) {
                return $entidad;
            }
        }
        return null;
    }

    public function actualizarFormaDeVida($idUnico, $nombre, $planetaOrigen, $nivelEstabilidad, $dieta)
    {
        foreach ($_SESSION['entidades'] as $i => $entidad) {
            if ($entidad->getIdUnico() == $idUnico) {
                
                $_SESSION['entidades'][$i] = new FormaDeVida($dieta, $idUnico, $nombre, $planetaOrigen, $nivelEstabilidad);
                break;
            }
        }
    }

    public function actualizarMineralRaro($idUnico, $nombre, $planetaOrigen, $nivelEstabilidad, $dureza)
    {
        foreach ($_SESSION['entidades'] as $i => $entidad) {
            if ($entidad->getIdUnico() == $idUnico) {
                
                $_SESSION['entidades'][$i] = new MineralRaro($dureza, $idUnico, $nombre, $planetaOrigen, $nivelEstabilidad);
                break;
            }
        }
    }

    public function actualizarArtefacto($idUnico, $nombre, $planetaOrigen, $nivelEstabilidad, $antiguedad)
    {
        foreach ($_SESSION['entidades'] as $i => $entidad) {
            if ($entidad->getIdUnico() == $idUnico) {
                
                $_SESSION['entidades'][$i] = new ArtefactoAntiguo($antiguedad, $idUnico, $nombre, $planetaOrigen, $nivelEstabilidad);
                break;
            }
        }
    }

    public function buscarMineralRaro()
    {
        $minerales = [];
        for ($i = 0; $i < count($_SESSION['entidades']); $i++) {
            if (get_class($_SESSION['entidades'][$i]) == 'MineralRaro') {
                $minerales[] = $_SESSION['entidades'][$i];
            }
        }
        return $minerales;
    }

    public function buscarFormaDeVida()
    {
        $elementosVivos = [];
        for ($i = 0; $i < count($_SESSION['entidades']); $i++) {
            if (get_class($_SESSION['entidades'][$i]) == 'FormaDeVida') {
                $elementosVivos[] = $_SESSION['entidades'][$i];
            }
        }
        return $elementosVivos;
    }

    public function buscarArtefacto()
    {
        $artefactos = [];
        for ($i = 0; $i < count($_SESSION['entidades']); $i++) {
            if (get_class($_SESSION['entidades'][$i]) == 'ArtefactoAntiguo') {
                $artefactos[] = $_SESSION['entidades'][$i];
            }
        }
        return $artefactos;
    }

    public function borrar($idUnico)
    {
        foreach ($_SESSION['entidades'] as $i => $entidad) {
            if ($entidad->getIdUnico() == $idUnico) {
                unset($_SESSION['entidades'][$i]);
                $_SESSION['entidades'] = array_values($_SESSION['entidades']);
                break;
            }
        }
    }
}