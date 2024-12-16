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
}
