<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(MODEL . 'Producto.php');
require_once(CONTROLLER . 'UsuarioController.php');
require_once(MODEL . 'Usuario.php');

$productController = new ProductoController();
$usuarioController = new UsuarioController();
session_start();

// Si el usuario está logueado
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}

// Comprobamos si hay búsqueda
$busqueda = null;
if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    // Si hay búsqueda, filtramos por nombre
    $productos = $productController->getProductsByName($busqueda);
} else {
    // Si no hay búsqueda, mostramos todos los productos
    $productos = $productController->getAllProducts();
}

// Comprobamos si se ha seleccionado un deporte
$deporte = null;
if (isset($_POST['deporte']) && !empty($_POST['deporte'])) {
    $deporte = $_POST['deporte'];  // Si hay deporte seleccionado, filtramos por deporte
}

// Si hay un deporte seleccionado, filtramos los productos por deporte
// if ($deporte) {


if (isset($_SESSION['peluqueria'])) {
    $peluqueria = $_SESSION['peluqueria'];
} else {
    $peluqueria= null;
}
    
    $usuarios = $usuarioController->getUsersByPeluqueria($peluqueria);

    
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="../CSS/empleados.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>

<body>

    <?php include "../Generales/nav.php" ?>

    
<!-- <a href="añadirEmpleado.php" id="añadir" class="btn" display="none">
    <i class="fas fa-user-plus"></i>
    Añadir Empleado
</a> -->

    <div class="contProductos">
        <div class="productos">
            <?php
            if ($usuarios) {
                foreach ($usuarios as $usuario) { ?>
                    <form class="formProducto" action="" method="GET">
                        <div class="divProduc" onclick="this.closest('form').submit()">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">
                            <img class="imgProducto" src="<?= htmlspecialchars($usuario['imagen']) ?>" alt="">
                            <input type="hidden" name="nombre_usuario" value="<?= htmlspecialchars($usuario['nombre_usuario']) ?>">
                            <h3 id="nombre"><?= htmlspecialchars($usuario['nombre_usuario']) ?></h3>
                            <p><?= htmlspecialchars($usuario['puesto']) ?></p>
       
                        </div>
                    </form>
                <?php }
            } else { ?>
                <p>No se han encontrado productos.</p>
                <?php
                } 
                    ?>
        </div>
    </div>

    <?php
           
           // Con este código si el usuario logueado es administador (jefe) aparece el boton para añadir empleados
           $logueado = $usuarioController->getUserByName2($nombre_usuario);
           
           if ($logueado && isset($logueado['administrador']) && $logueado['administrador'] == 1) { ?>
               <script>
                   document.addEventListener("DOMContentLoaded", function() {
                       document.getElementById("añadir").style.display = "block";
                   });
               </script>
           <?php } ?>
           

 <a href="negocio.php">
    <?php include "botonAtras.php" ?>
</a>

<a href="añadirEmpleado.php" class="boton-flotante" id="añadir" display="none">+</a>
            

</body>

</html>