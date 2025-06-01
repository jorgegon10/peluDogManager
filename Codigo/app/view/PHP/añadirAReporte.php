<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'reporteDiaController.php');
require_once(MODEL . 'Caja.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_reporte_dia'])) {
    $peluqueria = $_SESSION['peluqueria'] ?? null;

    if (!$peluqueria) {
        die("No hay peluquería en sesión.");
    }

    $caja = new Caja();
    $compras = $caja->getCajaByPeluqueria($peluqueria);

    if ($compras && is_array($compras)) {
        $fecha_actual = date('Y-m-d');
        $numero_compras = count($compras);
        $total_precio = 0;

        foreach ($compras as $compra) {
            $total_precio += floatval($compra['precio_compra']);
        }

        $reporteController = new reporteDiaController();

        // Verificar si ya existe un reporte segun la peluqueria y la fecha 
        $reporteExistente = $reporteController->getReporteByPeluqueriaAndFecha($peluqueria, $fecha_actual);

        if (!empty($reporteExistente)) {
            //Si ya eciste lo sumamos 
            $reporte = $reporteExistente[0]; 
            $id_reporte = $reporte['id_reporte'];

            $nuevo_num_compras = $reporte['num_compras'] + $numero_compras;
            $nuevo_total_compras = $reporte['total_compras'] + $total_precio;

            $reporteController->update($id_reporte, $nuevo_num_compras, $nuevo_total_compras, $fecha_actual, $peluqueria);
        } else {
            
            // en caso de que no existiera creamos un reporte nuevo 
            $reporteController->crearReporte($numero_compras, $total_precio, $fecha_actual, $peluqueria);
        }

       //cada vez que se crea un reporte se elimina todo el historial de caja 
        $caja->deleteCajaByPeluqueria($peluqueria);

        // Redirigir
        header("Location: reporteDiaView.php");
        exit();
    }
}
