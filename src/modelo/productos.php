<?php
include_once('conexion.php');

class Productos
{
  public function getProductos()
  {
    $sql = "SELECT p.ProductoID AS ID, p.Descripcion AS NombreProducto, pd.UnidadMedida AS Unidad, p.ValorUnitarioVenta AS PrecioVenta, pd.ValorUnitarioCompra AS PrecioCompra FROM producto p INNER JOIN productodetalles pd ON p.ProductoID = pd.ProductoID;";

    $conditions = array();

    if (count($conditions) > 0) {
      $sql .= " WHERE " . implode(" AND ", $conditions);
    }

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
