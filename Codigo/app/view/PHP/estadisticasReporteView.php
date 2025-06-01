<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ReporteDiaController.php');

session_start();

if (!isset($_SESSION['nombre_usuario'])) {
    header('Location: login.php');
    exit();
}

$peluqueria = $_SESSION['peluqueria'] ?? null;

if (!$peluqueria) {
    echo "No se encontró peluquería en la sesión.";
    exit();
}

$controller = new ReporteDiaController();

$comprasPorDia = $controller->getTotalComprasPorDia($peluqueria);
$dineroPorDia = $controller->getTotalDineroPorDia($peluqueria);

$fechas = json_encode(array_keys($comprasPorDia));
$compras = json_encode(array_values($comprasPorDia));
$dinero = json_encode(array_values($dineroPorDia));
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Gráficos de Reportes por Peluquería</title>
<link rel="stylesheet" href="../CSS/estilos.css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include "../Generales/nav.php"; ?>

<h1>Reporte de Compras y Dinero por Día (Peluquería: <?= htmlspecialchars($peluqueria) ?>)</h1>

<div style="width: 90%; max-width: 900px; margin: 0 auto;">
    <canvas id="comprasChart" style="margin-bottom: 40px;"></canvas>
    <canvas id="dineroChart"></canvas>
</div>

<script>
const fechas = <?php echo $fechas; ?>;
const compras = <?php echo $compras; ?>;
const dinero = <?php echo $dinero; ?>;

new Chart(document.getElementById('comprasChart'), {
    type: 'bar',
    data: {
        labels: fechas,
        datasets: [{
            label: 'Total Compras',
            data: compras,
            backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});

new Chart(document.getElementById('dineroChart'), {
    type: 'line',
    data: {
        labels: fechas,
        datasets: [{
            label: 'Total Dinero',
            data: dinero,
            borderColor: 'rgba(255, 99, 132, 0.7)',
            fill: false,
            tension: 0.1
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});
</script>

 <a href="opcionesCaja.php">
    <?php include "botonAtras.php" ?>
    </a>

</body>
</html>
