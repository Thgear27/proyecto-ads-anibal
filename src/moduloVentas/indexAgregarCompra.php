<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/panelAgregarCompra.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/Eproveedor.php');

session_start();

if (!isset($_SESSION['autenticado'])) {
  header('Location: /');
  exit();
}

$rol = $_SESSION['rol'];
if ($rol != "jefeVentas" && $rol != "vendedor") {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
}

$proveedoresObj = new Eproveedor();
$proveedores = $proveedoresObj->obtenerProveedores();

$panelAgregarCompraObject = new panelAgregarCompra();
$panelAgregarCompraObject->panelAgregarCompraShow($proveedores);
