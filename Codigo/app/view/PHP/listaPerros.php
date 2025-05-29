<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(MODEL . 'Producto.php');
$productController = new ProductoController();
session_start();

// Si el usuario está logueado
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}


    // Si no hay búsqueda, mostramos todos los productos
    $productos = $productController->getAllProducts();








if (isset($_SESSION['peluqueria'])) {
    $peluqueria = $_SESSION['peluqueria'];
} else {
    $peluqueria= null;
}
    $productos = $productController->getProductsByPeluqueria($peluqueria);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Producto</title>
    <link rel="stylesheet" href="../CSS/listaProductos.css">
</head>

<body>

    <?php include "../Generales/nav.php" ?>

   

    <!-- Productos filtrados por deporte o búsqueda -->
    <div class="contProductos">
        <div class="productos">
            <?php
            if ($productos) {
                foreach ($productos as $producto) { ?>
                    <form class="formProducto" action="productodetalle.php" method="GET">
                        <div class="divProduc" onclick="this.closest('form').submit()">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id_producto']) ?>">
                            <img class="imgProducto" src="<?= htmlspecialchars($producto['imagen']) ?>" alt="">
                            <h3 id="likes"><?= htmlspecialchars($producto['likes']) . " &#x2764;" ?></h3>
                            <h3 id="nombre"><?= htmlspecialchars($producto['nombre_perro']) ?></h3>
                            <p id="precio"><?= htmlspecialchars($producto['precio']) ?>€</p>
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