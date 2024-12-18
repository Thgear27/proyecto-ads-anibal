<?php
include_once('conexion.php');

class Usuario
{
    // Validar si el usuario existe
    public function validarLogin($login)
    {
        $sql = "SELECT NombreUsuario FROM usuario WHERE NombreUsuario = '$login'";
        $conexion = Conexion::conectarBD();
        $respuesta = $conexion->query($sql);

        if (!$respuesta) {
            die("Error en la consulta: " . $conexion->error);
        }

        $numFilas = $respuesta->num_rows;
        Conexion::desConectarBD();

        return $numFilas === 1 ? 1 : 0;
    }

    // Validar si la contraseña es correcta
    public function validarPassword($login, $password)
    {
        $sql = "SELECT NombreUsuario FROM usuario WHERE NombreUsuario = '$login' AND Contraseña = '$password'";
        $conexion = Conexion::conectarBD();
        $respuesta = $conexion->query($sql);

        if (!$respuesta) {
            die("Error en la consulta: " . $conexion->error);
        }

        $numFilas = $respuesta->num_rows;
        Conexion::desConectarBD();

        return $numFilas === 1 ? 1 : 0;
    }

    // Validar si el usuario está activo
    public function validarEstado($login)
    {
        $sql = "SELECT EstadoUsuario FROM usuario WHERE NombreUsuario = '$login' AND EstadoUsuario = '1'";
        $conexion = Conexion::conectarBD();
        $respuesta = $conexion->query($sql);

        if (!$respuesta) {
            die("Error en la consulta: " . $conexion->error);
        }

        $numFilas = $respuesta->num_rows;
        Conexion::desConectarBD();

        // Si hay una fila, el usuario está activo
        return $numFilas === 1 ? 1 : 0;
    }

    public function verificarRol($login)
    {
        $sql = "SELECT RolID FROM usuario WHERE NombreUsuario = '$login'";
        $conexion = Conexion::conectarBD();
        $respuesta = $conexion->query($sql);

        if (!$respuesta) {
            die("Error en la consulta: " . $conexion->error);
        }

        if ($fila = $respuesta->fetch_assoc()) {
            $rol = $fila['RolID'];

            // Convertir RolID en un nombre de rol
            switch ($rol) {
                case 1:
                    $rolNombre = "jefeVentas";
                    break;
                case 2:
                    $rolNombre = "vendedor";
                    break;
                case 3:
                    $rolNombre = "cajero";
                    break;
                default:
                    $rolNombre = "desconocido";
            }

            Conexion::desConectarBD();
            return $rolNombre;
        }

        Conexion::desConectarBD();
        return null; // No se encontró el rol
    }
}
