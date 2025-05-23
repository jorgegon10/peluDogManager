<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../rutas.php');
require_once(MODEL . 'Producto.php');
require_once(CONTROLLER . 'ProductoController.php');

class TestJorge extends TestCase
{
    public function testObtenerPorDeporte()
    {

        $deporte = 'fútbol';
        $productController = new ProductoController();

        $productos = $productController->getProductsBySport($deporte);

        // Comprobamos que todos los productos sean de fútbol
        foreach ($productos as $producto) {
            $this->assertEquals($deporte, $producto->getDeporte());
        }
    }

    }

