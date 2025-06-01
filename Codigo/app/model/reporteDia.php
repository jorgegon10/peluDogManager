<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php


class ReporteDia{

    private $id_reporte;
    private $num_compras;
    private $total_compras;
    private $fecha_compras;
    private $peluqueria;

    public function getIDReporte()
    {
        return $this->id_reporte;
    }
    public function getNumCompras()
    {
        return $this->num_compras;
    } 
    public function getTotalCompras()
    {
        return $this->total_compras;
    }
    public function getFechaCompras()
    {
        return $this->fecha_compras;
    }
    public function getPeluqueria()
    {
        return $this->peluqueria;
    }
    public function setIdReporte($id_reporte) {
        $this->id_reporte = $id_reporte;
    }
    public function setNumCompras($num_compras) {
        $this->num_compras = $num_compras;
    }
    public function setTotalCompras($total_compras) {
        $this->total_compras = $total_compras;
    }
    public function setFechaCompras($fecha_compras) {
        $this->fecha_compras = $fecha_compras;
    } 
    public function setPeluqueria($peluqueria) {
        $this->peluqueria = $peluqueria;
    }


    public function create()
    {
        try {
        $conn = getDBConnection();
        $sentencia = $conn->prepare("INSERT INTO reporteDia (num_compras, total_compras, fecha_compras, peluqueria) VALUES (?, ?, ?, ?)");
        $sentencia->bindParam(1, $this->num_compras);
        $sentencia->bindParam(2, $this->total_compras);
        $sentencia->bindParam(3, $this->fecha_compras);
        $sentencia->bindParam(4, $this->peluqueria);
        $sentencia->execute();

        return true; // <-- esto debe estar aquí para que funcione bien el if en el controller
    }catch (PDOException $e) {
            echo "Error al crear la compra: " . $e->getMessage();
        }
}
      
    public static function getAllReportes()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM reporteDia");
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el reporte: " . $e->getMessage();
            
        }
    }
    public static function getReporteByPeluqueria($peluqueria)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM reporteDia WHERE peluqueria = ?");
            $sentencia->bindParam(1, $peluqueria);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el reporte: " . $e->getMessage();
            return [];
        }
    } 
    public static function getReporteByFecha($fecha)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM reporteDia WHERE fecha_compras = ?");
            $sentencia->bindParam(1, $fecha);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el reporte: " . $e->getMessage();
            return [];
        }
    }
    public static function getReporteByPeluqueriaAndFecha($peluqueria, $fecha)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM reporteDia WHERE peluqueria = ? AND fecha_compras = ?");
            $sentencia->bindParam(1, $peluqueria);
            $sentencia->bindParam(2, $fecha);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el reporte: " . $e->getMessage();
            return [];
        }
    }
    public static function delete($id_reporte)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM reporteDia WHERE id_reporte = ?");
            $sentencia->bindParam(1, $id_reporte);
            return $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar el reporte: " . $e->getMessage();
            return false;
        }
    }   

    public static function update($id_reporte, $num_compras, $total_compras, $fecha_compras, $peluqueria)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE reporteDia SET num_compras = ?, total_compras = ?, fecha_compras = ?, peluqueria = ? WHERE id_reporte = ?");
            $sentencia->bindParam(1, $num_compras);
            $sentencia->bindParam(2, $total_compras);
            $sentencia->bindParam(3, $fecha_compras);
            $sentencia->bindParam(4, $peluqueria);
            $sentencia->bindParam(5, $id_reporte);
            return $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el reporte: " . $e->getMessage();
            return false;
        }
    }

}
