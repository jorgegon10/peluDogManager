<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'CompraController.php'); 
require_once(MODEL . 'Compra.php');

session_start();
$nombre_usuario = $_SESSION['nombre_usuario'] ?? null;

// Inicializar mensaje
$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);

// Variables
$nombre_compra = $precio_compra = "";

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_compra = $_POST['nombre_compra'] ?? '';
    $precio_compra = $_POST['precio_compra'] ?? '';
    $peluqueria = $_SESSION['peluqueria'] ?? '';

    if ($nombre_compra && is_numeric($precio_compra) && $peluqueria) {
        try {
            $controller = new CompraController(); 
            $controller->crearCompra($nombre_compra, $precio_compra, $peluqueria);
            $_SESSION['mensaje'] = "✅ Compra registrada con éxito.";
        } catch (Exception $e) {
            $_SESSION['mensaje'] = "❌ Error al registrar la compra: " . $e->getMessage();
        }
    } else {
        $_SESSION['mensaje'] = "❌ Por favor, completa todos los campos correctamente.";
    }

    // Redirigir para evitar reenvío del formulario al refrescar
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Compra</title>
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
    <h2>Registrar Nueva Compra</h2>

    <?php if (!empty($mensaje)): ?>
        <div class="mensaje <?= strpos($mensaje, '❌') !== false ? 'error' : '' ?>">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nombre_compra" placeholder="Nombre de la compra" value="<?= htmlspecialchars($nombre_compra) ?>" required>
        <input type="number" step="0.01" name="precio_compra" placeholder="Precio de la compra" value="<?= htmlspecialchars($precio_compra) ?>" required>
        <input type="text" name="peluqueria" value="<?= htmlspecialchars($_SESSION['peluqueria'] ?? '') ?>" readonly>

        <button type="submit">Registrar Compra</button>
    </form>
</div>

<a href="añadirCompra.php">
    <?php include "botonAtras.php" ?>
</a>

</body>
</html>
