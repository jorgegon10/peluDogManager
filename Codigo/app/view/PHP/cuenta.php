    <?php
    require_once(__DIR__ . '/../../../rutas.php');
    require_once(CONTROLLER . 'UsuarioController.php');
    require_once(MODEL . 'Usuario.php');

    session_start();

    // comprobamos si el usuario no está logeado
    if (!isset($_SESSION['nombre_usuario'])) {
        header("Location: login.php");
        exit();
    }

    $usuarioController = new UsuarioController();
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $usuario = $usuarioController->getUserByName($nombre_usuario);

    // Variable para el mensaje de error
    $mensaje_error = '';

    function comprobarContraseñaActual($contraseña_actual, $usuario)
    {
        return $contraseña_actual === $usuario->getContraseña();
    }

    function cerrarSesion($usuario) {
        session_destroy();
        header("Location: login.php");

        exit();
    }
    
    function borrarCuenta($usuarioController, $nombre_usuario) {
        $usuarioController->eliminarUsuario($nombre_usuario);
        session_destroy();
        header("Location: login.php");

        exit();
    }

    // if (isset($_POST['modificar'])) {
    //     $contraseña_actual = $_POST['contraseña_actual'];
    //     $nuevo_nombre_usuario = $_POST['nombre_usuario'];
    //     $correo = $_POST['correo'];
    //     $contraseña = $_POST['contraseña'];
    //     $direccion = $_POST['direccion'];

    //     // Comparar la contraseña actual con la almacenada (en texto plano)
    //     if (comprobarContraseñaActual($contraseña_actual, $usuario)) {
    //         // Contraseña correcta, proceder con la modificación
    //         $usuarioController->modificarUsuario($nombre_usuario, $correo, $usuario->getNombreApellidos(), $contraseña, $direccion,$peluqueria);

    //         if ($nuevo_nombre_usuario !== $nombre_usuario) {
    //             $_SESSION['nombre_usuario'] = $nuevo_nombre_usuario;
    //             $usuarioController->modificarNombreUsuario($nombre_usuario, $nuevo_nombre_usuario);
    //         }

    //         header("Location: cuenta.php");
    //         exit();
    //     } else {
    //         $mensaje_error = "La contraseña actual es incorrecta.";
    //     }
    // }

    // borrar cuenta
    if (isset($_POST['borrar_cuenta'])) {
        $contraseña_actual = $_POST['contraseña_actual'];

        if (comprobarContraseñaActual($contraseña_actual, $usuario)) {       
            borrarCuenta($usuarioController, $nombre_usuario);

        } else {
            $mensaje_error = "La contraseña actual es incorrecta.";
        }
    }

    // cerrar sesión
    if (isset($_POST['cerrar_sesion'])) {
        $contraseña_actual = $_POST['contraseña_actual'];
        if (comprobarContraseñaActual($contraseña_actual, $usuario)) {
            cerrarSesion($usuario);

        } else {
            $mensaje_error = "La contraseña actual es incorrecta.";
        }
    }
    ?>


    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cuenta</title>
        <link rel="stylesheet" href="../CSS/cuenta.css">
    </head>

    <body>
        <?php include "../Generales/nav.php" ?>
        <h1>Datos personales</h1>
        <div class="content">
            <form action="cuenta.php" method="POST">
                <div>
                    <b>Nombre de usuario:</b><br>
                    <input type="text" name="nombre_usuario" value="<?= htmlspecialchars($usuario->getNombreUsuario()) ?>">
                </div>

                <div>
                    <b>Correo:</b><br>
                    <input type="email" name="correo" value="<?= htmlspecialchars($usuario->getCorreo()) ?>">
                </div>

                <div>
                    <b>Contraseña:</b><br>
                    <input type="password" name="contraseña" value="<?= htmlspecialchars($usuario->getContraseña()) ?>">
                </div>

                <div>
                    <b>Dirección:</b><br>
                    <input type="text" name="direccion" value="<?= htmlspecialchars($usuario->getDireccion()) ?>">
                </div>
                <div>
                    <b>Dirección:</b><br>
                    <input type="text" name="direccion" value="<?= htmlspecialchars($usuario->getPeluqueria()) ?>">
                </div>

                <br>
                <div>
                    <b>Contraseña actual:</b><br>
                    <input type="password" name="contraseña_actual" required>
                </div>

                <!-- Mostrar el mensaje de error solo si hay uno -->
                <?php if ($mensaje_error){ ?>
                    <p style="color:red;"><?= htmlspecialchars($mensaje_error) ?></p>
                <?php }?>

                <br>
                <div>
                    <button type="submit" name="modificar" style="background-color: rgb(104,86,52); color: white">Modificar</button>
                </div>
                <br>
                <div>
                    <button type="submit" name="cerrar_sesion" style="background-color: red;  color: white">Cerrar sesión</button>
                    <button type="submit" name="borrar_cuenta" style="background-color: red;  color: white">Borrar cuenta</button>
                </div>
            </form>
        </div>
    </body>


    </html>