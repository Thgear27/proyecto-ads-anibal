<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/panelEditarCompra.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/compras.php');
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

if (!isset($_SESSION['txtIdCompra'])) {
  header('Location: /moduloVentas/indexGestionarCompras.php');
  exit();
}

$compraId = $_SESSION['txtIdCompra'];

$comprasObj = new Compras();
$compra = $comprasObj->getCompraById($compraId);

$proveedoresObj = new Eproveedor();
$proveedores = $proveedoresObj->obtenerProveedores();

$panelEditarCompraObject = new panelEditarCompra();
$panelEditarCompraObject->panelEditarCompraShow($compra, $proveedores);
