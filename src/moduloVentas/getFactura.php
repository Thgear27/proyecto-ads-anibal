<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/controlEmitirFactura.php');
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

function redirigirFacturaNumeroFactura()
{
  header('Location: /moduloVentas/indexFactura.php?numeroFactura=' . $_POST['txtNroFactura']);
}

function redirigirFacturaFechas()
{
  header('Location: /moduloVentas/indexFactura.php?desde=' . $_POST['txtFechaDesde'] . '&hasta=' . $_POST['txtFechaHasta']);
}

function redirigirFactura()
{
  header('Location: /moduloVentas/indexFactura.php');
}

$btnBuscarFechas = isset($_POST['btnBuscarFechas']) ? $_POST['btnBuscarFechas'] : null;
$btnBuscarNroFactura = isset($_POST['btnBuscarNroFactura']) ? $_POST['btnBuscarNroFactura'] : null;
$btnGenerarPdf = isset($_POST['btnGenerarPdf']) ? $_POST['btnGenerarPdf'] : null;

if (validarBoton($btnBuscarFechas)) {
  redirigirFacturaFechas();
} elseif (validarBoton($btnBuscarNroFactura)) {
  redirigirFacturaNumeroFactura();
} elseif (validarBoton($btnGenerarPdf)) {
  $control = new controlEmitirFactura();
  $control->generarFacturasPdf($_POST['txtIDFactura']);
} else {
  redirigirFactura();
}
