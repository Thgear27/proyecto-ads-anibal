<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/conexion.php');

class Eproveedor
{
    public function obtenerProveedores()
    {
        $conexion = Conexion::conectarBD(); // Conectar a la base de datos

        $sql = "SELECT * FROM proveedor"; // Consulta para obtener todos los proveedores
        $resultado = $conexion->query($sql);

        $proveedores = [];
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $proveedores[] = $fila;
            }
        }

        Conexion::desConectarBD(); // Cerrar conexión

        return $proveedores; // Retornar el array de proveedores
    }

    public function actualizarProveedor($id, $numeroRUC, $razonSocial, $telefono, $email, $direccion)
    {
        $conexion = Conexion::conectarBD(); // Llamar al método estático de conexión

        $sql = "UPDATE proveedor SET 
                NumeroRUC = '$numeroRUC', 
                RazonSocial = '$razonSocial', 
                Telefono = '$telefono', 
                Email = '$email', 
                Direccion = '$direccion'
                WHERE ProveedorID = $id";

        $resultado = $conexion->query($sql);

        Conexion::desConectarBD(); // Cerrar conexión

        return $resultado;
    }

    public function verificarProveedorPorRUC($numeroRUC, $idProveedor = null)
    {
        $conexion = Conexion::conectarBD(); // Llamar al método estático de conexión

        $sql = "SELECT ProveedorID FROM proveedor WHERE NumeroRUC = '$numeroRUC'";
        if ($idProveedor !== null) {
            $sql .= " AND ProveedorID != $idProveedor";
        }

        $resultado = $conexion->query($sql);

        Conexion::desConectarBD(); // Cerrar conexión

        return $resultado->num_rows > 0;
    }
}
