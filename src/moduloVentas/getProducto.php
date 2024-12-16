<?php
include_once('./controlGestionarProductos.php');

session_start();

$mensajeError = '';

$rol = $_SESSION['rol'];

// Si el rol no es "vendedor" o "jefeVentas", redirigir al panel principal
if ($rol != "vendedor" && $rol != "jefeVentas") {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
}

function validarBoton($boton){
    return isset($boton);
}

$btnProductos = $_POST['btnProductos'] ?? null;
$btnAgregarProducto = $_POST['btnAgregarProducto'] ?? null;
$btnEditarProducto = $_POST['btnEditarProducto'] ?? null;
$btnEliminarProducto = $_POST['btnEliminarProducto'] ?? null;

$objControlGestionarProductos = new controlGestionarProductos();

if (validarBoton($btnProductos)) {
    $objControlGestionarProductos->listarProductos();
} else if (validarBoton($btnAgregarProducto)) {
    
} else if (validarBoton($btnEditarProducto)) {
    
} else if (validarBoton($btnEliminarProducto)) {
    
} else {
    header('Location: /moduloSeguridad/getUsuario.php');
    exit();
}