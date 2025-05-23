<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php


class Caja
{
 private $id_compra;

 private $nombre_compra;

 private $formaPago;

private $precio_compra;

private $fecha_compra;

private $peluqueria;



    public function getIDCompra()
    {
        return $this->id_compra;
    }
    
    public function getNombreCompra()
    {
        return $this->nombre_compra;
    }
    
    public function getFormaPago()
    {
        return $this->formaPago;
    }
    
    public function getPrecioCompra()
    {
        return $this->precio_compra;
    }
    
    public function getFechaCompra()
    {
        return $this->fecha_compra;
    }

    public function getPeluqueria()
    {
        return $this->peluqueria;
    }

    public function setIdCompra($id_compra) {
        $this->id_compra = $id_compra;
    }
    public function setNombreCompra($nombre_compra) {
        $this->nombre_compra = $nombre_compra;
    }
    public function setFormaPago($formaPago) {
        $this->formaPago = $formaPago;
    }
    public function setPrecioCompra($precio_compra) {
        $this->precio_compra = $precio_compra;
    }
    public function setFechaCompra($fecha_compra) {
        $this->fecha_compra = $fecha_compra;
    }
    public function setPeluqueria($peluqueria) {
        $this->peluqueria = $peluqueria;
    }

    public static function getCajaByPeluqueria($peluqueria)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM caja WHERE peluqueria = ?");
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
            $sentencia = $conn->prepare("SELECT * FROM caja");
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
            $sentencia = $conn->prepare("INSERT INTO caja (nombre_compra, formaPago, precio_compra, fecha_compra, peluqueria) VALUES (?, ?, ?, ?, ?)");
            $sentencia->bindParam(1, $this->nombre_compra);
            $sentencia->bindParam(2, $this->formaPago);
            $sentencia->bindParam(3, $this->precio_compra);
            $sentencia->bindParam(4, $this->fecha_compra);
            $sentencia->bindParam(5, $this->peluqueria);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al crear la compra: " . $e->getMessage();
        }
    }

    public function updateCompra()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE caja SET nombre_compra = ?, formaPago = ?, precio_compra = ?, fecha_compra = ?, peluqueria = ? WHERE id_compra = ?");
            $sentencia->bindParam(1, $this->nombre_compra);
            $sentencia->bindParam(2, $this->formaPago);
            $sentencia->bindParam(3, $this->precio_compra);
            $sentencia->bindParam(4, $this->fecha_compra);
            $sentencia->bindParam(5, $this->peluqueria);
            $sentencia->bindParam(6, $this->id_compra);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar la compra: " . $e->getMessage();
        }
    }

    public function deleteCompra()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM caja WHERE id_compra = ?");
            $sentencia->bindParam(1, $this->id_compra);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar la compra: " . $e->getMessage();
        }
    }

    public function deleteCajaByPeluqueria($peluqueria)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM caja WHERE peluqueria = ?");
            $sentencia->bindParam(1, $peluqueria);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar la compra: " . $e->getMessage();
        }
    }



}