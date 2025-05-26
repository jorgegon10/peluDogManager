<?php
require_once(__DIR__ . '/../../rutas.php'); 
require_once(CONFIG . 'dbConnection.php');
require_once(MODEL . 'ReporteDia.php');
 // ruta de config definido en rutas.php

class ReporteDiaController {

    public function getAllReportes() {
        return ReporteDia::getAllReportes();
    }

    public function getReporteByPeluqueria($peluqueria) {
        return ReporteDia::getReporteByPeluqueria($peluqueria);
    }

    public function crearReporte($num_compras, $total_compras, $fecha_compras, $peluqueria) {
    $nuevoReporte = new ReporteDia();
    $nuevoReporte->setNumCompras($num_compras);
    $nuevoReporte->setTotalCompras($total_compras);
    $nuevoReporte->setFechaCompras($fecha_compras);
    $nuevoReporte->setPeluqueria($peluqueria);

    return $nuevoReporte->create();  // Devuelve true o false
}

    public function getReporteByFecha($fecha) {
        $conn = getDBConnection();
        $sql = "SELECT * FROM reporteDia WHERE fecha_compras = :fecha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

}