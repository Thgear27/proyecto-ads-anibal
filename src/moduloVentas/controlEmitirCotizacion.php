<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/cotizaciones.php');

class controlEmitirCotizacion
{
  public function guardarNuevaCotizacion(
    $nrRucDni,
    $razonSocial,
    $direccion,
    $obra,
    $moneda,
    $productosArrayJson
  ) {
    // Decodificar el JSON de productos
    $productosArray = json_decode($productosArrayJson, true);
    if (!is_array($productosArray) || empty($productosArray)) {
      $mensajeError = 'No se han seleccionado productos válidos.';
      echo $mensajeError;
      exit();
    }

    // Crear instancia del modelo
    $cotizacionesModel = new Cotizaciones();

    // Parámetros de ejemplo (ajustar según lógica real)
    $usuarioID = 1;
    $serieComprobanteID = 1;

    // Calcular totales de forma básica
    $opGravada = 0;
    foreach ($productosArray as $prod) {
      $opGravada += floatval($prod['price']);
    }

    $totalIGV = $opGravada * 0.18;
    $importeTotal = $opGravada + $totalIGV;
    $fechaHoy = date('Y-m-d');
    $tipoPago = "Al contado";
    $formaPago = "Efectivo";
    $observaciones = "Cotización generada desde el sistema";

    // Obtener o crear el ClienteID
    $clienteID = $cotizacionesModel->obtenerClienteIdPorDocumento($nrRucDni, $razonSocial, $direccion);
    if (!$clienteID) {
      return ['success' => false, 'message' => 'No se pudo determinar el ClienteID.'];
    }

    // Guardar cotización
    $numeroCorrelativo = $cotizacionesModel->guardarNuevaCotizacion(
      $serieComprobanteID,
      $usuarioID,
      $fechaHoy,
      $fechaHoy,
      $tipoPago,
      $formaPago,
      $moneda,
      $clienteID,
      $opGravada,
      0, // OpInafecta
      0, // OpExonerada
      0, // OpGratuita
      $totalIGV,
      0, // DescuentoGlobal
      $importeTotal,
      $observaciones,
      $obra,
      $productosArray
    );

    if ($numeroCorrelativo) {
      return ['success' => true, 'message' => "Cotización guardada con el número: $numeroCorrelativo"];
    } else {
      return ['success' => false, 'message' => 'Error al guardar la cotización.'];
    }
  }
}
