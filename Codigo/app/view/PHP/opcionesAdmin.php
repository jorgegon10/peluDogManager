<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(MODEL . 'Producto.php');

session_start();
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}

// Verificar si el usuario es admin
// if (!isset($_SESSION['nombre_usuario']) || $_SESSION['nombre_usuario'] !== 'admin') {
//     echo "<h3>Acceso denegado</h3>";
//     echo "<p>No tienes permisos de admin.</p>";
//     echo "<p><a href='inicio.php'><button>Volver a inicio</button></a></p>";
//     exit();
// }

$productController = new ProductoController();
$productos = $productController->getAllProducts();

// Crear producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['formCreate']) && $_POST['formCreate'] == 'crearProducto') {
        if (!empty($_POST["nombrePerro"]) && !empty($_POST["descripcion"]) && !empty($_POST["peluqueria"]) && is_numeric($_POST["visitas"])) {
            $nombrePerro = htmlspecialchars($_POST["nombrePerro"]);
            $descripcion = htmlspecialchars($_POST["descripcion"]);
            $peluqueria = htmlspecialchars($_POST["peluqueria"]);
            $visitas = htmlspecialchars($_POST["visitas"]);
            $precio = htmlspecialchars($_POST["precio"]);
            $imagen = htmlspecialchars($_POST["imagen"]);
            $telefono = htmlspecialchars($_POST["telefono"]);
            $raza = htmlspecialchars($_POST["raza"]);



            if (filter_var($precio, FILTER_VALIDATE_FLOAT)) {
                $productController->crearProducto($nombrePerro, $precio, $descripcion, $peluqueria, $visitas, $imagen , $telefono, $raza);
            }
        }
        header("Location: opcionesAdmin.php");
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Perro</title>
    <link rel="stylesheet" href="../CSS/opcionesAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <?php include "../Generales/nav.php"; ?>

    <h1>Nuevo Perro</h1>

    
    <div class="pestaña" >
        <form action="opcionesAdmin.php" method="POST">

        
        <input type="hidden" name="formCreate" value="crearProducto">
        <div class="nuevoPerro">
            

            <div>

                <b>Nombre:</b>
                <input type="text" name="nombrePerro"  class="form-control mb-3" placeholder="Nombre Perro" required>

            </div>
                
            <div>
                <b>Precio:</b>
                <input type="number" step="0.01" name="precio"  class="form-control mb-3"  placeholder="Precio"  required>
            </div>
                
            <div>
                <b>Descripcion:</b>
                <textarea name="descripcion" class="form-control mb-3" placeholder="Descripción" required></textarea>
            </div>           
            <div>
                <!-- Aquí ya damos por defecto la peluqueria que tenemos guardada en la sesión -->
                <b>Peluqueria:</b>
                <input type="text" name="peluqueria" class="form-control mb-3"  value="<?= htmlspecialchars($_SESSION['peluqueria']) ?>" readonly>
            </div>           
            <div>
                <b>Visitas:</b>
                <input type="number" name="visitas" class="form-control mb-3" placeholder="Visitas" required>
            </div>    
            <div>
                <b>Imagen:</b>
                <input type="text" name="imagen" class="form-control mb-3" placeholder="Imagen" required>
            </div>
            <div>
                <b>Teléfono:</b>
                <input type="number"  name="telefono" class="form-control mb-3" placeholder="Teléfono" required>
            </div>
                
            <div>
                <b>Raza:</b>
                <input type="text" name="raza" class="form-control mb-3" placeholder="Raza" required>
            </div>
            
        </div>
            
            


            <input type="submit" value="Guardar" style="background-color: rgb(104,86,52); color: white" class="nuevo">
        </form>

        
    </div>
</body>

</html>
