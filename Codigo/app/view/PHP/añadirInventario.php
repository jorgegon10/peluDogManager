<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ObjetoController.php');
require_once(MODEL . 'Objeto.php');

session_start();
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}


$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_objeto = $_POST['nombre_objeto'] ?? null;
    $cantidad = $_POST['cantidad'] ?? null;
    $peluqueria = $_POST['peluqueria'] ?? null;
    $precio = $_POST['precio'] ?? null;
    $imagen = $_POST['imagen'] ?? null;

    if ($nombre_objeto && is_numeric($cantidad) && $peluqueria && is_numeric($precio)) {
        $controller = new ObjetoController();
        $controller->crearObjeto($nombre_objeto, $cantidad, $peluqueria, $precio, $imagen);
        $mensaje = "✅ Objeto añadido con éxito.";
        // header("Location: añadirInventario.php"); // Redirigir a la página de negocio después de agregar el objeto
    } else {
        $mensaje = "❌ Por favor, completa todos los campos correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Objeto</title>
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
            max-width: 400px;
            margin: auto;
        }

        .formulario h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .formulario input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
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
    <h2>Agregar Nuevo Objeto</h2>

    <?php if (!empty($mensaje)): ?>
        <div class="mensaje <?= strpos($mensaje, '❌') !== false ? 'error' : '' ?>">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="text" name="nombre_objeto" placeholder="Nombre del objeto" required>
        <input type="number" name="cantidad" placeholder="Cantidad" required>
        <input type="text" name="peluqueria" class="form-control mb-3"  value="<?= htmlspecialchars($_SESSION['peluqueria']) ?>" readonly>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <input type="text" name="imagen" placeholder="Imagen (URL o nombre archivo)">
        <button type="submit">Agregar Objeto</button>
    </form>
</div>

<a href="inventarioView.php">
        <?php include "botonAtras.php" ?>
</a>

</body>
</html>


