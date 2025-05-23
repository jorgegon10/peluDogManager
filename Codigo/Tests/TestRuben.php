<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../rutas.php');
require_once(CONFIG . 'dbConnection.php');
require_once(MODEL . 'Usuario.php');
require_once(CONTROLLER . 'UsuarioController.php');

final class TestRuben extends TestCase
{

    public function testBorrarCuenta()
    {
        $nombre_usuario = 'testuser';
        $correo = 'testuser@example.com';
        $nombreapellidos = 'Test User';
        $contraseña = 'password123';
        $direccion = '123 Test St';

        $usuarioController = new UsuarioController();

        $usuarioController->crearUsuario($nombre_usuario, $correo, $nombreapellidos, $contraseña, $direccion);

        $usuario = Usuario::getUserByName($nombre_usuario);
        $this->assertNotNull($usuario);

        $usuarioController->eliminarUsuario($nombre_usuario);

        $usuario = Usuario::getUserByName($nombre_usuario);
        $this->assertNull($usuario);
    }
}
?>


