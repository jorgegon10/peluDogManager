<?php
require_once(__DIR__ . '/../../rutas.php'); 
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php

class CajaController {
    public function getAllCompras() {
        return Caja::getAllCompras();
    }


    //hola
    public function getCajaByPeluqueria($peluqueria) {
        return Caja::getCajaByPeluqueria($peluqueria);
    }

    public function crearCaja($nombre_compra, $formaPago, $precio_compra, $fecha_compra, $peluqueria) {
        $nuevaCompra = new Caja();
        $nuevaCompra->setNombreCompra($nombre_compra);
        $nuevaCompra->setFormaPago($formaPago);
        $nuevaCompra->setPrecioCompra($precio_compra);
        $nuevaCompra->setFechaCompra($fecha_compra);
        $nuevaCompra->setPeluqueria($peluqueria);

        $nuevaCompra->create();
    }


}