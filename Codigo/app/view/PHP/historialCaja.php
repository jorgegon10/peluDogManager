<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(CONTROLLER . 'reporteDiaController.php');

require_once(MODEL . 'Caja.php');

$compras = new Caja();
session_start();

// Usuario logueado
$nombre_usuario = $_SESSION['nombre_usuario'] ?? null;

// Peluquería activa
$peluqueria = $_SESSION['peluqueria'] ?? null;

// Obtener compras
$compras = $compras->getCajaByPeluqueria($peluqueria);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Producto</title>
    <link rel="stylesheet" href="../CSS/historialCaja.css">
</head>

<body>

    <?php include "../Generales/nav.php" ?>

    <!-- Formulario de búsqueda de productos -->
    <form method="GET" action="" class="busqueda-form">
        <input type="text" placeholder="Buscar un producto..." name="busqueda"
            value="<?php if (isset($busqueda)) echo htmlspecialchars($busqueda); ?>"
            class="busqueda-input">
    </form>

    <!-- Productos filtrados por deporte o búsqueda -->
    <div class="contProductos">
        <div class="productos">
            <div class="cabecera">
                <h2>Descripción</h2>
                <h2>Forma de Pago</h2>
                <h2>Precio</h2>
                <h2>Fecha Compra</h2>
            </div>
            <?php if ($compras): ?>
                <?php foreach ($compras as $compra): ?>
                    <form class="formProducto" action="productodetalle.php" method="GET">
                        <div class="divProduc" onclick="this.closest('form').submit()">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($compra['id_compra']) ?>">
                            <h3 id="nombre"><?= htmlspecialchars($compra['nombre_compra']) ?></h3>
                            <p id="precio"><?= htmlspecialchars($compra['formaPago']) ?></p>
                            <p id="precio"><?= htmlspecialchars($compra['precio_compra']) ?>€</p>
                            <p id="precio"><?= htmlspecialchars($compra['fecha_compra']) ?></p>
                        </div>
                    </form>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se han encontrado productos.</p>
            <?php endif; ?>
        </div>

        <form method="POST" action="añadirAReporte.php"> 
            <input type="hidden" name="guardar_reporte_dia" value="1">
            <button type="submit" class="guardar-btn">Guardar reporte del día</button>
        </form>

    </div>
    <a href="opcionesCaja.php">
    <?php include "botonAtras.php" ?>
    </a>


</body>

</html>