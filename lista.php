<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Expedición Nova - Logbook</title>
    <link rel="stylesheet" href="Views/styles.css">
</head>

<body>

<h1>Logbook - Expedición Nova</h1>
<div class="github-link">
    <a href="https://github.com/Macedux/AP67-2026" target="_blank">
         ¡Ver proyecto en GitHub!
    </a>
</div>

<p>
    <a href="index.php?accion=registro">Registrar nueva entidad</a>
</p>

<h2>Explorador de Entidades</h2>

<?php if (empty($entidades)): ?>
    <p>No hay entidades registradas todavía.</p>
<?php else: ?>

    <div class="table-wrap">
        <table cellpadding="10">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Planeta</th>
                <th>Estabilidad</th>
                <th>Atributo especial</th>
                <th>Reacción</th>
                <th>Acciones</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($entidades as $e): ?>

                <?php
                $tipo = get_class($e);
                $atributoValor = '';
                $accionEditar = 'index';

                if ($e instanceof FormaDeVida) {
                    $atributoValor = $e->getDieta();
                    $accionEditar = 'editarFormaDeVida';
                } elseif ($e instanceof MineralRaro) {
                    $atributoValor = $e->getDureza();
                    $accionEditar = 'editarMineralRaro';
                } elseif ($e instanceof ArtefactoAntiguo) {
                    $atributoValor = $e->getAntiguedad();
                    $accionEditar = 'editarArtefacto';
                }

                $idUnico = $e->getIdUnico();
                ?>

                <tr>
                    <td><?= $idUnico ?></td>
                    <td><?= $tipo ?></td>
                    <td><?= $e->getNombre() ?></td>
                    <td><?= $e->getPlanetaOrigen() ?></td>
                    <td><?= $e->getNivelEstabilidad() ?>/10</td>
                    <td><?= $atributoValor ?></td>
                    <td><?= $e->reaccionar() ?></td>
                    <td class="actions">
                        <a href="index.php?accion=<?= $accionEditar ?>&idUnico=<?= $idUnico ?>">Editar</a>
                        <a href="index.php?accion=expulsion&idUnico=<?= $idUnico ?>">Expulsar</a>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- PAGINADOR -->
    <?php if ($totalPages > 1): ?>

        <nav style="margin-top:15px;">

            <?php
            $base = "index.php?accion=index&page=";
            $prev = max(1, $page - 1);
            $next = min($totalPages, $page + 1);

            $window = 2;
            $start = max(1, $page - $window);
            $end   = min($totalPages, $page + $window);
            ?>

            <!-- boton anterior -->
            <?php if ($page > 1): ?>
                <a href="<?= $base . $prev ?>">« Anterior</a>
            <?php else: ?>
                <span style="opacity:.5;">« Anterior</span>
            <?php endif; ?>

            |

            <!-- boton primera -->
            <?php if ($start > 1): ?>
                <a href="<?= $base ?>1">1</a>
                <?php if ($start > 2) echo " ... | "; ?>
            <?php endif; ?>

            <!-- Ventana central -->
            <?php for ($i = $start; $i <= $end; $i++): ?>
                <?php if ($i == $page): ?>
                    <strong><?= $i ?></strong>
                <?php else: ?>
                    <a href="<?= $base . $i ?>"><?= $i ?></a>
                <?php endif; ?>
                <?php if ($i < $end) echo " | "; ?>
            <?php endfor; ?>

            <!-- Con esto vamos a la ultima -->
            <?php if ($end < $totalPages): ?>
                <?php if ($end < $totalPages - 1) echo " | ... "; ?>
                | <a href="<?= $base . $totalPages ?>"><?= $totalPages ?></a>
            <?php endif; ?>

            |

            <!-- Con esto hacemos el siguiente -->
            <?php if ($page < $totalPages): ?>
                <a href="<?= $base . $next ?>">Siguiente »</a>
            <?php else: ?>
                <span style="opacity:.5;">Siguiente »</span>
            <?php endif; ?>

            <div style="margin-top:8px;">
                Mostrando página <?= $page ?> de <?= $totalPages ?> — Total registros: <?= $total ?>
            </div>

        </nav>

    <?php endif; ?>

<?php endif; ?>

</body>
</html>