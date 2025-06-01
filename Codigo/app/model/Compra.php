<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php


class Compra
{




    private $id_compra;

    private $nombre_compra;


    private $precio_compra;

    private $peluqueria;


    public function getIDCompra()
    {
        return $this->id_compra;
    }
    public function getNombreCompra()
    {
        return $this->nombre_compra;
    }
    public function getPrecioCompra()
    {
        return $this->precio_compra;
    }
    public function getPeluqueria()
    {
        return $this->peluqueria;
    }

    public function setIdCompra($id_compra)
    {
        $this->id_compra = $id_compra;
    }
    public function setNombreCompra($nombre_compra)
    {
        $this->nombre_compra = $nombre_compra;
    }
    public function setPrecioCompra($precio_compra)
    {
        $this->precio_compra = $precio_compra;
    }
    public function setPeluqueria($peluqueria)
    {
        $this->peluqueria = $peluqueria;
    }

    public static function getComprasByPeluqueria($peluqueria)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM compra WHERE peluqueria = ?");
            $sentencia->bindParam(1, $peluqueria);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener la compra: " . $e->getMessage();
            return [];
        }
    }

    public static function getAllCompras()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM compra");
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener la compra: " . $e->getMessage();
            return [];
        }
    }

    public function create()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("INSERT INTO compra (nombre_compra,precio_compra, peluqueria) VALUES (?, ?, ?)");
            $sentencia->bindParam(1, $this->nombre_compra);
            $sentencia->bindParam(2, $this->precio_compra);
            $sentencia->bindParam(3, $this->peluqueria);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al crear la compra: " . $e->getMessage();
        }
    }
    public function updateCompra()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE compra SET nombre_compra = ?, formaPago = ?, precio_compra = ?, fecha_compra = ?, peluqueria = ? WHERE id_compra = ?");
            $sentencia->bindParam(1, $this->nombre_compra);
            $sentencia->bindParam(3, $this->precio_compra);
            $sentencia->bindParam(4, $this->peluqueria);
            $sentencia->bindParam(5, $this->id_compra);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar la compra: " . $e->getMessage();
        }
    }

    public function deleteCompra()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM compra WHERE id_compra = ?");
            $sentencia->bindParam(1, $this->id_compra);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar la compra: " . $e->getMessage();
        }
    }
    public static function getComprasById($id_compra)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM compra WHERE id_compra = ?");
            $sentencia->bindParam(1, $id_compra);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener la compra: " . $e->getMessage();
            return [];
        }
    }
    public static function getComprasByNombre($nombre_compra)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM compra WHERE nombre_compra = ?");
            $sentencia->bindParam(1, $nombre_compra);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener la compra: " . $e->getMessage();
            return [];
        }
    }

}