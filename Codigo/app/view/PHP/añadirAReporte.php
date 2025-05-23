<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'reporteDiaController.php');
require_once(MODEL . 'Caja.php'); // Asegúrate de que la ruta sea correcta



session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_reporte_dia'])) {
    // Obtener peluquería de la sesión
    $peluqueria = $_SESSION['peluqueria'] ?? null;

    if (!$peluqueria) {
        die("No hay peluquería en sesión.");
    }

    // Obtener las compras para esta peluquería
    $caja = new Caja();
    $compras = $caja->getCajaByPeluqueria($peluqueria);

    if ($compras && is_array($compras)) {
        $fecha_actual = date('Y-m-d');
        $numero_compras = count($compras);
        $numero_compras = (int) $numero_compras;
        var_dump($numero_compras); 
        $total_precio = 0;

        foreach ($compras as $compra) {
            $total_precio += floatval($compra['precio_compra']);
        }

        $reporteController = new reporteDiaController();
        $resultado = $reporteController->crearReporte($numero_compras,$total_precio,$fecha_actual,   $peluqueria);
        
       
         $caja->deleteCajaByPeluqueria($peluqueria);
                // Redirige a la página de éxito o muestra un mensaje
                header("Location: reporteDiaView.php");
                exit();
          

    

   }

}
    