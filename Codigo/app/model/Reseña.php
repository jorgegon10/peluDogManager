<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php');

/**
 * Clase que representa una reseña de un producto
 *
 * @package Reseñas
 * @autor NosaSports <nosasports@store.com>
 */
class Reseña
{
    /** @var int ID de la reseña */
    private $id_reseña;

    /** @var string Texto de la reseña */
    private $texto;

    /** @var int Puntuación de la reseña */
    private $puntuacion;

    /** @var string Nombre del usuario que publicó la reseña */
    private $nombre_usuario_reseña;

    /** @var int ID del producto asociado a la reseña */
    private $id_producto_reseña;

    /**
     * Obtiene el ID de la reseña
     *
     * @return int ID de la reseña
     */
    public function getIdreseña()
    {
        return $this->id_reseña;
    }

    /**
     * Obtiene el texto de la reseña
     *
     * @return string Texto de la reseña
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Obtiene la puntuación de la reseña
     *
     * @return int Puntuación de la reseña
     */
    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    /**
     * Obtiene el nombre del usuario que escribió la reseña
     *
     * @return string Nombre del usuario
     */
    public function getNombreUsuarioreseña()
    {
        return $this->nombre_usuario_reseña;
    }

    /**
     * Obtiene el ID del producto asociado a la reseña
     *
     * @return int ID del producto
     */
    public function getIdProductoreseña()
    {
        return $this->id_producto_reseña;
    }

    /**
     * Establece el texto de la reseña
     *
     * @param string $texto Texto de la reseña
     * @return void
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * Establece la puntuación de la reseña
     *
     * @param int $puntuacion Puntuación de la reseña
     * @return void
     */
    public function setPuntuacion($puntuacion)
    {
        $this->puntuacion = $puntuacion;
    }

    /**
     * Establece el nombre del usuario que escribió la reseña
     *
     * @param string $nombre_usuario_reseña Nombre del usuario
     * @return void
     */
    public function setNombreUsuarioReseña($nombre_usuario_reseña)
    {
        $this->nombre_usuario_reseña = $nombre_usuario_reseña;
    }

    /**
     * Establece el ID del producto asociado a la reseña
     *
     * @param int $id_producto_reseña ID del producto
     * @return void
     */
    public function setIdProductoReseña($id_producto_reseña)
    {
        $this->id_producto_reseña = $id_producto_reseña;
    }

    /**
     * Obtiene todas las reseñas de la base de datos
     *
     * @return array Lista de reseñas
     */
    public static function getAllReseñas()
    {
        try {
            $conn = getDBConnection();
            $query = $conn->query("SELECT * FROM reseña");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener las reseñas: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Obtiene reseñas asociadas a un producto
     *
     * @param int $id_producto ID del producto
     * @return array Lista de reseñas asociadas al producto
     */
    public static function getReseñasByProduct($id_producto)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM reseña WHERE id_producto_reseña = ?");
            $sentencia->bindParam(1, $id_producto, PDO::PARAM_INT);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            echo "Error al obtener las reseñas del producto: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Crea una nueva reseña en la base de datos
     *
     * @return void
     */
    public function create()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("INSERT INTO reseña (texto, puntuacion, nombre_usuario_reseña, id_producto_reseña) VALUES (?, ?, ?, ?)");
            $sentencia->bindParam(1, $this->texto);
            $sentencia->bindParam(2, $this->puntuacion);
            $sentencia->bindParam(3, $this->nombre_usuario_reseña);
            $sentencia->bindParam(4, $this->id_producto_reseña);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al crear la reseña: " . $e->getMessage();
        }
    }

    /**
     * Elimina una reseña por su ID
     *
     * @param int $id_reseña ID de la reseña
     * @return void
     */
    public static function deleteReseña($id_reseña)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM reseña WHERE id_reseña = ?");
            $sentencia->bindParam(1, $id_reseña, PDO::PARAM_INT);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar la reseña: " . $e->getMessage();
        }
    }

    /**
     * Elimina todas las reseñas de un usuario
     *
     * @param string $nombre_usuario Nombre del usuario
     * @return void
     */
    public static function deleteReseñasByUsuario($nombre_usuario)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM reseña WHERE nombre_usuario_reseña = ?");
            $sentencia->bindParam(1, $nombre_usuario, PDO::PARAM_STR);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al eliminar las reseñas del usuario: " . $e->getMessage();
        }
    }
}
