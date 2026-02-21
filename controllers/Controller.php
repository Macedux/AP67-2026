<?php
class Controller
{
    private GestorNebula $gestor;

    public function __construct(GestorNebula $gestor)
    {
        $this->gestor = $gestor;
    }

    public function index(): void
    {
        $todas = $this->gestor->todos();

        $perPage = 5;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

        $total = count($todas);
        $totalPages = max(1, (int)ceil($total / $perPage));
        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $perPage;
        $entidades = array_slice($todas, $offset, $perPage);

        // OJO: tu carpeta es "Views" (con V mayúscula)
        include "Views/lista.php";
    }

    public function registro(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tipo = $_POST['tipo'] ?? '';
            $idUnico = trim($_POST['idUnico'] ?? '');
            $nombre = trim($_POST['nombre'] ?? '');
            $planetaOrigen = trim($_POST['planetaOrigen'] ?? '');
            $nivelEstabilidad = (int)($_POST['nivelEstabilidad'] ?? 0);
            $atributoEspecial = trim($_POST['atributoEspecial'] ?? '');

            // Validación básica
            if ($tipo === '' || $idUnico === '' || $nombre === '' || $planetaOrigen === '') {
                $error = "Tipo, ID, nombre y planeta no pueden estar vacíos.";
                $modo = 'crear';
                $entidad = null;
                include "Views/form.php";
                return;
            }
            if ($nivelEstabilidad < 1 || $nivelEstabilidad > 10) {
                $error = "El nivel de estabilidad debe estar entre 1 y 10.";
                $modo = 'crear';
                $entidad = null;
                include "Views/form.php";
                return;
            }


            switch ($tipo) {
                case 'FormaDeVida':
                    $entidad = new FormaDeVida($atributoEspecial, $idUnico, $nombre, $planetaOrigen, $nivelEstabilidad);
                    break;

                case 'MineralRaro':
                    $entidad = new MineralRaro($atributoEspecial, $idUnico, $nombre, $planetaOrigen, $nivelEstabilidad);
                    break;

                case 'ArtefactoAntiguo':
                    $entidad = new ArtefactoAntiguo($atributoEspecial, $idUnico, $nombre, $planetaOrigen, $nivelEstabilidad);
                    break;

                default:
                    $error = "Tipo de entidad no válido.";
                    $modo = 'crear';
                    $entidad = null;
                    include "Views/form.php";
                    return;
            }

            $this->gestor->crear($entidad);

            header("Location: index.php");
            exit;
        }

       
        $modo = 'crear';
        $entidad = null;
        include "Views/form.php";
    }

    public function expulsion(): void
    {
        $idUnico = $_GET['idUnico'] ?? null;
        if ($idUnico !== null) {
            $this->gestor->borrar($idUnico);
        }
        header("Location: index.php");
        exit;
    }

    public function editarFormaDeVida(): void
    {
        $idUnico = $_GET['idUnico'] ?? ($_POST['idUnico'] ?? null);
        if ($idUnico === null) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $planetaOrigen = trim($_POST['planetaOrigen'] ?? '');
            $nivelEstabilidad = (int)($_POST['nivelEstabilidad'] ?? 0);
            $dieta = trim($_POST['atributoEspecial'] ?? '');

            if ($nombre === '' || $planetaOrigen === '') {
                $error = "Nombre y planeta no pueden estar vacíos.";
                $entidad = $this->gestor->buscar($idUnico);
                $modo = 'editar';
                include "Views/form.php";
                return;
            }
            if ($nivelEstabilidad < 1 || $nivelEstabilidad > 10) {
                $error = "La estabilidad debe estar entre 1 y 10.";
                $entidad = $this->gestor->buscar($idUnico);
                $modo = 'editar';
                include "Views/form.php";
                return;
            }

            $this->gestor->actualizarFormaDeVida($idUnico, $nombre, $planetaOrigen, $nivelEstabilidad, $dieta);

            header("Location: index.php");
            exit;
        }

        // GET
        $entidad = $this->gestor->buscar($idUnico);
        $modo = 'editar';
        include "Views/form.php";
    }

    public function editarMineralRaro(): void
    {
        $idUnico = $_GET['idUnico'] ?? ($_POST['idUnico'] ?? null);
        if ($idUnico === null) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $planetaOrigen = trim($_POST['planetaOrigen'] ?? '');
            $nivelEstabilidad = (int)($_POST['nivelEstabilidad'] ?? 0);
            $dureza = trim($_POST['atributoEspecial'] ?? '');

            if ($nombre === '' || $planetaOrigen === '') {
                $error = "Nombre y planeta no pueden estar vacíos.";
                $entidad = $this->gestor->buscar($idUnico);
                $modo = 'editar';
                include "Views/form.php";
                return;
            }
            if ($nivelEstabilidad < 1 || $nivelEstabilidad > 10) {
                $error = "La estabilidad debe estar entre 1 y 10.";
                $entidad = $this->gestor->buscar($idUnico);
                $modo = 'editar';
                include "Views/form.php";
                return;
            }

            $this->gestor->actualizarMineralRaro($idUnico, $nombre, $planetaOrigen, $nivelEstabilidad, $dureza);

            header("Location: index.php");
            exit;
        }

        // GET
        $entidad = $this->gestor->buscar($idUnico);
        $modo = 'editar';
        include "Views/form.php";
    }

    public function editarArtefacto(): void
    {
        $idUnico = $_GET['idUnico'] ?? ($_POST['idUnico'] ?? null);

        if ($idUnico === null) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $planetaOrigen = trim($_POST['planetaOrigen'] ?? '');
            $nivelEstabilidad = (int)($_POST['nivelEstabilidad'] ?? 0);
            $antiguedad = trim($_POST['atributoEspecial'] ?? '');

            if ($nombre === '' || $planetaOrigen === '') {
                $error = "Nombre y planeta no pueden estar vacíos.";
                $entidad = $this->gestor->buscar($idUnico);
                $modo = 'editar';
                include "Views/form.php";
                return;
            }
            if ($nivelEstabilidad < 1 || $nivelEstabilidad > 10) {
                $error = "La estabilidad debe estar entre 1 y 10.";
                $entidad = $this->gestor->buscar($idUnico);
                $modo = 'editar';
                include "Views/form.php";
                return;
            }

            $this->gestor->actualizarArtefacto($idUnico, $nombre, $planetaOrigen, $nivelEstabilidad, $antiguedad);

            header("Location: index.php");
            exit;
        }

        // GET
        $entidad = $this->gestor->buscar($idUnico);
        $modo = 'editar';
        include "Views/form.php";
    }
}