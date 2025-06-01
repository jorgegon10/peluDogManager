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

    public function getReporteByPeluqueriaAndFecha($peluqueria, $fecha) {
        $conn = getDBConnection();
        $sql = "SELECT * FROM reporteDia WHERE peluqueria = :peluqueria AND fecha_compras = :fecha";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':peluqueria', $peluqueria);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id_reporte, $num_compras, $total_compras, $fecha_compras, $peluqueria) {
    return ReporteDia::update($id_reporte, $num_compras, $total_compras, $fecha_compras, $peluqueria);
}


public function getTotalComprasPorDia($peluqueria) {
    $reportes = ReporteDia::getReporteByPeluqueria($peluqueria);
    $data = [];

    foreach ($reportes as $reporte) {
        $fecha = $reporte['fecha_compras'];
        if (!isset($data[$fecha])) {
            $data[$fecha] = 0;
        }
        $data[$fecha] += $reporte['num_compras'];
    }
    ksort($data);
    return $data;
}

public function getTotalDineroPorDia($peluqueria) {
    $reportes = ReporteDia::getReporteByPeluqueria($peluqueria);
    $data = [];

    foreach ($reportes as $reporte) {
        $fecha = $reporte['fecha_compras'];
        if (!isset($data[$fecha])) {
            $data[$fecha] = 0;
        }
        $data[$fecha] += $reporte['total_compras'];
    }
    ksort($data);
    return $data;
}




}