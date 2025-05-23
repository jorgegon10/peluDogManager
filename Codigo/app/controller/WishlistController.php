<?php
require_once(__DIR__ . '/../../rutas.php'); 
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php

class WishlistController {
    public function getAllWishlists() {
        return Wishlist::getAllWishlists();
    }

    public function getWishlistByUser($nombre_usuario) {
        return Wishlist::getWishlistByUser($nombre_usuario);
    }

    public function getWishlistById($id_wishlist) {
        return Wishlist::getWishlistById($id_wishlist);
    }

    public function addProductToWishlist($nombre_usuario, $id_producto) {
        $wishlist = new Wishlist();
        $wishlist->setNombreUsuario($nombre_usuario);
        $wishlist->setIdProducto($id_producto);

        $wishlist->addProductToWishlist();
    }

    public function removeProductFromWishlist($nombre_usuario, $id_producto) {
        // Elimina de la base de datos
        $wishlist = new Wishlist();
        $wishlist->setNombreUsuario($nombre_usuario);
        $wishlist->setIdProducto($id_producto);
        $wishlist->removeProductFromWishlist();  
    
        // Elimina de la sesión
        if (($key = array_search($id_producto, $_SESSION['wishlist'])) !== false) {
            unset($_SESSION['wishlist'][$key]);  
            $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
        }
    
        $mensaje = "Producto eliminado de la wishlist.";
    }
    
}
?>
