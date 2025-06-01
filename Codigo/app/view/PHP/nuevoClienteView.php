<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(MODEL . 'Producto.php');

session_start();
$nombre_usuario = $_SESSION['nombre_usuario'] ?? null;

$mensaje = "";

// Inicializar variables para mantener valores tras errores
$nombrePerro = $descripcion = $peluqueria = $visitas = $precio = $imagen = $telefono = $raza = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombrePerro = $_POST['nombrePerro'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $peluqueria = $_POST['peluqueria'] ?? '';
    $visitas = $_POST['visitas'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $imagen = $_POST['imagen'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $raza = $_POST['raza'] ?? '';

    if (!preg_match('/^\d{9}$/', $telefono)) {
        $mensaje = "❌ El número de teléfono debe tener exactamente 9 dígitos.";
    } elseif (
        $nombrePerro && $descripcion && $peluqueria &&
        is_numeric($visitas) && is_numeric($precio) &&
        $imagen && $telefono && $raza
    ) {
        try {
            // Añadir fecha al final de la descripción con salto de línea
            $fecha = date('d/m/Y');
            $descripcionConFecha = $descripcion . "\n" . "[$fecha]";

            $controller = new ProductoController();
            $controller->crearProducto($nombrePerro, $precio, $descripcionConFecha, $peluqueria, $visitas, $imagen, $telefono, $raza);
            $mensaje = "✅ Perro añadido con éxito.";
            // Limpiar campos tras éxito
            $nombrePerro = $descripcion = $visitas = $precio = $imagen = $telefono = $raza = "";
        } catch (Exception $e) {
            $mensaje = "❌ Error al crear el producto: " . $e->getMessage();
        }
    } else {
        $mensaje = "❌ Por favor, completa todos los campos correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Perro</title>
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

        .formulario input, .formulario textarea {
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
    <h2>Agregar Nuevo Perro</h2>

    <?php if (!empty($mensaje)): ?>
        <div class="mensaje <?= strpos($mensaje, '❌') !== false ? 'error' : '' ?>">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nombrePerro" placeholder="Nombre del perro" value="<?= htmlspecialchars($nombrePerro) ?>" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" value="<?= htmlspecialchars($precio) ?>" required>
        <textarea name="descripcion" placeholder="Descripción" required><?= htmlspecialchars($descripcion) ?></textarea>
        <input type="text" name="peluqueria" value="<?= htmlspecialchars($_SESSION['peluqueria'] ?? '') ?>" readonly>
        <input type="number" name="visitas" placeholder="Visitas" value="<?= htmlspecialchars($visitas) ?>" required>
        <input type="text" name="imagen" placeholder="Imagen (URL o nombre archivo)" value="<?= htmlspecialchars($imagen) ?>" required>
        <input type="text" name="telefono" placeholder="Teléfono (9 dígitos)" value="<?= htmlspecialchars($telefono) ?>" required>
        <input type="text" name="raza" placeholder="Raza" value="<?= htmlspecialchars($raza) ?>" required>
        <button type="submit">Agregar Perro</button>
    </form>
</div>

<a href="listaPerros.php">
    <?php include "botonAtras.php" ?>
</a>

</body>
</html>
