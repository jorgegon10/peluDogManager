<?php
require_once(__DIR__ . '/../../rutas.php'); 
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php

class ProductoController {
    public function getAllProducts() {
        return Producto::getAllProducts();
    }

    public function getProductsByName($nombre_perro) {
        return Producto::getProductByName($nombre_perro);
    }

    public function crearProducto($nombre_perro, $precio, $descripcion, $peluqueria, $visitas, $imagen,$telefono,$raza) {
        $nuevoProducto = new Producto();
        $nuevoProducto->setNombre($nombre_perro);
        $nuevoProducto->setPrecio($precio); 
        $nuevoProducto->setDescripcion($descripcion);
        $nuevoProducto->setPeluqueria($peluqueria);
        $nuevoProducto->setVisitas($visitas);
        $nuevoProducto->setImagen($imagen); // Establecer el valor de la imagen
        $nuevoProducto->setTelefono($telefono);
        $nuevoProducto->setRaza($raza);

        $nuevoProducto->create();
    }

    public function modificarProducto($id_producto, $nombre_perro, $precio, $descripcion, $peluqueria, $visitas, $imagen, $telefono ,$raza) {
        $producto = new Producto();
        $producto->setIdProducto($id_producto);
        $producto->setNombre($nombre_perro);
        $producto->setPrecio($precio);
        $producto->setDescripcion($descripcion);
        $producto->setPeluqueria($peluqueria);
        $producto->setVisitas($visitas);
        $producto->setImagen($imagen);
        $producto->setTelefono($telefono);
        $producto->setRaza($raza);
         // Establecer el valor de la imagen

        $producto->updateProduct(); 
    }

    public function eliminarProducto($id_producto) {
        $producto = new Producto();
        $producto->setIdProducto($id_producto);
        $producto->deleteProduct();
    }

    public function productosConMasLikes() {
        return Producto::getTopLikedProducts();
    }

    public function getProductsByPeluqueria($peluqueria) {
        return Producto::getProductByPeluqueria($peluqueria);
    }

    public function getProductsById($id_producto) {
        return Producto::getProductById($id_producto);
    }

    public function searchProducts($search, $deporte = null)
{
    return Producto::searchProducts($search, $deporte);
}

    public function modificarNombreProducto($id_producto, $nuevoNombreProducto) {
        $producto = new Producto();
        $producto->setIdProducto($id_producto);
        $producto->updateNombreProducto($nuevoNombreProducto);
    }

    public function modificarPrecio($id_producto, $nuevoPrecioProducto){
        $producto = new Producto();
        $producto->setIdProducto( $id_producto);
        $producto->updatePrecioProducto($nuevoPrecioProducto);
    }

    public function modificarLikes($id_producto, $nuevasVisitasPerro){
        $producto = new Producto();
        $producto->setIdProducto( $id_producto);
        $producto->updateVisitasPerro($nuevasVisitasPerro);
    }

    public function modificarDescripcion($id_producto, $nuevaDescripcion) {
        $producto = new Producto();
        $producto->setIdProducto($id_producto);
        $producto->updateDescripcionProducto($nuevaDescripcion);
    }

    public function modificarImagen($id_producto, $nuevaImagen) {
        $producto = new Producto();
        $producto->setIdProducto($id_producto);
        $producto->updateImagenProducto($nuevaImagen);
    }

    public function modificarDeporte($id_producto, $nuevaPeluqueria) {
        $producto = new Producto();
        $producto->setIdProducto($id_producto);
        $producto->updatePeluqueriaPerro($nuevaPeluqueria);
    }

}
?>
