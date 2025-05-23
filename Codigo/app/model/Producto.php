<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php

/**
 * Clase que representa un producto en el sistema
 *
 * @package Productos
 * @author NosaSports <nosasports@store.com>
 */
class Producto
{
    /** @var string Nombre del producto */
    private $nombre_perro;

    /** @var float Precio del producto */

    private $precio;

    /** @var int ID del producto */
    private $id_producto;

    /** @var int Número de likes del producto */
    private $visitas;

    /** @var string Deporte al que pertenece el producto */
    private $peluqueria;

    /** @var string Descripción del producto */
    private $descripcion;

    /** @var string Ruta de la imagen del producto */
    private $imagen;

    private $telefono;

    private $raza;

/**
     * Obtiene el nombre del producto
     *
     * @return string Nombre del producto
     */
    public function getNombre()
    {
        return $this->nombre_perro;
    }

    /**
     * Obtiene el precio del producto
     *
     * @return float Precio del producto
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Obtiene el ID del producto
     *
     * @return int ID del producto
     */
    public function getIdProducto()
    {
        return $this->id_producto;
    }

    /**
     * Obtiene la descripción del producto
     *
     * @return string Descripción del producto
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Obtiene los likes del producto
     *
     * @return int Número de likes del producto
     */
    public function getVisitas()
    {
        return $this->visitas;
    }

    /**
     * Obtiene el deporte al que pertenece el producto
     *
     * @return string Deporte al que pertenece el producto
     */
    public function getPeluqueria()
    {
        return $this->peluqueria;
    }

    /**
     * Obtiene la imagen del producto
     *
     * @return string Ruta de la imagen del producto
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getRaza()
    {
        return $this->raza;
    }

    /**
     * Establece el nombre del producto
     *
     * @param string $nombre_producto Nombre del producto
     * @return void
     */
    public function setNombre($nombre_perro)
    {
        $this->nombre_perro= $nombre_perro;
    }

    /**
     * Establece el precio del producto
     *
     * @param float $precio Precio del producto
     * @return void
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * Establece el ID del producto
     *
     * @param int $id_producto ID del producto
     * @return void
     */
    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    /**
     * Establece la descripción del producto
     *
     * @param string $descripcion Descripción del producto
     * @return void
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Establece los likes del producto
     *
     * @param int $visitas Número de likes del producto
     * @return void
     */
    public function setVisitas($visitas)
    {
        $this->visitas = $visitas;
    }

    /**
     * Establece el deporte al que pertenece el producto
     *
     * @param string $deporte Deporte al que pertenece el producto
     * @return void
     */
    public function setPeluqueria($peluqueria)
    {
        $this->peluqueria = $peluqueria;
    }

     /**
     * Establece la imagen del producto
     *
     * @param string $imagen Ruta de la imagen del producto
     * @return void
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setRaza($raza)
    {
        $this->raza = $raza;
    }

    /**
     * Obtiene todos los productos de la base de datos
     *
     * @return array Lista de productos
     */
    public static function getAllProducts()
    {
        try {
            $conn = getDBConnection();
            $query = $conn->query("SELECT * FROM producto");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al ejecutar la query: " . $e->getMessage();
            return []; // necesario para que siempre devuelva algo (en la documentacion indicamos 
                        // que siempre debe esperar un array sea cual sea el resultado del try-catch)

        }
    }

     /**
     * Obtiene productos por nombre
     *
     * @param string $nombre_producto Nombre del producto
     * @return array Lista de productos que coinciden con el nombre
     */
    public static function getProductByName($nombre_producto)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM producto WHERE nombre_producto LIKE ?");
            $searchTerm = "%" . $nombre_producto . "%"; // para que no busque la palabra literal y sirva con cualquier letra
            $sentencia->bindParam(1, $searchTerm);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el producto: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Crea un nuevo producto en la base de datos
     *
     * @return void
     */
    public function create()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("INSERT INTO producto (nombre_perro, precio, descripcion, peluqueria, visitas, imagen, telefono, raza) VALUES (?,?,?,?,?,?,?,?)");
            $sentencia->bindParam(1, $this->nombre_perro);
            $sentencia->bindParam(2, $this->precio);
            $sentencia->bindParam(3, $this->descripcion);
            $sentencia->bindParam(4, $this->peluqueria);
            $sentencia->bindParam(5, $this->visitas);
            $sentencia->bindParam(6, $this->imagen);
            $sentencia->bindParam(7, $this->telefono);
            $sentencia->bindParam(8, $this->raza);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error en la conexión a base de datos: " . $e->getMessage();
        }
    }

    /**
     * Actualiza un producto existente en la base de datos
     *
     * @return void
     */
    public function updateProduct()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE producto SET nombre_perro = ?, precio = ?, descripcion = ?, peluqueria = ?, visitas = ?, imagen = ?, telefono = ?, raza = ? WHERE id_producto = ?");
            $sentencia->bindParam(1, $this->nombre_perro);
            $sentencia->bindParam(2, $this->precio);
            $sentencia->bindParam(3, $this->descripcion);
            $sentencia->bindParam(4, $this->peluqueria);
            $sentencia->bindParam(5, $this->visitas);
            $sentencia->bindParam(6, $this->imagen);
            $sentencia->bindParam(7, $this->telefono);
            $sentencia->bindParam(8, $this->raza);
            $sentencia->bindParam(9, $this->id_producto);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error en la conexión a base de datos: " . $e->getMessage();
        }
    }

    /**
     * Elimina un producto de la base de datos
     *
     * @return void
     */
    public function deleteProduct()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM producto WHERE id_producto = ?");
            $sentencia->bindParam(1, $this->id_producto);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error en la conexión a base de datos: " . $e->getMessage();
        }
    }

    /**
     * Obtiene un producto por su ID
     *
     * @param int $id_producto ID del producto
     * @return array Datos del producto
     */
    public static function getProductById($id_producto)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM producto WHERE id_producto = ?");
            $sentencia->bindParam(1, $id_producto);
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "No se pudo obtener el producto " . $e->getMessage();
            return [];
        }
    }

     /**
     * Obtiene los productos más populares (los que tienen más likes)
     *
     * @return array Lista de los tres productos más populares
     */
    public static function getTopLikedProducts()
    {
        try {
            $conn = getDBConnection();
            $query = $conn->query("SELECT * FROM producto ORDER BY likes DESC LIMIT 3");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener los 3 productos con más likes: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Obtiene productos filtrados por deporte
     *
     * @param string $deporte Deporte asociado al producto
     * @return array Lista de productos de ese deporte
     */
    public static function getProductByPeluqueria($peluqueria)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM producto WHERE peluqueria = ?");
            $sentencia->bindParam(1, $peluqueria);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el producto: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Realiza una búsqueda de productos por nombre
     *
     * @param string $search Término de búsqueda
     * @param string|null $deporte Deporte opcional para filtrar
     * @return array Lista de productos que coinciden con la búsqueda
     */
    public static function searchProducts($search, $peluqueria = null)
    {
        try {
            $conn = getDBConnection();
            $sql = "SELECT * FROM producto WHERE nombre_perro LIKE ?";
            $params = ["%$search%"];
            $sentencia = $conn->prepare($sql);
            $sentencia->execute($params);
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al realizar la búsqueda: " . $e->getMessage();
            return [];
        }
    }

    public function updateNombreProducto($nuevoNombrePerro)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE producto SET nombre_perro = ? WHERE id_producto = ?");
            $sentencia->bindParam(1, $nuevoNombrePerro);
            $sentencia->bindParam(2, $this->id_producto); //de donde saca este id
            $sentencia->execute();
            $this->nombre_perro = $nuevoNombrePerro;
        } catch (PDOException $e) {
            echo "Error al actualizar el nombre de usuario: " . $e->getMessage();
        }
    }

    public function updatePrecioProducto($nuevoPrecioProducto)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE producto SET precio = ? WHERE id_producto = ?");
            $sentencia->bindParam(1, $nuevoPrecioProducto);
            $sentencia->bindParam(2, $this->id_producto);
            $sentencia->execute();
            $this->precio = $nuevoPrecioProducto ;
        } catch (PDOException $e) {
            echo "Error al actualizar el nombre de usuario: " . $e->getMessage();
        }
    }

    public function updateVisitasPerro($nuevasVisitasPerro)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE producto SET visitas = ? WHERE id_producto = ?");
            $sentencia->bindParam(1, $nuevasVisitasPerro);
            $sentencia->bindParam(2, $this->id_producto);
            $sentencia->execute();
            $this->visitas = $nuevasVisitasPerro ;
        } catch (PDOException $e) {
            echo "Error al actualizar el nombre de usuario: " . $e->getMessage();
        }
    }


    //en vez de modificar la anterior la concatenamos 
    public function updateDescripcionProducto($nuevaDescripcionProducto) {
        try {
            $conn = getDBConnection();
    
            // Obtener la descripción actual del producto
            $sentenciaSelect = $conn->prepare("SELECT descripcion FROM producto WHERE id_producto = ?");
            $sentenciaSelect->bindParam(1, $this->id_producto);
            $sentenciaSelect->execute();
            $descripcionActual = $sentenciaSelect->fetchColumn();
    
            // Obtener la fecha y hora actuales en formato "YYYY-MM-DD HH:MM:SS"
            $fechaModificacion = date("Y-m-d H:i:s");
    
            // Formatear la nueva entrada con la fecha al inicio
            $nuevaEntrada = $fechaModificacion . " - " . $nuevaDescripcionProducto;
    
            // Si la descripción actual no está vacía, concatenamos con un salto de línea
            if (!empty($descripcionActual)) {
                $descripcionActualizada = $descripcionActual . "\n" . $nuevaEntrada;
            } else {
                $descripcionActualizada = $nuevaEntrada;
            }
    
            // Actualizar la base de datos con la nueva descripción
            $sentenciaUpdate = $conn->prepare("UPDATE producto SET descripcion = ? WHERE id_producto = ?");
            $sentenciaUpdate->bindParam(1, $descripcionActualizada);
            $sentenciaUpdate->bindParam(2, $this->id_producto);
            $sentenciaUpdate->execute();
    
            // Actualizar la propiedad de la clase
            $this->descripcion = $descripcionActualizada;
        } catch (PDOException $e) {
            echo "Error al actualizar la descripción del producto: " . $e->getMessage();
        }
    }
    

    // public function updateDescripcionProducto($nuevaDescripcionProducto){
    //     try {
    //         $conn = getDBConnection();
    //         $sentencia = $conn->prepare("UPDATE producto SET descripcion =? WHERE id_producto =?");
    //         $sentencia->bindParam(1, $nuevaDescripcionProducto);
    //         $sentencia->bindParam(2, $this->id_producto);
    //         $sentencia->execute();
    //         $this->descripcion = $nuevaDescripcionProducto ;
    //     } catch (PDOException $e) {
    //         echo "Error al actualizar el nombre de usuario: ". $e->getMessage();
    //     }
    // }

    public function updatePeluqueriaPerro($nuevaPeluqueriaPerro){
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE producto SET deporte =? WHERE id_producto =?");
            $sentencia->bindParam(1, $nuevoDeporteProducto);
            $sentencia->bindParam(2, $this->id_producto);
            $sentencia->execute();
            $this->peluqueria = $nuevaPeluqueriaPerro ;
        } catch (PDOException $e) {
            echo "Error al actualizar el nombre de usuario: ". $e->getMessage();
        }
    }


    public function updateImagenProducto($nuevaImagenProducto){
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE producto SET imagen =? WHERE id_producto =?");
            $sentencia->bindParam(1, $nuevaImagenProducto);
            $sentencia->bindParam(2, $this->id_producto);
            $sentencia->execute();
            $this->imagen = $nuevaImagenProducto ;
        } catch (PDOException $e) {
            echo "Error al actualizar el nombre de usuario: ". $e->getMessage();
        }
    }

    



}

    
