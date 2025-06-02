<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Codigo/app/controller/UsuarioController.php';

class UsuarioControllerTest extends TestCase {

    public function testCrearUsuarioValido() {
        $controller = new UsuarioController();

        // Datos ficticios para prueba
        $resultado = $controller->crearUsuario(
            "testuser",
            "test@example.com",
            "Test",
            "Apellido1",
            "Apellido2",
            "/img/user.png",
            "clave123",
            "Calle Test 123",
            "PeluqueriaPrueba",
            "Estilista",
            1, // admin
            1  // activo
        );

        // Puedes cambiar esto según lo que devuelva tu método
        $this->assertTrue($resultado); // O assertIsInt($resultado) si devuelve un ID
    }

    public function testCrearUsuarioSinNombreUsuario() {
        $controller = new UsuarioController();

        $this->expectException(Exception::class); // Cambia esto si lanzas una excepción propia

        $controller->crearUsuario(
            "",
            "correo@example.com",
            "Nombre",
            "Apellido",
            "",
            "/img/user.png",
            "1234",
            "Dirección",
            "Peluquería",
            "Puesto",
            0,
            1
        );
    }
}
