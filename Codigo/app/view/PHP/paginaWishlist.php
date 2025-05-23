<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'WishlistController.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(MODEL . 'Producto.php');
require_once(MODEL . 'Wishlist.php');

session_start();
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

$productController = new ProductoController();
$wishlistController = new WishlistController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Añadir a la wishlist en la sesión
    if (isset($_POST['accion']) && $_POST['accion'] == 'añadirAWishlist') {
        $id_producto = (int) $_POST['id_producto'];

        // para que no haya duplicados
        if (!in_array($id_producto, $_SESSION['wishlist'], true)) {
            $_SESSION['wishlist'][] = $id_producto;
        }
    }

    // Eliminar de la sesión y base de datos
    if (isset($_POST['accion']) && $_POST['accion'] == 'eliminarDeWishlist') {
        $id_producto = (int) $_POST['id_producto']; 
        // Eliminar de la sesión
        if (($key = array_search($id_producto, $_SESSION['wishlist'], true)) !== false) {
            unset($_SESSION['wishlist'][$key]);
            $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
        }

        // Eliminar de la base de datos
        $wishlistController->removeProductFromWishlist($nombre_usuario, $id_producto);
    }

    // Guardar wishlist en la base de datos
    if (isset($_POST['accion']) && $_POST['accion'] == 'guardarEnBaseDeDatos') {
        foreach ($_SESSION['wishlist'] as $id_producto) {
            $wishlistController->addProductToWishlist($nombre_usuario, $id_producto);
        }
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$productos_wishlist = [];
foreach ($_SESSION['wishlist'] as $id) {
    $producto = $productController->getProductsById($id);
    if ($producto) {
        $productos_wishlist[] = $producto;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="../CSS/paginaWishlist.css">
</head>
<body>
    <div class="content">
        <?php include "../Generales/nav.php"; ?>
        <h2>Mi wishlist</h2>

        <?php if (!empty($productos_wishlist)) { ?>
     <div class="contProductos">
         <div class="productos">
                <?php foreach ($productos_wishlist as $producto) { ?>
                    <div class="formProducto">
                        <div class="divProduc">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id_producto']) ?>">
                            <img class="imgProducto" src="<?= htmlspecialchars($producto['imagen']) ?>" alt="">
                            <h3 id="likes"><?= htmlspecialchars($producto['likes']) . " &#x2764;" ?></h3>
                            <h3 id="nombre"><?= htmlspecialchars($producto['nombre_producto']) ?></h3>
                            <p id="precio"><?= htmlspecialchars($producto['precio']) ?>€</p>
                            <!-- Eliminar de la sesion  -->
                             <form action="paginaWishlist.php" method="POST">
                                <input type="hidden" name="id_producto" value="<?= htmlspecialchars($producto['id_producto']) ?>">
                                <input type="hidden" name="accion" value="eliminarDeWishlist">
                                <button type="submit" class="btnEliminar">Eliminar</button>
                            </form>

                            <!-- Guardar en la base de datos -->
                            <form action="paginaWishlist.php" method="POST">
                                <input type="hidden" name="accion" value="guardarEnBaseDeDatos">
                                <button type="submit" class="btnGuardar">Guardar</button>
                            </form> 
                            
                        </div>
                </div>     
                   
                <?php } ?>
            
        <?php } else { ?>
            <div class="sinProductos">
            <h3>No tienes productos en tu wishlist.</h3>
            </div>
        <?php } ?>
        
        </div>
    </div>


   
</body>


</html>
