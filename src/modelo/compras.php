<?php
include_once('conexion.php');

class Compras
{
  public function getCompraById($idCompra)
  {
    $sql = "SELECT 
              cr.ComprobanteRecibidoID,
              cr.TipoComprobanteRecibido,
              cr.NumeroSerieYCorrelativo,
              cr.FechaEmision,
              cr.FechaVencimiento,
              cr.TipoPago,
              cr.FormaPago,
              cr.ProveedorID,
              cr.Moneda,
              cr.Observaciones,
              p.RazonSocial AS Proveedor,
              p.NumeroRUC,
              cr.ImporteTotal
            FROM 
              comprobanterecibido cr
            INNER JOIN 
              proveedor p ON cr.ProveedorID = p.ProveedorID
            WHERE cr.ComprobanteRecibidoID = '$idCompra' AND cr.Estado = 1";

    $conexion = Conexion::conectarBD();
    $respuesta = $conexion->query($sql);

    if (!$respuesta) {
      die("Error en la consulta: " . $conexion->error);
    }

    $compra = null;

    if ($fila = $respuesta->fetch_assoc()) {
      $compra = $fila;
    }

    Conexion::desConectarBD();
    return $compra;
  }

  public function getCompras($fechadesde = null, $fechahasta = null)
  {
    $sql = "SELECT 
              cr.ComprobanteRecibidoID,
              cr.TipoComprobanteRecibido,
              cr.NumeroSerieYCorrelativo,
              cr.FechaEmision,
              cr.FechaVencimiento,
              cr.TipoPago,
              cr.FormaPago,
              cr.Moneda,
              cr.Observaciones,
              p.RazonSocial AS Proveedor,
              p.NumeroRUC,
              cr.ImporteTotal
            FROM 
              comprobanterecibido cr
            INNER JOIN 
              proveedor p ON cr.ProveedorID = p.ProveedorID
            WHERE cr.Estado = 1";

    $conditions = array();

    if ($fechadesde !== null && $fechadesde !== '') {
      $conditions[] = "cr.FechaEmision >= '$fechadesde'";
    }

    if ($fechahasta !== null && $fechahasta !== '') {
      $conditions[] = "cr.FechaEmision <= '$fechahasta'";
    }

    if (count($conditions) > 0) {
      $sql .= " AND " . implode(" AND ", $conditions);
    }

    $conexion = Conexion::conectarBD();
    $respuesta = $conexion->query($sql);

    if (!$respuesta) {
      die("Error en la consulta: " . $conexion->error);
    }

    $compras = array();

    while ($fila = $respuesta->fetch_assoc()) {
      $compras[] = $fila;
    }

    Conexion::desConectarBD();
    return $compras;
  }

  public function agregarCompra($ruc, $tipo, $fecha, $concepto, $monto, $idProveedor)
  {
    $conexion = Conexion::conectarBD();

    // Genera un número de serie y correlativo para la compra (de la forma F001, F002, etc.)
    $sqlSerie = "SELECT COUNT(*) AS Cantidad FROM comprobanterecibido";
    $respuesta = $conexion->query($sqlSerie);

    if (!$respuesta) {
      die("Error en la consulta: " . $conexion->error);
    }

    // Se genera el número de serie incrementando el valor actual de la cantidad
    $serie = 'F' . str_pad($respuesta->fetch_assoc()['Cantidad'] + 1, 3, '0', STR_PAD_LEFT);

    // Insertar la compra en la tabla comprobanterecibido con estado 1 (activo)
    $sql = "INSERT INTO comprobanterecibido (
                NumeroSerieYCorrelativo, TipoComprobanteRecibido, FechaEmision, FechaVencimiento, 
                TipoPago, FormaPago, Moneda, ImporteTotal, Observaciones, Estado, ProveedorID, 
                `Op.Inafecta`, `Op.Exonerada`, `Op.Gratuita`, `Op.Gravada`, `TotalIGV`, DescuentoGlobal, Archivo
            ) VALUES (
                '$serie', '$tipo', '$fecha', '$fecha', 
                'Al contado', 'Efectivo', 'PEN', '$monto', '$concepto', 1, '$idProveedor',
                0, 0, 0, 0, 0, 0, 'default.pdf'
            )";

    if ($conexion->query($sql) === TRUE) {
      $idCompra = $conexion->insert_id;  // Obtener el ID de la compra insertada
      Conexion::desConectarBD();
      return $idCompra;
    } else {
      die("Error al agregar la compra: " . $conexion->error);
    }
  }

  // Editar una compra existente
  public function actualizarCompra($idCompra, $ruc, $tipo, $fecha, $concepto, $monto, $idProveedor)
  {
    $conexion = Conexion::conectarBD();

    // Actualizar la compra en la tabla comprobanterecibido
    $sql = "UPDATE comprobanterecibido
            SET TipoComprobanteRecibido = '$tipo', FechaEmision = '$fecha', FechaVencimiento = '$fecha', Observaciones = '$concepto', ImporteTotal = '$monto', ProveedorID = '$idProveedor'
            WHERE ComprobanteRecibidoID = '$idCompra' AND Estado = 1";

    if ($conexion->query($sql) === TRUE) {
      // Actualizar detalles de la compra (ajustar según el modelo real)
      $sqlDetalle = "UPDATE compradetails
                     SET Monto = '$monto'
                     WHERE CompraID = '$idCompra'";
      $conexion->query($sqlDetalle);
      Conexion::desConectarBD();
      return true;
    } else {
      die("Error al actualizar la compra: " . $conexion->error);
    }
  }

  // Eliminar una compra (marcar como eliminada cambiando el estado a 0)
  public function descartarCompra($idCompra)
  {
    $conexion = Conexion::conectarBD();

    // Cambiar el estado de la compra a 0 (eliminado)
    $sql = "UPDATE comprobanterecibido
            SET Estado = 0
            WHERE ComprobanteRecibidoID = '$idCompra' AND Estado = 1";

    if ($conexion->query($sql) === TRUE) {
      // Eliminar detalles de la compra
      $sqlDetalle = "DELETE FROM compradetails WHERE CompraID = '$idCompra'";
      $conexion->query($sqlDetalle);
      Conexion::desConectarBD();
      return true;
    } else {
      die("Error al eliminar la compra: " . $conexion->error);
    }
  }
}