<?php
require_once(__DIR__ . '/../../rutas.php'); 
require_once(CONFIG . 'dbConnection.php'); // ruta de config definido en rutas.php
require_once(MODEL . 'Reseña.php');  // Agregar esta línea

class UsuarioController {

    public function getAllUsers() {
        return Usuario::getAllUsers();
    }

    public function getUserByName($nombre_usuario) {
        return Usuario::getUserByName($nombre_usuario);
    }

    public function getUserByName2($nombre_usuario) {
        return Usuario::getUserByName2($nombre_usuario);
    }
   



    public function getUsersByPeluqueria($peluqueria) {
        return Usuario::getUsersByPeluqueria($peluqueria);
    }

    public function crearUsuario($nombre_usuario, $correo, $nombre, $apellido1, $apellido2, $contraseña, $direccion, $peluqueria, $puesto, $administrador, $activo) {
        $nuevoUsuario = new Usuario();
        $nuevoUsuario->setNombreUsuario($nombre_usuario);
        $nuevoUsuario->setCorreo($correo); 
        $nuevoUsuario->setNombre($nombre);
        $nuevoUsuario->setApellido1($apellido1);
        $nuevoUsuario->setApellido2($apellido2);
        $nuevoUsuario->setContraseña($contraseña);
        $nuevoUsuario->setDireccion($direccion);
        $nuevoUsuario->setPeluqueria($peluqueria);
        $nuevoUsuario->setPuesto($puesto);

        // Establecer los valores booleanos para administrador y activo
        $nuevoUsuario->setAdministrador($administrador);
        $nuevoUsuario->setActivo($activo);

        $nuevoUsuario->create();
    }

    public function modificarUsuario($nombre_usuario, $correo, $nombre, $apellido1, $apellido2, $contraseña, $direccion , $peluqueria, $puesto, $administrador, $activo) {
        $usuario = new Usuario();
        $usuario->setNombreUsuario($nombre_usuario);
        $usuario->setCorreo($correo);
        $usuario->setNombre($nombre);
        $usuario->setApellido1($apellido1);
        $usuario->setApellido2($apellido2);
        $usuario->setContraseña($contraseña);
        $usuario->setDireccion($direccion);
        $usuario->setPeluqueria($peluqueria);
        $usuario->setPuesto($puesto);

        // Actualizar los valores booleanos para administrador y activo
        $usuario->setAdministrador($administrador);
        $usuario->setActivo($activo);

        $usuario->updateUser(); 
    }

    public function eliminarUsuario($nombre_usuario)
    {
        // debido a la foreign key de nombre_usuario_reseña hace falta 
        // borrar las reseñas de un usuario antes de eliminarlo
        Reseña::deleteReseñasByUsuario($nombre_usuario);
        $usuario = new Usuario();
        $usuario->setNombreUsuario($nombre_usuario);
        $usuario->deleteUser(); 
    }

    // public function modificarNombreUsuario($nombre_usuario, $nuevoNombreUsuario) {
    //     $usuario = new Usuario();
    //     $usuario->setNombreUsuario($nombre_usuario);
    //     $usuario->updateNombreUsuario($nuevoNombreUsuario);
    // }

    // public function modificarContraseña($nombre_usuario, $nuevaContraseña) {
    //     $usuario = new Usuario();
    //     $usuario->setNombreUsuario($nombre_usuario);
    //     $usuario->updateContraseña($nuevaContraseña);
    // }

    // public function modificarNombreApellidos($nombre_usuario, $nuevoNombre, $nuevoApellido1, $nuevoApellido2) {
    //     $usuario = new Usuario();
    //     $usuario->setNombreUsuario($nombre_usuario);
    //     $usuario->updateNombre($nuevoNombre);
    //     $usuario->updateApellido1($nuevoApellido1);
    //     $usuario->updateApellido2($nuevoApellido2);
    // }

    // public function modificarDireccion($nombre_usuario, $nuevaDireccion) {
    //     $usuario = new Usuario();
    //     $usuario->setNombreUsuario($nombre_usuario);
    //     $usuario->updateDireccion($nuevaDireccion);
    // }
}
?>
