<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/reporteCompras/panelReporteCompras.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/compras.php');

session_start();

if (!isset($_SESSION['autenticado'])) {
  header('Location: /moduloSeguridad/getUsuario.php');
  exit();
}

$rol = $_SESSION['rol'];

// Si el rol no es "vendedor" o "jefeVentas", redirigir al panel principal
if ($rol != "vendedor" && $rol != "jefeVentas") {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
}

$compras = null;
$fechadesde = $_GET['desde'] ?? null;
$fechahasta = $_GET['hasta'] ?? null;

$objCompras = new Compras();
$compras = $objCompras->getCompras($fechadesde, $fechahasta);

$objPanelReporteCompras = new panelReporteCompras();
$objPanelReporteCompras->panelReporteComprasShow($compras);

