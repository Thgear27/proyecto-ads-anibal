<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/reporteCompras/controlReporteCompras.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/compras.php');

session_start();

$mensajeError = '';

$rol = $_SESSION['rol'];

// Si el rol no es "vendedor" o "jefeVentas", redirigir al panel principal
if ($rol != "vendedor" && $rol != "jefeVentas" && $rol != null) {
    header('Location: /moduloSeguridad/indexPanelPrincipal.php');
    exit();
} else if ($rol == null) {
    header('Location: /moduloSeguridad/getUsuario.php');
    exit();
}

function validarBoton($boton){
    return isset($boton);
}

function redirigirComprasFechas(){
    header('Location: /moduloVentas/reporteCompras/indexReporteCompras.php?desde=' . $_POST['txtFechaDesde'] . '&hasta=' . $_POST['txtFechaHasta']);
}

$btnReporteCompras = $_POST['btnReporteCompras'] ?? null;
$btnBuscar = $_POST['btnBuscar'] ?? null;
$btnImprimir = $_POST['btnImprimir'] ?? null;

if (validarBoton($btnReporteCompras)) {
    header('Location: /moduloVentas/reporteCompras/indexReporteCompras.php');
    exit();
} else if (validarBoton($btnBuscar)) {
    redirigirComprasFechas();
} else if (validarBoton($btnImprimir)) {
    $fechadesde = $_POST['txtFechaDesde'] ?? null;
    $fechahasta = $_POST['txtFechaHasta'] ?? null;
    $compras = new compras();
    $compras = $compras->getCompras($fechadesde, $fechahasta);
    $objControlReporteCompras = new controlReporteCompras();
    $objControlReporteCompras->generarPdf($fechadesde, $fechahasta, $compras);
} else {
    header('Location: /moduloSeguridad/getUsuario.php');
    exit();
}