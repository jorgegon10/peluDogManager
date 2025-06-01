<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(CONTROLLER . 'ObjetoController.php');
require_once(CONTROLLER . 'CompraController.php');

require_once(MODEL . 'Objeto.php');
require_once(MODEL . 'Compra.php');
session_start();

$compras = new Compra();
$objetoController = new ObjetoController();

$nombre_usuario = $_SESSION['nombre_usuario'] ?? null;
$peluqueria = $_SESSION['peluqueria'] ?? null;

$compras = $compras->getComprasByPeluqueria($peluqueria);
$objetos = $objetoController->getObjetosByPeluqueria($peluqueria);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Compra</title>
    <link rel="stylesheet" href="../CSS/añadirCompra.css">
</head>
<body>

<?php include "../Generales/nav.php" ?>

<div class="contProductos">
    <div class="productos">
        <div class="cabecera">
            <h2>Descripción</h2>
            <h2>Forma de Pago</h2>
            <h2>Precio</h2>
        </div>

        <!-- Formulario para objetos -->
        <form class="formProducto" action="añadirACaja.php" method="POST">
            <div class="divProduc">
                <div class="col">
                    <select name="nombre_objeto" id="nombre_objeto" required>
                        <option value="" disabled selected>Selecciona un objeto</option>
                        <?php foreach ($objetos as $objeto): ?>
                            <option value="<?= htmlspecialchars($objeto['nombre_objeto']) ?>" data-precio="<?= htmlspecialchars($objeto['precio']) ?>">
                                <?= htmlspecialchars($objeto['nombre_objeto']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col">
                    <select name="formaPago" required>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                    </select>
                </div>

                <div class="col">
                    <input type="text" name="precio_objeto" id="precio_objeto" readonly placeholder="Precio (€)">
                    <input type="hidden" name="peluqueria" value="<?= htmlspecialchars($peluqueria) ?>">
                    <button type="submit">Añadir a Caja</button>
                </div>
            </div>
        </form>

        <!-- Formulario para compras -->
        <?php if ($compras): ?>
            <?php foreach ($compras as $compra): ?>
                <form class="formProducto" action="añadirACaja.php" method="POST">
                    <div class="divProduc">
                        <div class="col">
                            <input type="hidden" name="nombre_compra" value="<?= htmlspecialchars($compra['nombre_compra']) ?>">
                            <input type="hidden" name="precio_compra" value="<?= htmlspecialchars($compra['precio_compra']) ?>">
                            <input type="hidden" name="peluqueria" value="<?= htmlspecialchars($peluqueria) ?>">
                            <h3><?= htmlspecialchars($compra['nombre_compra']) ?></h3>
                        </div>

                        <div class="col">
                            <select name="formaPago" required>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta</option>
                            </select>
                        </div>

                        <div class="col">
                            <p><?= htmlspecialchars($compra['precio_compra']) ?>€</p>
                            <button type="submit">Añadir a Caja</button>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se han encontrado productos.</p>
        <?php endif; ?>
    </div>
</div>

<a href="opcionesCaja.php">
    <?php include "botonAtras.php" ?>
</a>

<script>
    const selectObjeto = document.getElementById('nombre_objeto');
    const inputPrecio = document.getElementById('precio_objeto');

    selectObjeto.addEventListener('change', function () {
        const precio = this.options[this.selectedIndex].getAttribute('data-precio');
        inputPrecio.value = precio + '€';
    });
</script>

</body>
</html>
