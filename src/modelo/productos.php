<?php include_once('conexion.php');

class Productos
{
    public function getProductos()
    {
        $sql = "SELECT p.ProductoID, p.Descripcion, pd.UnidadMedida ,p.ValorUnitarioVenta, pd.ValorUnitarioCompra, pr.RazonSocial 
                FROM productodetalles pd 
                JOIN producto p ON pd.ProductoID = p.ProductoID 
                JOIN proveedor pr ON pd.ProveedorID = pr.ProveedorID
                WHERE p.EstadoProducto = 1";

        $conexion = Conexion::conectarBD();
        $respuesta = $conexion->query($sql);

        if (!$respuesta) {
            die("Error en la consulta: " . $conexion->error);
        }

        $productos = array();

        while ($fila = $respuesta->fetch_assoc()) {
            $productos[] = $fila;
        }

        Conexion::desConectarBD();
        return $productos;
    }
}