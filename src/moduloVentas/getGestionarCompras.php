<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/controlGestionarCompras.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/screenMensajeSistema.php');

session_start();

$mensajeError = '';

$rol = $_SESSION['rol'] ?? null;

// Si el rol no es "vendedor" o "jefeVentas", redirigir al panel principal
if ($rol != "vendedor" && $rol != "jefeVentas" && $rol != null) {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
} else if ($rol == null) {
  header('Location: /moduloSeguridad/getUsuario.php');
  exit();
}

function validarBoton($boton)
{
  return isset($boton);
}

function verificarCamposCompra($ruc, $tipo, $fecha, $concepto, $monto, $idProveedor)
{
  global $mensaje;
  if (strlen($ruc) < 4 || empty($tipo) || empty($fecha) || strlen($concepto) < 4 || empty($monto)) {
    $mensaje = 'Llenar todos los campos correctamente';
    return false;
  } else if (empty($idProveedor)) {
    $mensaje = 'Seleccione un proveedor';
    return false;
  }
  return true;
}

$btnCompras = $_POST['btnCompras'] ?? null;
$btnAgregarCompra = $_POST['btnAgregarCompra'] ?? null;
$btnEditarCompra = $_POST['btnEditarCompra'] ?? null;
$btnEliminarCompra = $_POST['btnEliminarCompra'] ?? null;
$btnGuardarCompra = $_POST['btnGuardarCompra'] ?? null;
$btnGuardar = $_POST['btnGuardar'] ?? null;
$btnConfirmarEliminar = $_POST['btnConfirmarEliminar'] ?? null;

$objControlGestionarCompras = new controlGestionarCompras();

if (validarBoton($btnCompras)) {
  header('Location: /moduloVentas/indexGestionarCompras.php');
} else if (validarBoton($btnAgregarCompra)) {
  header('Location: /moduloVentas/indexAgregarCompra.php');
} else if (validarBoton($btnEditarCompra)) {
  $idCompra = $_POST['txtIdCompra'];
  $_SESSION['txtIdCompra'] = $idCompra;
  header('Location: /moduloVentas/indexEditarCompra.php');
} else if (validarBoton($btnEliminarCompra)) {
  $idCompra = $_POST['txtIdCompra'];
  $_SESSION['txtIdCompra'] = $idCompra;
  $objControlGestionarCompras->mostrarMensajeConfirmacion();
} else if (validarBoton($btnGuardarCompra)) {
  $ruc = $_POST['ruc'];
  $tipo = $_POST['tipo'];
  $fecha = $_POST['fecha'];
  $concepto = $_POST['concepto'];
  $monto = $_POST['monto'];
  $idProveedor = $_POST['proveedor'];

  if (verificarCamposCompra($ruc, $tipo, $fecha, $concepto, $monto, $idProveedor)) {
    $objControlGestionarCompras->agregarCompra($ruc, $tipo, $fecha, $concepto, $monto, $idProveedor);
  } else {
    $mensajeSistema = new screenMensajeSistema();
    $mensajeSistema->screenMensajeSistemaShow($mensaje, "<a href='/moduloVentas/indexAgregarCompra.php'>Volver</a>");
  }
} else if (validarBoton($btnGuardar)) {
  $ruc = $_POST['ruc'];
  $tipo = $_POST['tipo'];
  $fecha = $_POST['fecha'];
  $concepto = $_POST['concepto'];
  $monto = $_POST['monto'];
  $idProveedor = $_POST['proveedor'];
  $idCompra = $_POST['txtIdCompra'];

  if (verificarCamposCompra($ruc, $tipo, $fecha, $concepto, $monto, $idProveedor)) {
    $objControlGestionarCompras->editarCompra($idCompra, $ruc, $tipo, $fecha, $concepto, $monto, $idProveedor);
  } else {
    $mensajeSistema = new screenMensajeSistema();
    $mensajeSistema->screenMensajeSistemaShow($mensaje, "<a href='/moduloVentas/indexEditarCompra.php'>Volver</a>");
  }
} else if (validarBoton($btnConfirmarEliminar)) {
  $idCompra = $_SESSION['txtIdCompra'];
  $objControlGestionarCompras->eliminarCompra($idCompra);
} else {
  header('Location: /moduloSeguridad/getUsuario.php');
  exit();
}
