<?php
require_once(__DIR__ . '/../../rutas.php');
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php

/**
 * Clase que representa a un usuario en el sistema
 *
 * @package Usuarios
 * @author NosaSports
 */
class Usuario
{
    private $nombre_usuario;
    private $correo;
    private $imagen;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $direccion;
    private $contraseña;
    private $peluqueria;
    private $puesto;
    private $administrador;
    private $activo;

    // Getters
    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido1()
    {
        return $this->apellido1;
    }

    public function getApellido2()
    {
        return $this->apellido2;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }

    public function getPeluqueria()
    {
        return $this->peluqueria;
    }

    public function getPuesto()
    {
        return $this->puesto;
    }

    // Método que devuelve el valor de administrador como booleano
    public function getAdministrador()
    {
        return (bool) $this->administrador;
    }

    // Método que devuelve el valor de activo como booleano
    public function getActivo()
    {
        return (bool) $this->activo;
    }

    // Setters
    public function setNombreUsuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
    }

    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;
    }

    public function setPeluqueria($peluqueria)
    {
        $this->peluqueria = $peluqueria;
    }

    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    }

    // Método que establece el valor de administrador como booleano
    public function setAdministrador($administrador)
    {
        $this->administrador = (bool) $administrador;
    }

    // Método que establece el valor de activo como booleano
    public function setActivo($activo)
    {
        $this->activo = (bool) $activo;
    }

    // Métodos de base de datos
    public static function getAllUsers()
    {
        try {
            $conn = getDBConnection();
            $query = $conn->query("SELECT * FROM usuario");
            $result = $query->fetchAll(PDO::FETCH_ASSOC); // El assoc devuelve cada fila como array asociativo
            return $result;
        } catch (PDOException $e) {
            echo "Error al ejecutar la query". $e->getMessage();
            return []; 
        }
    }

    public static function getUserByName($nombre_usuario)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?");
            $sentencia->bindParam(1, $nombre_usuario);
            $sentencia->execute();
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);

            // Si el usuario existe, crea un objeto usuario
            if ($result == true) {
                $usuario = new Usuario();
                $usuario->setNombreUsuario($result['nombre_usuario']);
                $usuario->setCorreo($result['correo']);
                $usuario->setContraseña($result['contraseña']);
                $usuario->setNombre($result['nombre']);
                $usuario->setApellido1($result['apellido1']);
                $usuario->setApellido2($result['apellido2']);
                $usuario->setDireccion($result['direccion']);
                $usuario->setPeluqueria($result['peluqueria']);
                $usuario->setPuesto($result['puesto']);
                $usuario->setAdministrador($result['administrador']);
                $usuario->setActivo($result['activo']);

                return $usuario;
            }
        } catch (PDOException $e) {
            echo "Error en la conexión a base de datos: " . $e->getMessage();
        }
    }

    public static function getUserByName2($nombre_usuario)
{
    try {
        $conn = getDBConnection();
        $sentencia = $conn->prepare("SELECT * FROM usuario WHERE nombre_usuario = ?");
        $sentencia->bindParam(1, $nombre_usuario);
        $sentencia->execute();
        return $sentencia->fetch(PDO::FETCH_ASSOC); // Devuelve los datos del usuario como un array asociativo
    } catch (PDOException $e) {
        echo "No se pudo obtener el usuario: " . $e->getMessage();
        return []; // En caso de error, devuelve un array vacío
    }
}



  


    public static function getUsersByPeluqueria($peluqueria)
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("SELECT * FROM usuario WHERE peluqueria = ?");
            $sentencia->bindParam(1, $peluqueria);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error al obtener el producto: " . $e->getMessage();
            return [];
        }
    }

   public function create()
{
    try {
        $conn = getDBConnection();
        $sentencia = $conn->prepare("INSERT INTO usuario (nombre_usuario, correo, nombre, apellido1, apellido2, imagen, contraseña, direccion, peluqueria, puesto, administrador, activo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $sentencia->bindParam(1, $this->nombre_usuario);
        $sentencia->bindParam(2, $this->correo);
        $sentencia->bindParam(3, $this->nombre);
        $sentencia->bindParam(4, $this->apellido1);
        $sentencia->bindParam(5, $this->apellido2);
        $sentencia->bindParam(6, $this->imagen);          
        $sentencia->bindParam(7, $this->contraseña);
        $sentencia->bindParam(8, $this->direccion);
        $sentencia->bindParam(9, $this->peluqueria);
        $sentencia->bindParam(10, $this->puesto);
        $sentencia->bindParam(11, $this->administrador);
        $sentencia->bindParam(12, $this->activo);

        $sentencia->execute();
    } catch (PDOException $e) {
        echo "Error en la conexión a base de datos: " . $e->getMessage();
    }
}


    public function updateUser()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("UPDATE usuario SET nombre_usuario = ?, correo = ?, nombre = ?, apellido1 = ?, apellido2 = ?, contraseña = ?, direccion = ?, peluqueria = ?, puesto = ?, administrador = ?, activo = ? WHERE nombre_usuario = ?");
            $sentencia->bindParam(1, $this->nombre_usuario);
            $sentencia->bindParam(2, $this->correo);
            $sentencia->bindParam(3, $this->nombre);
            $sentencia->bindParam(4, $this->apellido1);
            $sentencia->bindParam(5, $this->apellido2);
            $sentencia->bindParam(6, $this->contraseña);
            $sentencia->bindParam(7, $this->direccion);
            $sentencia->bindParam(8, $this->peluqueria);
            $sentencia->bindParam(9, $this->puesto);
            $sentencia->bindParam(10, $this->administrador);
            $sentencia->bindParam(11, $this->activo);
            $sentencia->bindParam(12, $this->nombre_usuario);

            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error en la conexión a base de datos: " . $e->getMessage();
        }
    }

    public function deleteUser()
    {
        try {
            $conn = getDBConnection();
            $sentencia = $conn->prepare("DELETE FROM usuario WHERE nombre_usuario = ?");
            $sentencia->bindParam(1, $this->nombre_usuario);
            $sentencia->execute();
        } catch (PDOException $e) {
            echo "Error en la conexión a base de datos: " . $e->getMessage();
        }
    }
}
