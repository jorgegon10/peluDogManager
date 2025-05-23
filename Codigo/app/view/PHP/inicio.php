<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ProductoController.php');
require_once(MODEL . 'Producto.php');
$productController = new ProductoController();
$productos = $productController->getAllProducts();
session_start();

if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
} else {
    $nombre_usuario = null;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../CSS/inicio.css">
</head>



<body onload="setInterval('Blink()',600)">
    <script>
        function Blink() {
            var ElemsBlink = document.getElementsByTagName('blink');
            for (var i = 0; i < ElemsBlink.length; i++)
                ElemsBlink[i].style.visibility = ElemsBlink[i].style.visibility ==
                'visible' ? 'hidden' : 'visible';
        }
    </script>


    <div class="distribuidor">
        <div class="content">
            <?php include "../Generales/nav.php" ?>
            <img class="imgFondo1" src="/proyectoPelu/Codigo/app/view/Img/fondo_pelu.webp" alt="">

            <div class="texto1">
                <h1>PeluDog Manager</h1>
                <h2>Simplifica tu día a día en la peluquería canina con nuestra plataforma</h2>
            </div>

            <div class="contMateriales">
                <div id="imagenTejidos">
                    <img id="tejidos" src="/proyectoPelu/Codigo/app/view/img/princi1.png" alt="">
                </div>
                <div class="textoTejidos">
                        <h4>¡Hola! Bienvenido a tu nueva herramienta favorita.</h4>
                        <p>Aquí podrás llevar el control de todos tus clientes peludos, anotar qué servicios hiciste, cuándo vino cada uno y mucho más. Todo fácil, rápido y sin complicaciones. ¡Tu peluquería lo va a agradecer!</p>
                </div>

            </div>

            <div class="contMateriales">
                <div class="textoTejidos">
                    <h4>¿Shampoo, snacks, cobros y clientes? ¡Todo en un mismo lugar!</h4>
                    <p>Con nuestra app tenés todo lo que tu peluquería necesita para trabajar mejor: inventario, caja, fichas de mascotas y más. Empezá a usarla hoy y hacete la vida más fácil 🐶✨</p>
                </div>
                <div id="imagenTejidos">
                    <img id="tejidos" src="/proyectoPelu/Codigo/app/view/Img/princi2.png" alt="">
                </div>

            </div>

    
    </div>

            <?php include "../Generales/footer.php" ?>
        </div>

    </div>

</body>

</html>