<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/controlEmitirCotizacion.php');
session_start();

$mensajeError = '';

$rol = $_SESSION['rol'];

// Si el rol no es "vendedor" o "jefeVentas", redirigir al panel principal
if ($rol != "vendedor" && $rol != "jefeVentas") {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
}

function validarBoton($btnbuscar)
{
  return isset($btnbuscar);
}

function redirigirCotizacionNumeroCotizacion()
{
  header('Location: /moduloVentas/indexCotizacion.php?numerocotizacion=' . $_POST['txtNroCotizacion']);
}

function redirigirCotizacionFechas()
{
  header('Location: /moduloVentas/indexCotizacion.php?desde=' . $_POST['txtFechaDesde'] . '&hasta=' . $_POST['txtFechaHasta']);
}

function redirigirCotizacion()
{
  header('Location: /moduloVentas/indexCotizacion.php');
}

$btnBuscarFechas = $_POST['btnBuscarFechas'];
$btnBuscarNrcotaizacion = $_POST['btnBuscarNrcotaizacion'];
$btnGenerarPdf = $_POST['btnGenerarPdf'];

if (validarBoton($btnBuscarFechas)) {
  redirigirCotizacionFechas();
} elseif (validarBoton($btnBuscarNrcotaizacion)) {
  redirigirCotizacionNumeroCotizacion();
} elseif (validarBoton($btnGenerarPdf)) {
  $control = new controlEmitirCotizacion();
  $control->generarCotizacionesPdf($_POST['txtIDCotizacion']);
} else {
  redirigirCotizacion();
}
