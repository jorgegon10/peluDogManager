<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'reporteDiaController.php');





$reportes= new ReporteDia();
session_start();

// Si el usuario está logueado
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}


if (isset($_SESSION['peluqueria'])) {
    $peluqueria = $_SESSION['peluqueria'];
} else {
    $peluqueria= null;
}
    $reportes= $reportes->getReporteByPeluqueria($peluqueria);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="../CSS/historialCaja.css">
</head>

<body>

    <?php include "../Generales/nav.php" ?>

    <!-- Formulario de búsqueda de productos -->
    <form method="GET" action="" class="busqueda-form">
        <input type="text" PLACEHOLDER="Buscar un producto..." name="busqueda"
            value="<?php if (isset($busqueda)) echo htmlspecialchars($busqueda); ?>"
            class="busqueda-input">
    </form>

    <!-- Productos filtrados por deporte o búsqueda -->
    <div class="contProductos">
        <div class="productos">
            <div class="cabecera">
                <h2>ID Reporte</h2>
                <h2>Recaudacion reporte</h2>
                <h2>Fecha Reporte</h2>
            </div>
            <?php
            if ($reportes) {
                foreach ($reportes as $reporte) { ?>
                    <form class="formProducto" action="" method="GET">
                        <div class="divProduc" onclick="this.closest('form').submit()">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($reporte['id_reporte']) ?>">


                           <h3 id="nombre"><?= htmlspecialchars($reporte['id_reporte']) ?></h3>
                            <h3 id="nombre"><?= htmlspecialchars($reporte['num_compra']) ?></h3>
                            <p id="precio"><?= htmlspecialchars($reporte['total_compras']) ?>€</p>
                            <p id="precio"><?= htmlspecialchars($reporte['fecha_compras']) ?></p>
                            

                        </div>
                    </form>
                <?php }
            } else { ?>
                <p>No se han encontrado productos.</p>
            <?php } ?>
        </div>
    </div>

    <a href="opcionesCaja.php">
    <?php include "botonAtras.php" ?>
    </a>



</body>

</html>