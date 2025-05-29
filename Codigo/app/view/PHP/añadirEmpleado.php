<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'UsuarioController.php');
require_once(MODEL . 'Usuario.php');

session_start();
$mensaje = "";

$controller = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $apellido1 = $_POST['apellido1'] ?? '';
    $apellido2 = $_POST['apellido2'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $peluqueria = $_SESSION['peluqueria'] ?? '';
    $puesto = $_POST['puesto'] ?? '';
    $administrador = isset($_POST['administrador']) ? 1 : 0;
    $activo = isset($_POST['activo']) ? 1 : 0;
    $imagen = $_POST['imagen'] ?? '';

    // Establecer imagen por defecto si no se proporciona
    if (empty($imagen)) {
        $imagen = '/ProyectoFinal/Codigo/app/view/Img/user.png';
    }

    if ($nombre_usuario && $correo && $nombre && $apellido1 && $contraseña && $peluqueria) {
        $controller->crearUsuario($nombre_usuario, $correo, $nombre, $apellido1, $apellido2, $imagen, $contraseña, $direccion, $peluqueria, $puesto, $administrador, $activo);
        $mensaje = "✅ Empleado añadido con éxito.";
    } else {
        $mensaje = "❌ Por favor, completa los campos obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Empleado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        .formulario {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        .formulario h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .formulario input,
        .formulario select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .formulario label {
            font-weight: bold;
        }

        .formulario button {
            background: #654321;
            color: #fff;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }

        .mensaje {
            text-align: center;
            margin-bottom: 15px;
            color: #333;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="formulario">
    <h2>Agregar Nuevo Empleado</h2>

    <?php if (!empty($mensaje)): ?>
        <div class="mensaje <?= strpos($mensaje, '❌') !== false ? 'error' : '' ?>">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido1" placeholder="Primer apellido" required>
        <input type="text" name="apellido2" placeholder="Segundo apellido">
        <input type="password" name="contraseña" placeholder="Contraseña" required>
        <input type="text" name="direccion" placeholder="Dirección">
        <input type="text" name="puesto" placeholder="Puesto">
        <input type="text" name="imagen" placeholder="URL de imagen (opcional)">
        <label><input type="checkbox" name="administrador"> ¿Es administrador?</label>
        <label><input type="checkbox" name="activo" checked> ¿Está activo?</label>
        <input type="text" name="peluqueria" value="<?= htmlspecialchars($_SESSION['peluqueria'] ?? '') ?>" readonly>

        <button type="submit">Agregar Empleado</button>
    </form>
</div>

<a href="negocio.php">
    <?php include "botonAtras.php" ?>
</a>

</body>
</html>
