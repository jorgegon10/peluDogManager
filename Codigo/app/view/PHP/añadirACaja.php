<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'CajaController.php');
require_once(MODEL . 'Caja.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_compra = $_POST['nombre_compra'] ?? null;
    $precio_compra = $_POST['precio_compra'] ?? null;
    $formaPago = $_POST['formaPago'] ?? 'Efectivo';
    $peluqueria = $_POST['peluqueria'] ?? ($_SESSION['peluqueria'] ?? null);
    $fecha_compra = date('Y-m-d'); 



    if ($nombre_compra && $precio_compra && $peluqueria) {
        $controller = new CajaController();
        $controller->crearCaja($nombre_compra, $formaPago, $precio_compra, $fecha_compra, $peluqueria);
        header('Location: historialCaja.php'); // Redirige a la vista de caja o historial
        exit;
    } else {
        echo "Faltan datos obligatorios.";
    }
} else {
    echo "Acceso inválido.";
}
