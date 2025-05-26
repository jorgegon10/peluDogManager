<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php


class Objeto
{


    private $id_objeto;

    private $nombre_objeto;
    
    private $cantidad;

    private $peluqueria;

    private $precio;

    private $imagen;




    public function getIDObjeto()
    {
        return $this->id_objeto;
    }

    public function getNombreObjeto()
    {
        return $this->nombre_objeto;
    }

    public function getcantidad()
    {
        return $this->cantidad;
    }
    public function getPeluqueria()
    {
        return $this->peluqueria;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getImagen()
    {
        return $this->imagen;
    }




    public function setIdObjeto($id_objeto) {
        $this->id_objeto = $id_objeto;
    }


    public function setNombreObjeto($nombre_objeto) {
        $this->nombre_objeto = $nombre_objeto;
    }

    public function setPeluqueria($peluqueria) {
        $this->peluqueria = $peluqueria;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    public function create()
    {
        try {
            $conn = getDBConnection();
            $sql = "INSERT INTO objeto (nombre_objeto, cantidad, peluqueria, precio, imagen) VALUES (:nombre_objeto, :cantidad, :peluqueria, :precio, :imagen)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre_objeto', $this->nombre_objeto);
            $stmt->bindParam(':cantidad', $this->cantidad);
            $stmt->bindParam(':peluqueria', $this->peluqueria);
            $stmt->bindParam(':precio', $this->precio);
            $stmt->bindParam(':imagen', $this->imagen);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al crear el producto: " . $e->getMessage();
        }
    }
    public function updateObjeto()
    {
        try {
            $conn = getDBConnection();
            $sql = "UPDATE objeto SET nombre_objeto = :nombre_objeto, cantidad = :cantidad, peluqueria = :peluqueria, precio = :precio, imagen = :imagen WHERE id_objeto = :id_objeto";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre_objeto', $this->nombre_objeto);
            $stmt->bindParam(':cantidad', $this->cantidad);
            $stmt->bindParam(':peluqueria', $this->peluqueria);
            $stmt->bindParam(':precio', $this->precio);
            $stmt->bindParam(':imagen', $this->imagen);
            $stmt->bindParam(':id_objeto', $this->id_objeto);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el producto: " . $e->getMessage();
        }
    }

    public function deleteObjeto()
    {
        try {
            $conn = getDBConnection();
            $sql = "DELETE FROM objeto WHERE id_objeto = :id_objeto";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_objeto', $this->id_objeto);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar el producto: " . $e->getMessage();
        }
    }

    public static function getAllObjetos()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM objeto");
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener los productos: " . $e->getMessage();
            return [];
        }
    }

    public static function getObjetoByName($nombre_objeto)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM objeto WHERE nombre_objeto = ?");
            $sentencia->bindParam(1, $nombre_objeto);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el producto: " . $e->getMessage();
            return [];
        }
    }


    public static function getObjetosByPeluqueria($peluqueria)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM objeto WHERE peluqueria = ?");
            $sentencia->bindParam(1, $peluqueria);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el producto: " . $e->getMessage();
            return [];
        }
    }

    public function updateCantidad($nuevaCantidad)
{
    try {
        $conn = getDBConnection();
        $sql = "UPDATE objeto SET cantidad = :cantidad WHERE id_objeto = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cantidad', $nuevaCantidad);
        $stmt->bindParam(':id', $this->id_objeto);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error al actualizar cantidad: " . $e->getMessage();
    }
}
    public static function getObjetoById($id_objeto)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM objeto WHERE id_objeto = ?");
            $sentencia->bindParam(1, $id_objeto);
            $sentencia->execute();
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el producto: " . $e->getMessage();
            return null;
        }
    }








}




