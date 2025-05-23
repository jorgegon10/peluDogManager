<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(CONTROLLER . 'PedidoController.php'); 
require_once(MODEL . 'Producto.php');
require_once(MODEL . 'Pedido.php');

session_start();

// Verificar si el usuario ha iniciado sesión
$nombre_usuario = $_SESSION['nombre_usuario'] ?? null;
if (!$nombre_usuario) {
    echo "<p>Error: No has iniciado sesión.</p>";
    exit;
}

// Instanciar controladores
$productController = new ProductoController();
$pedidoController = new PedidoController();

// Obtener pedidos del usuario
$pedidos = $pedidoController->getPedidosByUser($nombre_usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="../CSS/pedido.css">
</head>
<body>

<?php include "../Generales/nav.php"; ?>

<h2>Mis Pedidos</h2>


<div class="contProductos">
<div class="productos">
<?php
if (!empty($pedidos)) {
    foreach ($pedidos as $pedido) {
        $producto = $productController->getProductsById($pedido['id_producto']); // Solo devuelve un producto

        if ($producto) { ?>
            
                    <form class="formProducto" action="productodetalle.php" method="GET">
                        <div class="divProduc" onclick="this.closest('form').submit()">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id_producto']) ?>">
                            <img class="imgProducto" src="<?= htmlspecialchars($producto['imagen']) ?>" alt="">
                            <h3 id="nombre"><?= htmlspecialchars($producto['nombre_producto']) ?></h3>
                            <p id="precio"><?= htmlspecialchars($producto['precio']) ?>€</p>
                            <h3 id="numPedido>">Número de pedido: <?= htmlspecialchars($pedido['id_pedido']) ?></h3>
                        </div>
                    </form>
                
        <?php } else { ?>
            <p>No se ha encontrado información para el producto con ID <?= htmlspecialchars($pedido['id_producto']) ?>.</p>
        <?php }
    }
} else{ ?>
</div>
</div>
    <div class="sinProductos">
    <h3>No has realizado ningún pedido</h3>
    </div>
<?php } ?>




</body>
</html>
