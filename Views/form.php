<link rel="stylesheet" href="Views/styles.css">

<?php
$isEdit = isset($modo) && $modo === 'editar' && isset($entidad) && $entidad != null;

$idUnico = $isEdit ? $entidad->getIdUnico() : '';
$nombre = $isEdit ? $entidad->getNombre() : '';
$planetaOrigen = $isEdit ? $entidad->getPlanetaOrigen() : '';
$nivelEstabilidad = $isEdit ? $entidad->getNivelEstabilidad() : '';

$tipo = '';
$atributoLabel = 'Atributo Especial';
$atributoEspecial = '';

if ($isEdit) {
    $tipo = get_class($entidad);
    $idUnicoUrl = urlencode($idUnico);

    if ($entidad instanceof FormaDeVida) {
        $atributoLabel = 'Dieta (Carbono, Silicio, Energía)';
        $atributoEspecial = $entidad->getDieta();
        $accionForm = 'editarFormaDeVida&idUnico=' . $idUnicoUrl;
    } elseif ($entidad instanceof MineralRaro) {
        $atributoLabel = 'Dureza (Mohs galáctica)';
        $atributoEspecial = $entidad->getDureza();
        $accionForm = 'editarMineralRaro&idUnico=' . $idUnicoUrl;
    } else { // ArtefactoAntiguo
        $atributoLabel = 'Antigüedad (años luz)';
        $atributoEspecial = $entidad->getAntiguedad();
        $accionForm = 'editarArtefacto&idUnico=' . $idUnicoUrl;
    }
} else {
    $accionForm = 'registro';
}
?>

<h1>Placa de Datos del Nebula</h1>
<h2><?= $isEdit ? "Editar Entidad" : "Acceso al Logbook - Registrar Entidad" ?></h2>

<?php if (isset($error) && $error != ''): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="POST" action="index.php?accion=<?= $accionForm ?>">

    <?php if (!$isEdit): ?>
        <label>Tipo de Entidad:</label><br>
        <select name="tipo" required>
            <option value="">-- Seleccionar --</option>
            <option value="FormaDeVida">Forma de Vida</option>
            <option value="MineralRaro">Mineral Raro</option>
            <option value="ArtefactoAntiguo">Artefacto Antiguo</option>
        </select>
        <br><br>
    <?php else: ?>
        <input type="hidden" name="tipo" value="<?= $tipo ?>">
        <p><strong>Tipo:</strong> <?= $tipo ?></p>
    <?php endif; ?>

    <label>ID Único:</label><br>
    <input type="text" name="idUnico" value="<?= $idUnico ?>" <?= $isEdit ? "readonly" : "required" ?>>
    <br><br>

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $nombre ?>" required>
    <br><br>

    <label>Planeta de Origen:</label><br>
    <input type="text" name="planetaOrigen" value="<?= $planetaOrigen ?>" required>
    <br><br>

    <label>Nivel de Estabilidad (1-10):</label><br>
    <input type="number" name="nivelEstabilidad" min="1" max="10" value="<?= $nivelEstabilidad ?>" required>
    <br><br>

<label><?= $atributoLabel ?>:</label><br>
<!-- Con esto hacemos que en la forma de vida tengamos un desplegable que solo pueda elegir las 3 posibilidades -->
<?php if ($isEdit && $entidad instanceof FormaDeVida): ?>

    <select name="atributoEspecial" required>
        <option value="Carbono" <?= $atributoEspecial == 'Carbono' ? 'selected' : '' ?>>Carbono</option>
        <option value="Silicio" <?= $atributoEspecial == 'Silicio' ? 'selected' : '' ?>>Silicio</option>
        <option value="Energía" <?= $atributoEspecial == 'Energía' ? 'selected' : '' ?>>Energía</option>
    </select>

<?php elseif (!$isEdit): ?>

    <select name="atributoEspecial" id="dietaSelect" style="display:none;">
        <option value="">-- Seleccionar dieta --</option>
        <option value="Carbono">Carbono</option>
        <option value="Silicio">Silicio</option>
        <option value="Energía">Energía</option>
    </select>

    <input type="text" name="atributoEspecial" id="atributoInput" required>

    <script>
        const tipoSelect = document.querySelector("select[name='tipo']");
        const dietaSelect = document.getElementById("dietaSelect");
        const atributoInput = document.getElementById("atributoInput");

        if (tipoSelect) {
            tipoSelect.addEventListener("change", function () {
                if (this.value === "FormaDeVida") {
                    dietaSelect.style.display = "block";
                    atributoInput.style.display = "none";
                    atributoInput.removeAttribute("required");
                    dietaSelect.setAttribute("required", "required");
                } else {
                    dietaSelect.style.display = "none";
                    atributoInput.style.display = "block";
                    dietaSelect.removeAttribute("required");
                    atributoInput.setAttribute("required", "required");
                }
            });
        }
    </script>

<?php else: ?>

    <input type="text" name="atributoEspecial" value="<?= $atributoEspecial ?>" required>

<?php endif; ?>

<br><br>

    <button type="submit"><?= $isEdit ? "Guardar cambios" : "Registrar Entidad" ?></button>
</form>

<br>
<a href="index.php">Volver</a>