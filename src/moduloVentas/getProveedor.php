<?php
include_once(__DIR__ . "/../moduloVentas/controlProveedores.php");
include_once(__DIR__ . "/../moduloVentas/panelProveedores.php");
include_once(__DIR__ . "/../moduloVentas/formRegistrarProveedores.php");
include_once(__DIR__ . "/../shared/screenMensajeSistema.php");

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

// Instanciar controlador y mensaje del sistema
$controlProveedores = new controlProveedores();
$screenMensajeSistema = new screenMensajeSistema(); // <-- Inicialización de la variable

// Procesar solicitud del botón "Editar Proveedor"
if (isset($_POST['btnEditarProveedor'])) {
    $idProveedor = $_POST['idProveedor'];
    $numeroRUC = trim($_POST['numeroRUC']);
    $razonSocial = trim($_POST['razonSocial']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    $direccion = trim($_POST['direccion']);

    // Validar que todos los campos tengan valores
    if (empty($numeroRUC) || empty($razonSocial) || empty($telefono) || empty($email) || empty($direccion)) {
        $controlProveedores->mostrarMensajeError(
            'Todos los campos son obligatorios.',
            $idProveedor,
            $numeroRUC,
            $razonSocial,
            $telefono,
            $email,
            $direccion
        );
        exit();
    }

    // Llamar al controlador para actualizar
    $controlProveedores->actualizarProveedor($idProveedor, $numeroRUC, $razonSocial, $telefono, $email, $direccion);
    exit();
}

// Procesar solicitud del botón "Eliminar Proveedor"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'eliminar') {
        $idProveedor = $_POST['idProveedor'];

        if (!empty($idProveedor) && is_numeric($idProveedor)) {
            // Llamar al controlador para eliminar el proveedor
            $controlProveedores->eliminarProveedor($idProveedor);
            exit(); // Detener ejecución después de eliminar
        } else {
            // Mostrar mensaje de error si el ID es inválido
            $controlProveedores->mostrarMensajeError("ID inválido o no proporcionado.");
            exit();
        }
    } else {
        // Mostrar mensaje de error si la acción no es válida
        $controlProveedores->mostrarMensajeError("Acción no válida.");
        exit();
    }
}
// Procesar solicitud del botón "Registrar Proveedor"
if (isset($_POST['btnAgregarProveedor'])) {
    $numeroRUC = htmlspecialchars($_POST['numeroRUC'], ENT_QUOTES, 'UTF-8');
    $razonSocial = htmlspecialchars($_POST['razonSocial'], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $fechaRegistro = htmlspecialchars($_POST['fechaRegistro'], ENT_QUOTES, 'UTF-8');
    $estadoProveedor = filter_input(INPUT_POST, 'estadoProveedor', FILTER_VALIDATE_INT);

    // Validar los campos
    $mensajeError = '';
    if (empty($numeroRUC) || strlen($numeroRUC) != 11 || !is_numeric($numeroRUC)) {
        $mensajeError = 'El RUC debe tener exactamente 11 dígitos numéricos.';
    } elseif (empty($razonSocial) || strlen($razonSocial) < 3) {
        $mensajeError = 'La Razón Social debe tener al menos 3 caracteres.';
    } elseif (empty($telefono) || strlen($telefono) < 7 || strlen($telefono) > 15) {
        $mensajeError = 'El teléfono debe tener entre 7 y 15 caracteres.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensajeError = 'El email ingresado no es válido.';
    } elseif (empty($direccion)) {
        $mensajeError = 'La dirección no puede estar vacía.';
    } elseif (empty($fechaRegistro)) {
        $mensajeError = 'La fecha de registro es obligatoria.';
    } elseif ($estadoProveedor === false || ($estadoProveedor != 0 && $estadoProveedor != 1)) {
        $mensajeError = 'El estado del proveedor es inválido.';
    }

    if (!empty($mensajeError)) {
        // Mostrar mensaje de error si la validación falla
        $screenMensajeSistema->screenMensajeSistemaShow("Error", "Campos inválidos","<a href='/moduloVentas/indexAgregarProveedor.php'>Regresar al panel Registrar Proveedores</a>", $mensajeError);
        exit();
    }

    // Llamar al controlador para registrar el proveedor
    $controlProveedores->registrarProveedor($numeroRUC, $razonSocial, $telefono, $email, $direccion, $fechaRegistro, $estadoProveedor);
    exit();
}


// Acción por defecto si no se envió el botón o acción no reconocida
$screenMensajeSistema->screenMensajeSistemaShow("Error", "Acción no válida.", "<a href='/moduloVentas/indexProveedores.php'>Regresar al panel principal</a>");
