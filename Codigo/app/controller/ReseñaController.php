<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); 
require_once(MODEL . 'Reseña.php'); 

class ReseñaController {
    public function getReseñasByProducto($id_producto) {
        return Reseña::getReseñasByProduct($id_producto);
    }

    public function crearReseña($texto, $puntuacion, $nombre_usuario_reseña, $id_producto_reseña) {
        $nuevaReseña = new Reseña();
        $nuevaReseña->setTexto($texto);
        $nuevaReseña->setPuntuacion($puntuacion);
        $nuevaReseña->setNombreUsuarioReseña($nombre_usuario_reseña);
        $nuevaReseña->setIdProductoReseña($id_producto_reseña);

        $nuevaReseña->create();
    }

    public function eliminarReseña($id_reseña) {
        Reseña::deleteReseña($id_reseña);
    }

    public function eliminarReseñasPorUsuario($nombre_usuario) {
        Reseña::deleteReseñasByUsuario($nombre_usuario);
    }
}
