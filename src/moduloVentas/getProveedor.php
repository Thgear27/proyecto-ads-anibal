<?php
include_once(__DIR__ . "/../moduloVentas/controlProveedores.php");
include_once(__DIR__ . "/../moduloVentas/panelProveedores.php");
include_once(__DIR__ . "/../shared/screenMensajeSistema.php");

// Iniciar sesión
session_start();

// Validación de autenticación
if (!isset($_SESSION['autenticado'])) {
    header('Location: /');
    exit();
}

// Validación de roles
$rol = $_SESSION['rol'];
if ($rol != "vendedor" && $rol != "jefeVentas") {
    header('Location: /moduloSeguridad/indexPanelPrincipal.php');
    exit();
}

// Instanciar controlador y variables de error
$controlProveedores = new controlProveedores();
$screenMensajeSistema = new screenMensajeSistema();

// Procesar solicitud del botón "Editar Proveedor"
if (isset($_POST['btnEditarProveedor'])) {
    $idProveedor = $_POST['idProveedor'];
    $numeroRUC = trim($_POST['numeroRUC']);
    $razonSocial = trim($_POST['razonSocial']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    $direccion = trim($_POST['direccion']);

    // Validar campos
    if (empty($numeroRUC) || empty($razonSocial) || empty($telefono) || empty($email) || empty($direccion)) {
        $screenMensajeSistema->screenMensajeSistemaShow(
            "Error",
            "Todos los campos son obligatorios.",
            "/moduloVentas/indexProveedores.php"
        );
        exit();
    }

    if ($controlProveedores->verificarProveedorPorRUC($numeroRUC, $idProveedor)) {
        $screenMensajeSistema->screenMensajeSistemaShow(
            "Error",
            "El Número RUC ya existe en otro proveedor.",
            "/moduloVentas/indexEditarProveedores.php?id=$idProveedor&numeroRUC=$numeroRUC&razonSocial=$razonSocial&telefono=$telefono&email=$email&direccion=$direccion"
        );
        exit();
    }
    


    // Actualizar proveedor
    $resultado = $controlProveedores->actualizarProveedor($idProveedor, $numeroRUC, $razonSocial, $telefono, $email, $direccion);

    if ($resultado) {
        $screenMensajeSistema->screenMensajeSistemaShow(
            "Éxito",
            "Proveedor actualizado correctamente.",
            "/moduloVentas/indexProveedores.php"
        );
    } else {
        $screenMensajeSistema->screenMensajeSistemaShow(
            "Error",
            "No se pudo actualizar el proveedor. Inténtelo nuevamente.",
            "/moduloVentas/indexEditarProveedores.php?id=$idProveedor&numeroRUC=$numeroRUC&razonSocial=$razonSocial&telefono=$telefono&email=$email&direccion=$direccion"
        );
    }
    exit();
}

// Acción por defecto si no se presionó un botón
$screenMensajeSistema->screenMensajeSistemaShow(
    "Error",
    "Acción no válida.",
    "/moduloVentas/indexProveedores.php"
);
