<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(MODEL . 'Producto.php');
require_once(CONTROLLER . 'UsuarioController.php');
require_once(MODEL . 'Usuario.php');

$productController = new ProductoController();

session_start();

// Si el usuario está logueado
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    
} else {

   
    header("Location: login.php");
    exit();
    
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Empresarial</title>
    <link rel="stylesheet" href="../CSS/negocio.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body>
<?php include "../Generales/nav.php" ?>
<?php 

   
    
$usuarioController = new UsuarioController();

$usuario1 = $usuarioController->getUserByName($nombre_usuario);

$peluqueria = $usuario1->getPeluqueria();
 
$_SESSION['peluqueria'] = $peluqueria;


?>

    <div class="container">
        <header>
            <h1> Caja de <?php  echo $peluqueria ?></h1>
        </header>
        
        <div class="buttons-grid">
            <form action="añadirCompra.php" method="GET">
                <button class="btn" type="submit">
                <i class="fas fa-users"></i>
                Añadir Compra
                </button>
            </form>
            <form action="configurarNuevaCompra.php" method="GET">
                <button class="btn" type="submit">
                <i class="fas fa-plus"></i>
                Configurar Nueva Compra
                </button>
            </form>
            <form action="historialCaja.php" method="GET">
                <button class="btn" type="submit">
                    <i class="fas fa-box"></i>
                 Historial Caja 
                </button>
            </form>
            
            <form action="inventario.php" method="GET">
                <button class="btn" type="submit">
                    <i class="fas fa-box"></i>
                Sacar ticket
                </button>
            </form>
            
            <form action="estadisticasReporteView.php" method="GET">
                <button class="btn" type="submit">
                <i class="fa-solid fa-chart-line"></i>
                Estadísticas Caja
                </button>
            </form>

            <form action="reporteDiaView.php" method="GET">
                <button class="btn" type="submit">
                    <i class="fas fa-box"></i>
                 Reportes diarios 
                </button>
            </form>



           
            
        </div>
    </div>

    <a href="negocio.php">
    <?php include "botonAtras.php" ?>
    </a>
   
</body>
</html>