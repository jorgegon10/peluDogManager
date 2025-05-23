<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php

/**
 * Clase que representa un producto en el sistema
 *
 * @package Wishlist
 * @author NosaSports <nosasports@store.com>
 */

class Wishlist
{
    /** @var int ID de wishlist */
    private $id_wishlist;

    /** @var string Nombre de usuario */
    private $nombre_usuario;

    /** @var string ID del producto */
    private $id_producto;

    /**
     * Obtiene la Id de Wishlist
     *
     * @return int Id de Wishlist
     */

    public function getIdWishlist()
    {
        return $this->id_wishlist;
    }

    /**
     * Obtiene el nombre de usuario
     *
     * @return string Nombre de usuario
     */
    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    /**
     * Obtiene el Id del producto
     *
     * @return int Id del producto
     */
    public function getIdProducto()
    {
        return $this->id_producto;
    }

    /**
     * Establece el ID de la wishlist
     *
     * @param int $id_wishlist ID de la wishlist
     * @return void
     */
    public function setIdWishlist($id_wishlist)
    {
        $this->id_wishlist = $id_wishlist;
    }

    /**
     * Establece el Nombre de usuario
     *
     * @param string $nombre_usuario nombre de usuario de la wishlist
     * @return void
     */
    public function setNombreUsuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;
    }

    /**
     * Establece el Id del producto
     *
     * @param int $id_producto Id del producto de la wishlist
     * @return void
     */
    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    /**
     * Obtiene todas las Wishlist
     *
     * @return array Lista de wishlists
     */
    public static function getAllWishlists()
    {
        try {
            $conn = getDBConnection();
            $query = $conn->query("SELECT * FROM wishlist");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener las wishlists: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Obtiene la wishlist asociada a un usuario
     *
     * @param string $nombre_usuario nombre de usuario
     * @return array Wishlist asociada a un usuario
     */
    public static function getWishlistByUser($nombre_usuario)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM wishlist WHERE nombre_usuario = ?");
            $sentencia->bindParam(1, $nombre_usuario);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la wishlist del usuario: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Obtiene la Id asociada a una wishlist
     *
     * @param int $id_wishlist id de wishlist
     * @return array Id asociada a una wishlist
     */
    public static function getWishlistById($id_wishlist)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM wishlist WHERE id_wishlist = ?");
            $sentencia->bindParam(1, $id_wishlist);
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la wishlist: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Añade un producto a la wishlist
     *
     * @return void
     */
    public function addProductToWishlist()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("INSERT INTO wishlist (nombre_usuario, id_producto) VALUES (?, ?)");
            $sentencia->bindParam(1, $this->nombre_usuario);
            $sentencia->bindParam(2, $this->id_producto);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al añadir el producto a la wishlist: " . $e->getMessage();
        }
    }

    /**
     * Elimina un producto de la wishlist
     *
     * @return void
     */
    public function removeProductFromWishlist() {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM wishlist WHERE nombre_usuario = ? AND id_producto = ?");
            $sentencia->bindParam(1, $this->nombre_usuario);
            $sentencia->bindParam(2, $this->id_producto);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar el producto de la wishlist: " . $e->getMessage();
        }
    }
}
