<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/controlEmitirBoleta.php');
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

function redirigirBoletaNumeroBoleta()
{
  header('Location: /moduloVentas/indexBoleta.php?numeroBoleta=' . $_POST['txtNroBoleta']);
}

function redirigirBoletaFechas()
{
  header('Location: /moduloVentas/indexBoleta.php?desde=' . $_POST['txtFechaDesde'] . '&hasta=' . $_POST['txtFechaHasta']);
}

function redirigirBoleta()
{
  header('Location: /moduloVentas/indexBoleta.php');
}

$btnBuscarFechas = isset($_POST['btnBuscarFechas']) ? $_POST['btnBuscarFechas'] : null;
$btnBuscarNroBoleta = isset($_POST['btnBuscarNroBoleta']) ? $_POST['btnBuscarNroBoleta'] : null;
$btnGenerarPdf = isset($_POST['btnGenerarPdf']) ? $_POST['btnGenerarPdf'] : null;

if (validarBoton($btnBuscarFechas)) {
  redirigirBoletaFechas();
} elseif (validarBoton($btnBuscarNroBoleta)) {
  redirigirBoletaNumeroBoleta();
} elseif (validarBoton($btnGenerarPdf)) {
  $control = new controlEmitirBoleta();
  $control->generarBoletasPdf($_POST['txtIDBoleta']);
} else {
  redirigirBoleta();
}
