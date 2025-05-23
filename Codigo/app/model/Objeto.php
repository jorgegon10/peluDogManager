<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php


class Objeto
{


    private $id_objeto;

    private $nombre_objeto;
    
    private $cantidad;



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


    public function setIdObjeto($id_objeto) {
        $this->id_objeto = $id_objeto;
    }


    public function setNombreObjeto($nombre_objeto) {
        $this->nombre_objeto = $nombre_objeto;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
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







}




