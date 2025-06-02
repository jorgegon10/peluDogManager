<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ObjetoController.php');
require_once(MODEL . 'Objeto.php');

$objetos = new Objeto();
session_start();

$nombre_usuario = $_SESSION['nombre_usuario'] ?? null;
$peluqueria = $_SESSION['peluqueria'] ?? null;

$objetos = $objetos->getObjetosByPeluqueria($peluqueria);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="../CSS/inventarioView.css">
    
</head>

<body>

<?php include "../Generales/nav.php" ?>

<form method="GET" class="busqueda-form">
    <input type="text" placeholder="Buscar un producto..." name="busqueda"
        value="<?= isset($busqueda) ? htmlspecialchars($busqueda) : '' ?>"
        class="busqueda-input">
</form>

<div class="contProductos">
    <div class="productos">
        <?php if ($objetos): ?>
            <?php foreach ($objetos as $objeto): ?>
                <div class="formProducto">
                    <!-- Producto clickable (GET al hacer clic) -->
                    <div class="divProduc" onclick="document.location.href='?id=<?= $objeto['id_objeto'] ?>'">
                        <img class="imgProducto" src="<?= htmlspecialchars($objeto['imagen']) ?>" alt="">
                        <h3><?= htmlspecialchars($objeto['nombre_objeto']) ?></h3>
                        <h2><?= htmlspecialchars($objeto['precio']) ?>€</h2>
                    </div>

                    <!-- Controles de cantidad (POST independientes) -->
                    <div class="cantidad-control">
                        <form method="POST" action="actualizarCantidad.php">
                            <input type="hidden" name="id_objeto" value="<?= $objeto['id_objeto'] ?>">
                            <input type="hidden" name="accion" value="restar">
                            <button class="modCantidad" type="submit">−</button>
                        </form>

                        <span><?= htmlspecialchars($objeto['cantidad']) ?></span>

                        <form method="POST" action="actualizarCantidad.php">
                            <input type="hidden" name="id_objeto" value="<?= $objeto['id_objeto'] ?>">
                            <input type="hidden" name="accion" value="sumar">
                            <button class="modCantidad" type="submit">+</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se han encontrado productos.</p>
        <?php endif; ?>
    </div>
</div>

<a href="negocio.php">
    <?php include "botonAtras.php" ?>
</a>

<a href="añadirInventario.php" class="boton-flotante">+</a>

</body>
</html>
