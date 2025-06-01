<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'CajaController.php');
require_once(MODEL . 'Caja.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formaPago = $_POST['formaPago'] ?? 'Efectivo';
    $peluqueria = $_POST['peluqueria'] ?? ($_SESSION['peluqueria'] ?? null);
    $fecha_compra = date('Y-m-d');

    // Detectar si viene del formulario de compra o de objeto
    $nombre = $_POST['nombre_compra'] ?? $_POST['nombre_objeto'] ?? null;
    $precio = $_POST['precio_compra'] ?? $_POST['precio_objeto'] ?? null;

    // Quitar "€" si viene del formulario de objetos
    $precio = is_string($precio) ? str_replace('€', '', $precio) : $precio;

    if ($nombre && $precio && $peluqueria) {
        $controller = new CajaController();
        $controller->crearCaja($nombre, $formaPago, $precio, $fecha_compra, $peluqueria);
        header('Location: historialCaja.php');
        exit;
    } else {
        echo "Faltan datos obligatorios.";
    }
} else {
    echo "Acceso inválido.";
}
