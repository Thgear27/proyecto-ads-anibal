<?php
include_once('conexion.php');

class Cotizaciones
{
  public function getCotizaciones($numerocotizacion = null, $fechadesde = null, $fechahasta = null)
  {
    $sql = "SELECT ce.SerieComprobanteID, ce.NumeroCorrelativo, cl.NombreCompletoORazonSocial AS Cliente, ce.Obra, ce.FechaEmision, ce.ImporteTotal 
            FROM cotizacionemitida ce
            INNER JOIN cliente cl ON ce.ClienteID = cl.ClienteID";

    $conditions = array();

    if ($numerocotizacion !== null && $numerocotizacion !== '') {
      $conditions[] = "ce.NumeroCorrelativo = $numerocotizacion";
    }

    if ($fechadesde !== null && $fechadesde !== '') {
      $conditions[] = "ce.FechaEmision >= '$fechadesde'";
    }

    if ($fechahasta !== null && $fechahasta !== '') {
      $conditions[] = "ce.FechaEmision <= '$fechahasta'";
    }

    if (count($conditions) > 0) {
      $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $conexion = Conexion::conectarBD();
    $respuesta = $conexion->query($sql);

    if (!$respuesta) {
      die("Error en la consulta: " . $conexion->error);
    }

    $cotizaciones = array();

    while ($fila = $respuesta->fetch_assoc()) {
      $cotizaciones[] = $fila;
    }

    Conexion::desConectarBD();
    return $cotizaciones;
  }

  public function obtenerClienteIdPorDocumento($nrRucDni, $razonSocial, $direccion)
  {
    $conexion = Conexion::conectarBD();

    // Suponemos que el campo NumeroDocumentoIdentidad es único y basta con buscarlo
    $nrRucDni = $conexion->real_escape_string($nrRucDni);

    $sql = "SELECT ClienteID FROM cliente WHERE NumeroDocumentoIdentidad = '$nrRucDni' LIMIT 1";
    $respuesta = $conexion->query($sql);

    if ($respuesta && $respuesta->num_rows > 0) {
      $fila = $respuesta->fetch_assoc();
      $clienteID = $fila['ClienteID'];
    } else {
      // Si no existe, podríamos crearlo aquí
      $razonSocial = $conexion->real_escape_string($razonSocial);
      $direccion = $conexion->real_escape_string($direccion);
      $hoy = date('Y-m-d');
      // TipoDocumentoIdentidad y demás datos podrían ser asumidos o cambiados según la lógica del negocio
      $sqlInsert = "INSERT INTO cliente (TipoDocumentoIdentidad, NumeroDocumentoIdentidad, NombreCompletoORazonSocial, Telefono, Email, Direccion, FechaRegistro)
                    VALUES ('DNI', '$nrRucDni', '$razonSocial', 0, '', '$direccion', '$hoy')";
      if ($conexion->query($sqlInsert)) {
        $clienteID = $conexion->insert_id;
      } else {
        $clienteID = false;
      }
    }

    Conexion::desConectarBD();
    return $clienteID;
  }

  public function guardarNuevaCotizacion(
    $serieComprobanteID,
    $usuarioID,
    $fechaEmision,
    $fechaVencimiento,
    $tipoPago,
    $formaPago,
    $moneda,
    $clienteID,
    $opGravada,
    $opInafecta,
    $opExonerada,
    $opGratuita,
    $totalIGV,
    $descuentoGlobal,
    $importeTotal,
    $observaciones,
    $obra,
    $productosArray
  ) {
    $conexion = Conexion::conectarBD();

    // Primero, obtenemos el último NumeroCorrelativo de la serie para incrementarlo
    $sqlMax = "SELECT IFNULL(MAX(NumeroCorrelativo), 0) as maxCorr FROM cotizacionemitida WHERE SerieComprobanteID = $serieComprobanteID";
    $respuestaMax = $conexion->query($sqlMax);
    $filaMax = $respuestaMax->fetch_assoc();
    $numeroCorrelativo = $filaMax['maxCorr'] + 1;

    $sqlInsert = "INSERT INTO cotizacionemitida 
    (SerieComprobanteID, NumeroCorrelativo, UsuarioID, FechaEmision, FechaVencimiento, TipoPago, FormaPago, Moneda, ClienteID, `Op.Inafecta`, `Op.Exonerada`, `Op.Gratuita`, `Op.Gravada`, TotalIGV, DescuentoGlobal, ImporteTotal, Observaciones, Obra)
    VALUES
    ($serieComprobanteID, $numeroCorrelativo, $usuarioID, '$fechaEmision', '$fechaVencimiento', '$tipoPago', '$formaPago', '$moneda', $clienteID, $opInafecta, $opExonerada, $opGratuita, $opGravada, $totalIGV, $descuentoGlobal, $importeTotal, '$observaciones', '$obra')";

    if (!$conexion->query($sqlInsert)) {
      die("Error al insertar cotización: " . $conexion->error);
    }

    $cotizacionID = $conexion->insert_id;

    // Insertar detalles
    foreach ($productosArray as $prod) {
      $productoID = (int)$prod['id'];
      $cantidad = 1; // suposición
      $precioVenta = (float)$prod['price'];
      $valorUnitarioVenta = $precioVenta; // Podrías ajustar según tu lógica
      $descuento = 0; // Suposición
      $total = $precioVenta * $cantidad;

      $sqlDet = "INSERT INTO cotizacionemitidadetalles
      (CotizacionEmitidaID, ProductoDetallesID, Cantidad, PrecioUnitarioVenta, ValorUnitarioVenta, Descuento, Total)
      VALUES
      ($cotizacionID, $productoID, $cantidad, $precioVenta, $valorUnitarioVenta, $descuento, $total)";

      if (!$conexion->query($sqlDet)) {
        die("Error al insertar detalle de cotización: " . $conexion->error);
      }
    }

    Conexion::desConectarBD();
    return $numeroCorrelativo;
  }
}
