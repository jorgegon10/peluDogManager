<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'reporteDiaController.php');
require_once(MODEL . 'Caja.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_reporte_dia'])) {

    // Obtener peluquería desde POST o sesión
    $peluqueria = $_POST['peluqueria'] ?? $_SESSION['peluqueria'] ?? null;
    if (!$peluqueria) {
        die("No hay peluquería especificada.");
    }

    // Obtener compras de la peluquería
    $cajaModel = new Caja();
    $compras = $cajaModel->getCajaByPeluqueria($peluqueria);

    if ($compras && is_array($compras)) {
        $fecha_actual = date('Y-m-d');
        $numero_compras = count($compras);
        $total_precio = 0;

        foreach ($compras as $compra) {
            $total_precio += floatval($compra['precio_compra']);
        }

        $reporteController = new reporteDiaController();
        $guardado = $reporteController->crearReporte($fecha_actual, $numero_compras, $total_precio, $peluqueria);

        if ($guardado) {
            // Redirige al listado o página de confirmación
            header("Location: reporteDiaView.php?msg=guardado");
            exit();
        } else {
            echo "Error al guardar el reporte.";
        }
    } else {
        echo "No hay compras para la peluquería.";
    }

} else {
    echo "Acceso inválido.";
}
