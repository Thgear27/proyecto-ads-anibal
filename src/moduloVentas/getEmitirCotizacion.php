<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/cotizaciones.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/controlEmitirCotizacion.php');

session_start();

$mensajeError = '';

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';

// Si el rol no es "vendedor" o "jefeVentas", redirigir al panel principal
if ($rol != "vendedor" && $rol != "jefeVentas") {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
}

function validarBoton($btnbuscar)
{
  return isset($btnbuscar);
}

// Validar datos recibidos
$nrRucDni = isset($_POST['txtNrRucDni']) ? trim($_POST['txtNrRucDni']) : '';
$razonSocial = isset($_POST['txtRazonSocial']) ? trim($_POST['txtRazonSocial']) : '';
$direccion = isset($_POST['txtDireccion']) ? trim($_POST['txtDireccion']) : '';
$obra = isset($_POST['txtObra']) ? trim($_POST['txtObra']) : '';
$moneda = isset($_POST['txtMoneda']) ? trim($_POST['txtMoneda']) : '';
$productosArrayJson = isset($_POST['productsArray']) ? $_POST['productsArray'] : '';

// Validación simple (puedes hacerla más completa)
if ($nrRucDni === '' || $razonSocial === '' || $direccion === '' || $obra === '' || $moneda === '' || $productosArrayJson === '') {
  $mensajeError = 'Todos los campos son requeridos.';
  echo $mensajeError;
  exit();
}


if (validarBoton($_POST['btnSiguiente'])) {
  $control = new controlEmitirCotizacion();
  $resultado = $control->guardarNuevaCotizacion(
    $nrRucDni,
    $razonSocial,
    $direccion,
    $obra,
    $moneda,
    $productosArrayJson
  );

  header('Location: /moduloVentas/indexCotizacion.php?');
}
