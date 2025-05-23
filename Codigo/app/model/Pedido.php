<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // Asegúrate de que la conexión a la base de datos esté correctamente definida

/**
 * Clase que representa un pedido en el sistema
 *
 * @package Pedido
 * @author NosaSports <nosasports@store.com>
 */

class Pedido {

    /** @var int Id del pedido */
    private $id_pedido;

    /** @var int Id del producto */
    private $id_producto;

    /** @var string Nombre del usuario */
    private $nombre_usuario;

    /**
     * Establece el ID del pedido
     *
     * @param int $id_pedido ID del pedido
     * @return void
     */
    public function setIdPedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }

    /**
     * Establece el ID del producto del pedido
     *
     * @param int $id_producto ID del producto
     * @return void
     */
    public function setIdProducto($id_producto) {
        $this->id_producto = $id_producto;
    }

     /**
     * Establece el nombre de usuario del pedido
     *
     * @param string $nombre_usuario Nombre de usuario
     * @return void
     */
    public function setNombreUsuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
    }

   
    /**
     * Crea un nuevo pedido en la base de datos
     *
     * @return void
     */
    public function crearPedido($id_producto, $nombre_usuario) {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("INSERT INTO pedido (id_producto, nombre_usuario) VALUES (?, ?)");
            $sentencia->bindParam(1, $id_producto);
            $sentencia->bindParam(2, $nombre_usuario);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error al crear el pedido: " . $e->getMessage();
            return [];
        }
    }


    public function getPedidosByNombreUsuario($nombre_usuario) {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM pedido WHERE nombre_usuario = ?");
            $sentencia->bindParam(1, $nombre_usuario);
            $sentencia->execute();
            return $sentencia->fetchAll();
        } catch (PDOException $e) {
            echo "Error al obtener los pedidos: " . $e->getMessage();
            return [];
        }
    }
}
?>
