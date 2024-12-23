<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/panelGestionarCompras.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/compras.php');

session_start();

if (!isset($_SESSION['autenticado'])) {
  header('Location: /');
  exit();
}

$rol = $_SESSION['rol'];

if ($rol != "jefeVentas") {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
}

$comprasObj = new Compras();
$compras = $comprasObj->getCompras();

$panelGestionarComprasObject = new panelGestionarCompras();
$panelGestionarComprasObject->panelGestionarComprasShow($compras);
