<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(CONTROLLER . 'PedidoController.php');
require_once(MODEL . 'Producto.php');
require_once(CONTROLLER . 'UsuarioController.php');
require_once(MODEL . 'Usuario.php');

$productController = new ProductoController();
$pedidoController = new PedidoController();
$usuarioController = new UsuarioController();

session_start();

if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}

$usuario = $usuarioController->getUserByName($nombre_usuario);

// Obtenemos el ID del producto vía GET o POST
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
} else {
    $id_producto = $_POST["id_producto"] ?? null;
}

if (!$id_producto) {
    echo "Producto no encontrado.";
    exit;
}

// Procesamos el formulario sólo si viene por POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['formUpdate']) && $_POST['formUpdate'] == 'formulario') {
    if (!empty($id_producto) && is_numeric($id_producto)) {
        $updated = false;

        // Modificar nombre si viene
        if (!empty($_POST["nombre_perro"])) {
            $nuevoNombrePerro = htmlspecialchars($_POST["nombre_perro"]);
            $productController->modificarNombreProducto($id_producto, $nuevoNombrePerro);
            $updated = true;
        }

        // Modificar descripción si viene
        if (!empty($_POST["nuevaDescripcion"])) {
            $nuevaDescripcion = htmlspecialchars($_POST["nuevaDescripcion"]);
            $productController->modificarDescripcion($id_producto, $nuevaDescripcion);
            $updated = true;
        }

        if ($updated) {
            // Redirigir para evitar reenvío del formulario al refrescar
            header("Location: productoDetalle.php?id=$id_producto");
            exit();
        }
    } else {
        echo "Error: ID de producto no válido.";
        exit;
    }
}

// Cargamos los datos del producto (para mostrar en el formulario)
$perro = $productController->getProductsById($id_producto);

if (!$perro) {
    echo "Producto no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <link rel="stylesheet" href="../CSS/productoDetalle.css">
    <link rel="stylesheet" href="../CSS/opcionesAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <?php include "../Generales/nav.php" ?>

    <div class="main-container">
        <div class="detalleProducto">
            <div class="imagenProducto">
                <img src="<?= htmlspecialchars($perro['imagen']) ?>" alt="Imagen del producto" >
            </div>

            <div class="infoProducto">

                <form id="formulario" method="POST">
                    <input type="hidden" name="formUpdate" value="formulario">
                    <input type="hidden" name="id_producto" value="<?= htmlspecialchars($perro['id_producto']) ?>">

                    <div style="display: flex; gap:5%">
                        <div>
                            <label for="nombre_perro">Nombre:</label>
                            <input type="text" id="nombre_perro" name="nombre_perro" class="form-control mb-3" 
                                value="<?= htmlspecialchars($perro['nombre_perro']) ?>" readonly>
                        </div>
                        <div>
                            <label for="raza">Raza:</label>
                            <input type="text" id="raza" name="raza"  class="form-control mb-3" 
                                value="<?= htmlspecialchars($perro['raza']) ?>" readonly>
                        </div>
                    </div>

                    <div style="display: flex; gap:5%">
                        <div>
                            <label for="precio">Precio:</label>
                            <input type="text" id="precio" name="precio"  class="form-control mb-3" 
                                value="<?= htmlspecialchars($perro['precio']) ?>€" readonly>
                        </div>
                        <div>
                            <label for="telefono">Telefono:</label>
                            <input type="text" id="telefono" name="telefono"   class="form-control mb-3" 
                                value="<?= htmlspecialchars($perro['telefono']) ?>" readonly>
                        </div>
                    </div>

                    <label for="descripcion" style="display: block;">Observaciones:</label>
                    <textarea id="descripcion" name="descripcion"  class="form-control mb-3" readonly><?= htmlspecialchars($perro['descripcion']) ?></textarea>

                    <textarea id="nuevaDescripcion" name="nuevaDescripcion"  class="form-control mb-3" style="display: none;" placeholder="Añade observción..."></textarea>

                    <button type="button" id="editar">Editar</button>
                    <button type="submit" id="guardar" style="display: none;">Guardar</button>
                </form>

                <script>
                    document.getElementById('editar').addEventListener('click', function () {
                        // Habilitar los campos editables
                        document.getElementById('nombre_perro').removeAttribute('readonly');
                        document.getElementById('precio').removeAttribute('readonly');
                        // document.getElementById('descripcion').removeAttribute('readonly'); // lo dejas comentado, ok
                        document.getElementById('raza').removeAttribute('readonly');
                        document.getElementById('nuevaDescripcion').style.display="block";

                        // Mostrar botón guardar y ocultar editar
                        document.getElementById('guardar').style.display = 'inline-block';
                        this.style.display = 'none';
                    });
                </script>

            </div>
        </div>
    </div>

    <a href="listaPerros.php">
    <?php include "botonAtras.php" ?>
</a>

</body>

</html>
