<?php
require_once(__DIR__ . '/../../rutas.php'); 
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php

class ObjetoController {


    public function getAllObjetos() {
        return Objeto::getAllObjetos();
    }

    public function getObjetosByName($nombre_objeto) {
        return Objeto::getObjetoByName($nombre_objeto);
    }

    public function crearObjeto($nombre_objeto, $cantidad, $peluqueria, $precio, $imagen) {
        $nuevoObjeto = new Objeto();
        $nuevoObjeto->setNombreObjeto($nombre_objeto);
        $nuevoObjeto->setCantidad($cantidad);
        $nuevoObjeto->setPeluqueria($peluqueria);
        $nuevoObjeto->setPrecio($precio);
        $nuevoObjeto->setImagen($imagen);

        $nuevoObjeto->create();
    }

    public function modificarObjeto($id_objeto, $nombre_objeto, $cantidad, $peluqueria, $precio, $imagen) {
        $objeto = new Objeto();
        $objeto->setIdObjeto($id_objeto);
        $objeto->setNombreObjeto($nombre_objeto);
        $objeto->setCantidad($cantidad);
        $objeto->setPeluqueria($peluqueria);
        $objeto->setPrecio($precio);
        $objeto->setImagen($imagen);

        $objeto->updateObjeto(); 
    }

    public function eliminarObjeto($id_objeto) {
        $objeto = new Objeto();
        $objeto->setIdObjeto($id_objeto);
        $objeto->deleteObjeto();
    }

    public function getObjetosByPeluqueria($peluqueria) {
        return Objeto::getObjetosByPeluqueria($peluqueria);
    }

    public function getObjetosById($id_objeto) {
        return Objeto::getObjetoById($id_objeto);
    }

    public function actualizarCantidad($id_objeto, $nuevaCantidad) {
        $objeto = new Objeto();
        $objeto->setIdObjeto($id_objeto);
        $objeto->updateCantidad($nuevaCantidad);
    }




}