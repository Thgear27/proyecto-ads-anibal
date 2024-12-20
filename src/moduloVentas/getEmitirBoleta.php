<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/boletas.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/controlEmitirBoleta.php');

session_start();

$mensajeError = '';

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';

// Si el rol no es "vendedor" o "jefeVentas", redirigir al panel principal
if ($rol != "vendedor" && $rol != "jefeVentas") {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
}

// Validar datos recibidos
$nrRucDni = isset($_POST['txtNrRucDni']) ? trim($_POST['txtNrRucDni']) : '';
$razonSocial = isset($_POST['txtRazonSocial']) ? trim($_POST['txtRazonSocial']) : '';
$direccion = isset($_POST['txtDireccion']) ? trim($_POST['txtDireccion']) : '';
$obra = isset($_POST['txtObra']) ? trim($_POST['txtObra']) : '';
$moneda = isset($_POST['txtMoneda']) ? trim($_POST['txtMoneda']) : '';
$productosArrayJson = isset($_POST['productsArray']) ? $_POST['productsArray'] : '';

// Validación simple
if ($nrRucDni === '' || $razonSocial === '' || $direccion === '' || $obra === '' || $moneda === '' || $productosArrayJson === '') {
  $mensajeError = 'Todos los campos son requeridos.';
  echo $mensajeError;
  exit();
}

// Decodificar el array de productos
$productosArray = json_decode($productosArrayJson, true);
if (!is_array($productosArray) || empty($productosArray)) {
  $mensajeError = 'No se han seleccionado productos válidos.';
  echo $mensajeError;
  exit();
}

// Verificar cantidades válidas
foreach ($productosArray as $producto) {
  if (!isset($producto['id'], $producto['name'], $producto['price'], $producto['amount']) || $producto['amount'] <= 0) {
    $mensajeError = 'Cada producto debe incluir una cantidad válida.';
    echo $mensajeError;
    exit();
  }
}

if (isset($_POST['btnSiguiente'])) {
  $control = new controlEmitirBoleta();
  $resultado = $control->guardarNuevaBoleta(
    $nrRucDni,
    $razonSocial,
    $direccion,
    $obra,
    $moneda,
    $productosArray
  );

  if ($resultado['success']) {
    header('Location: /moduloVentas/indexBoleta.php?message=' . urlencode($resultado['message']));
    exit();
  } else {
    echo $resultado['message'];
    exit();
  }
}
