<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(MODEL . 'Compra.php');
$compras= new Compra();
session_start();

// Si el usuario está logueado
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}

// Comprobamos si hay búsqueda
// $busqueda = null;
// if (isset($_GET['busqueda'])) {
//     $busqueda = $_GET['busqueda'];
//     // Si hay búsqueda, filtramos por nombre
//     $productos = $productController->getProductsByName($busqueda);
// } else {
//     // Si no hay búsqueda, mostramos todos los productos
//     $productos = $productController->getAllProducts();
// }

// // Comprobamos si se ha seleccionado un deporte
// $deporte = null;
// if (isset($_POST['deporte']) && !empty($_POST['deporte'])) {
//     $deporte = $_POST['deporte'];  // Si hay deporte seleccionado, filtramos por deporte
// }

// Si hay un deporte seleccionado, filtramos los productos por deporte
// if ($deporte) {


if (isset($_SESSION['peluqueria'])) {
    $peluqueria = $_SESSION['peluqueria'];
} else {
    $peluqueria= null;
}
    $compras = $compras->getComprasByPeluqueria($peluqueria);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Compra</title>
    <link rel="stylesheet" href="../CSS/historialCaja.css">
</head>

<body>

    <?php include "../Generales/nav.php" ?>

    

    
    <div class="contProductos">
        <div class="productos">
            <div class="cabecera">
                <h2>Descripción</h2>
                <h2>Forma de Pago</h2>
                <h2>Precio</h2>
            </div>
            <?php
            if ($compras) {
                foreach ($compras as $compra) { ?>
                  <form class="formProducto" action="añadirACaja.php" method="POST">
                    <div class="divProduc">
                        <input type="hidden" name="nombre_compra" value="<?= htmlspecialchars($compra['nombre_compra']) ?>">
                        <input type="hidden" name="precio_compra" value="<?= htmlspecialchars($compra['precio_compra']) ?>">
                        <input type="hidden" name="peluqueria" value="<?= htmlspecialchars($peluqueria) ?>">

                        <h3><?= htmlspecialchars($compra['nombre_compra']) ?></h3>
                    
                        <select name="formaPago" required>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>
                        </select>

                        <p><?= htmlspecialchars($compra['precio_compra']) ?>€</p>

                        
                        <button type="submit">Añadir a Caja</button>
                    </div>
                </form>

                <?php }
            } else { ?>
                <p>No se han encontrado productos.</p>
            <?php } ?>
        </div>
    </div>


</body>

</html>