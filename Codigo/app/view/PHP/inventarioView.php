<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ObjetoController.php');
require_once(MODEL . 'Objeto.php');
$objetos = new Objeto();
session_start();

if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}

if (isset($_SESSION['peluqueria'])) {
    $peluqueria = $_SESSION['peluqueria'];
} else {
    $peluqueria = null;
}

$objetos = $objetos->getObjetosByPeluqueria($peluqueria);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Producto</title>
    <link rel="stylesheet" href="../CSS/listaProductos.css">
    <style>
        .cantidad-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
        }
        .cantidad-control form {
            display: inline;
        }
        .cantidad-control button {
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .cantidad-control span {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include "../Generales/nav.php" ?>

    <form method="GET" action="" class="busqueda-form">
        <input type="text" placeholder="Buscar un producto..." name="busqueda"
            value="<?php if (isset($busqueda)) echo htmlspecialchars($busqueda); ?>"
            class="busqueda-input">
    </form>

    <div class="contProductos">
        <div class="productos">
            <?php
            if ($objetos) {
                foreach ($objetos as $objeto) { ?>
                    <div class="formProducto">
                        <form action="" method="GET">
                            <div class="divProduc" onclick="this.closest('form').submit()">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($objeto['id_objeto']) ?>">
                                <img class="imgProducto" src="<?= htmlspecialchars($objeto['imagen']) ?>" alt="">
                                <h3 id="nombre"><?= htmlspecialchars($objeto['nombre_objeto']) ?></h3>
                                <h2 id="precio"><?= htmlspecialchars($objeto['precio']) ?>€</h2>
                            </div>
                        </form>

                        <div class="cantidad-control ">
                            <form method="POST" action="actualizarCantidad.php">
                                <input type="hidden" name="id_objeto" value="<?= htmlspecialchars($objeto['id_objeto']) ?>">
                                <input type="hidden" name="accion" value="restar">
                                <button type="submit">−</button>
                            </form>

                            <span><?= htmlspecialchars($objeto['cantidad']) ?></span>

                            <form method="POST" action="actualizarCantidad.php">
                                <input type="hidden" name="id_objeto" value="<?= htmlspecialchars($objeto['id_objeto']) ?>">
                                <input type="hidden" name="accion" value="sumar">
                                <button type="submit">+</button>
                            </form>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <p>No se han encontrado productos.</p>
            <?php } ?>
        </div>
    </div>

    <a href="negocio.php">
    <?php include "botonAtras.php" ?>
    </a>

</body>
</html>
