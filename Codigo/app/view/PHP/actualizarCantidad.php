<?php
require_once(__DIR__ . '/../../../rutas.php');
require_once(CONTROLLER . 'ObjetoController.php');
require_once(MODEL . 'Objeto.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_objeto']) && isset($_POST['accion'])) {
        $id_objeto = intval($_POST['id_objeto']);
        $accion = $_POST['accion'];

        // Creamos el objeto controlador
        $objetoController = new ObjetoController();

        // Obtenemos el objeto actual para saber la cantidad actual
        $objetoActual = $objetoController->getObjetosById($id_objeto);

        if ($objetoActual) {
            $cantidadActual = intval($objetoActual['cantidad']);
            if ($accion === 'sumar') {
                $nuevaCantidad = $cantidadActual + 1;
            } elseif ($accion === 'restar' && $cantidadActual > 0) {
                $nuevaCantidad = $cantidadActual - 1;
            } else {
                // No hacer nada si la acción no es válida o la cantidad ya es 0
                $nuevaCantidad = $cantidadActual;
            }

            // Actualizar cantidad en la BD
            $objetoController->actualizarCantidad($id_objeto, $nuevaCantidad);
        }
    }
}

// Redirigir de vuelta a la página de lista de productos
header('Location: inventarioView.php');
exit();
