<?php
require_once(__DIR__ . '/../../rutas.php'); 
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php

class CompraController {
    public function getAllCompras() {
        return Compra::getAllCompras();
    }
    public function getComprasByPeluqueria($peluqueria) {
        return Compra::getComprasByPeluqueria($peluqueria);
    }
    public function crearCompra($nombre_compra, $precio_compra, $peluqueria) {
        $nuevaCompra = new Compra();
        $nuevaCompra->setNombreCompra($nombre_compra);
        $nuevaCompra->setPrecioCompra($precio_compra);
        $nuevaCompra->setPeluqueria($peluqueria);
        $nuevaCompra->create();
    }
    public function modificarCompra($id_compra, $nombre_compra, $formaPago, $precio_compra, $peluqueria) {
        $compra = new Compra();
        $compra->setIdCompra($id_compra);
        $compra->setNombreCompra($nombre_compra);
        $compra->setPrecioCompra($precio_compra);
        $compra->setPeluqueria($peluqueria);
        $compra->updateCompra();
    }
    public function eliminarCompra($id_compra) {
        $compra = new Compra();
        $compra->setIdCompra($id_compra);
        $compra->deleteCompra();
    }
    public function getComprasById($id_compra) {
        return Compra::getComprasById($id_compra);
    }
    public function getComprasByNombre($nombre_compra) {
        return Compra::getComprasByNombre($nombre_compra);
    }
    
}