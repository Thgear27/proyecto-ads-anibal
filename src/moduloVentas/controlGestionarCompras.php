<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/compras.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/Eproveedor.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/screenMensajeSistema.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/mensajeConfirmacionCompra.php');

class controlGestionarCompras
{
  public function agregarCompra($ruc, $tipo, $fecha, $concepto, $monto, $idProveedor)
  {
    $compra = new Compras();
    $idCompra = $compra->agregarCompra($ruc, $tipo, $fecha, $concepto, $monto, $idProveedor);
    header('Location: /moduloVentas/indexGestionarCompras.php');
    exit();
  }

  public function editarCompra($idCompra, $ruc, $tipo, $fecha, $concepto, $monto, $idProveedor)
  {
    $compra = new Compras();
    $compra->actualizarCompra($idCompra, $ruc, $tipo, $fecha, $concepto, $monto, $idProveedor);
    header('Location: /moduloVentas/indexGestionarCompras.php');
    exit();
  }

  public function mostrarMensajeConfirmacion()
  {
    $idCompra = $_SESSION['idCompra'];
    $mensajeConfirmacion = new mensajeConfirmacionCompra();
    $mensajeConfirmacion->mensajeConfirmacionCompraShow($idCompra);
  }

  public function eliminarCompra($idCompra)
  {
    $compra = new Compras();
    $compra->descartarCompra($idCompra);
    header('Location: /moduloVentas/indexGestionarCompras.php');
    exit();
  }
}
