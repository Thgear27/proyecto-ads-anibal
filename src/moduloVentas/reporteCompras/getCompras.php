<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloVentas/reporteVentas/controlReporteCompras.php');
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
    //header('Location: /indexReporteCompras.php?desde=' . $_POST['txtFechaDesde'] . '&hasta=' . $_POST['txtFechaHasta']);
    //header('Location: /moduloVentas/reporteCompras/indexReporteCompras.php');
    //exit();
    echo $_SERVER['DOCUMENT_ROOT'];
}

$btnReporteCompras = $_POST['btnReporteCompras'] ?? null;
$btnBuscar = $_POST['btnBuscar'] ?? null;
$btnImprimir = $_POST['btnImprimir'] ?? null;

if (validarBoton($btnReporteCompras)) {
    header('Location: /moduloVentas/reporteCompras/indexReporteCompras.php');
    exit();
} else if (validarBoton($btnBuscar)) {
    header('Location: /moduloVentas/emitirBoleta.php');
    exit();
} else if (validarBoton($btnImprimir)) {


} else {
    header('Location: /moduloSeguridad/getUsuario.php');
    exit();
}