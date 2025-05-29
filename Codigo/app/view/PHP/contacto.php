<?php
session_start();

$nombre_usuario = $_SESSION['nombre_usuario'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="../CSS/contacto.css">
</head>

<body>
    <?php include "../Generales/nav.php"; ?>

    <div class="content">
        <div class="content2">
            <div class="textos">
                <h1>REDACTE SUS CONSULTAS:</h1>
                <form action="contacto.php" method="POST">
                    <textarea class="texto1" maxlength="50" name="texto1" placeholder="Introduzca su correo electrónico..." required></textarea>
                    <textarea class="texto2" maxlength="204" name="texto2" placeholder="Introduzca el texto..." required></textarea>
                    <input class="boton" type="submit" value="ENVIAR">
                </form>
            </div>

            <div class="info">
                <p>📍 RÚA MONASTEIRO DE CAAVEIRO, 1, 15010, A CORUÑA</p>
                <p>✉ CONTACTO@PELUDOG.COM</p>
                <p>📞 633928567</p>
            </div>
        </div>
        
    </div>


    <?php include "../Generales/footer.php"; ?>
</body>

</html>