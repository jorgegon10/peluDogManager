<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../rutas.php');
require_once(CONFIG . 'dbConnection.php');
require_once(MODEL . 'Usuario.php');
require_once(CONTROLLER . 'UsuarioController.php');

class TestPablo extends TestCase
{

    public function testAñadirAWishlist()
    {
        $_SESSION['nombre_usuario'] = 'usuarioTest';
        $_SESSION['wishlist'] = [];

        $id_producto = 767;

        $_POST['accion'] = 'añadirAWishlist';
        $_POST['id'] = $id_producto;

        if ($_POST['accion'] == 'añadirAWishlist') {
            //si no está en array se añade a la sesión
            if (!in_array($id_producto, $_SESSION['wishlist'])) { 
                $_SESSION['wishlist'][] = $id_producto;
                $mensaje = "¡Producto añadido a tu Wishlist!";
            } else {
                $mensaje = "Este producto ya está en tu Wishlist.";
            }
        }

        $this->assertTrue(in_array($id_producto, $_SESSION['wishlist']));
        $this->assertEquals("¡Producto añadido a tu Wishlist!", $mensaje);
    }



    //esto no es unitario, es de integración
    public function testCrearUsuario()
    {
        $nombre_usuario = 'UsuarioPrueba';
        $correo = 'usuarioPrueba@gmail.com';
        $nombreapellidos = 'Usuario Prueba';
        $contraseña = 'contraseña_secreta_1';
        $direccion = 'A Coruña';
    
        $usuarioController = new UsuarioController();

        $usuarioYaExiste = $usuarioController->getUserByName($nombre_usuario);
        if ($usuarioYaExiste) {
            $usuarioYaExiste->deleteUser();
        }
    
        $usuarioController->crearUsuario($nombre_usuario, $correo, $nombreapellidos, $contraseña, $direccion);
    
        $nuevoUsuario = $usuarioController->getUserByName($nombre_usuario);
    
        $this->assertEquals($nombre_usuario, $nuevoUsuario->getNombreUsuario());
        $this->assertEquals($correo, $nuevoUsuario->getCorreo());
        $this->assertEquals($nombreapellidos, $nuevoUsuario->getNombreApellidos());
        $this->assertEquals($direccion, $nuevoUsuario->getDireccion());
        $this->assertEquals($contraseña, $nuevoUsuario->getContraseña());
    }
}
?>
