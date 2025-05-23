
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'UsuarioController.php');
require_once(MODEL . 'Usuario.php');

session_start();

if (isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.php"); // al logearse redirige a inicio
    exit();
}

?>
<div class="popup">


<h2>PeluDog Manager</h2>

<form action="login.php" method="POST">
    <p>Nombre de usuario: </p>
    
    <input type="text" name="nombre_usuario"  class="form-control mb-3" placeholder="Nombre Usuario" required>
   
    <p>Contraseña:</p> 
    
    <input type="password" name="contraseña"  class="form-control mb-3" placeholder="Contraseña" required>
    
    <input type="submit" class=" btn btn-primary w-100">

    
</form>


    <p id="pregunta">¿No tienes cuenta?</p>
    <a href="../PHP/registro.php">Registrarse</a>
    <a href="../PHP/inicio.php">Volver al Inicio</a>
<?php

$usuarioController = new UsuarioController();

if (isset($_POST['nombre_usuario'], $_POST['contraseña'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    $usuario = $usuarioController->getUserByName($nombre_usuario);

    if ($usuario==true) {
        if ($contraseña == $usuario->getContraseña()) {
            $_SESSION['nombre_usuario'] = $usuario->getNombreUsuario();
            header("Location: negocio.php"); 
            exit();
        } else {
            echo "<p>Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p>El usuario no existe</p>";
    }
}

?>

</div>
</body>
</html>





