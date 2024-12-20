<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloSeguridad/controlGestionarUsuarios.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/screenMensajeSistema.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/moduloSeguridad/formEditarUsuario.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/usuario.php');

// Validar autenticación
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== "SI") {
    header('Location: /');
    exit();
}

// Validar el rol
$rol = $_SESSION['rol'];
if ($rol !== "jefeVentas") {
    header('Location: /moduloSeguridad/indexPanelPrincipal.php');
    exit();
}

// Función para validar campos
function validarCamposEditarUsuario($txtUsuario, $txtClave, $txtNombres, $txtApellidos, $txtCorreo, $txtCelular, $txtDNI, $txtMascota, $txtRolID)
{
    global $nombreCampoErroneo, $mensajeError;

    if (strlen($txtUsuario) < 5) {
        $nombreCampoErroneo = 'Usuario';
        $mensajeError = 'El campo ' . $nombreCampoErroneo . ' debe tener al menos 5 caracteres';
        return false;
    }
    if (strlen($txtClave) < 8) {
        $nombreCampoErroneo = 'Clave';
        $mensajeError = 'El campo ' . $nombreCampoErroneo . ' debe tener al menos 8 caracteres';
        return false;
    }
    if (strlen($txtNombres) < 2) {
        $nombreCampoErroneo = 'Nombres';
        $mensajeError = 'El campo ' . $nombreCampoErroneo . ' debe tener más de 2 caracteres';
        return false;
    }
    if (strlen($txtApellidos) < 4) {
        $nombreCampoErroneo = 'Apellidos';
        $mensajeError = 'El campo ' . $nombreCampoErroneo . ' debe tener más de 4 caracteres';
        return false;
    }
    if (!filter_var($txtCorreo, FILTER_VALIDATE_EMAIL)) {
        $nombreCampoErroneo = 'Correo';
        $mensajeError = 'El campo ' . $nombreCampoErroneo . ' debe ser un correo válido';
        return false;
    }
    if (!ctype_digit($txtCelular) || strlen($txtCelular) != 9) {
        $nombreCampoErroneo = 'Celular';
        $mensajeError = 'El campo ' . $nombreCampoErroneo . ' debe contener exactamente 9 dígitos';
        return false;
    }
    if (!ctype_digit($txtDNI) || strlen($txtDNI) != 8) {
        $nombreCampoErroneo = 'DNI';
        $mensajeError = 'El campo ' . $nombreCampoErroneo . ' debe contener exactamente 8 dígitos';
        return false;
    }
    if (strlen($txtMascota) < 2) {
        $nombreCampoErroneo = 'Nombre de tu mascota favorita';
        $mensajeError = 'El campo ' . $nombreCampoErroneo . ' debe tener más de 2 caracteres';
        return false;
    }
    if (empty($txtRolID) || !in_array($txtRolID, [1, 2, 3])) {
        $nombreCampoErroneo = 'Rol';
        $mensajeError = 'Debe seleccionar un rol válido (Jefe de Ventas, Vendedor o Cajero)';
        return false;
    }

    return true;
}

// Procesar la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? null;

    if ($accion === 'editar') {
        $txtUsuarioId = trim($_POST['usuarioid']);
        $txtNombreUsuario = trim($_POST['nombreusuario']);
        $txtContrasena = trim($_POST['contrasena']);
        $txtNombres = trim($_POST['nombres']);
        $txtApellidos = trim($_POST['apellidos']);
        $txtTelefono = trim($_POST['telefono']);
        $txtEmail = trim($_POST['email']);
        $txtDni = trim($_POST['dni']);
        $txtRespuestaSecreta = trim($_POST['respuestasecreta']);
        $txtRolId = trim($_POST['rolid']);

        if (validarCamposEditarUsuario($txtNombreUsuario, $txtContrasena, $txtNombres, $txtApellidos, $txtEmail, $txtTelefono, $txtDni, $txtRespuestaSecreta, $txtRolId)) {
            $controlGestionarUsuariosObject = new controlGestionarUsuarios();
            $controlGestionarUsuariosObject->actualizarUsuario($txtNombreUsuario, $txtContrasena, $txtNombres, $txtApellidos, $txtTelefono, $txtEmail, $txtDni, $txtRespuestaSecreta, $txtRolId, $txtUsuarioId);
        } else {
            $formEditarUsuarioUrl = "/moduloSeguridad/indexEditarUsuario.php?" . http_build_query([
                'usuarioid' => $txtUsuarioId,
                'nombreusuario' => $txtNombreUsuario,
                'contrasena' => $txtContrasena,
                'nombres' => $txtNombres,
                'apellidos' => $txtApellidos,
                'telefono' => $txtTelefono,
                'email' => $txtEmail,
                'dni' => $txtDni,
                'respuestasecreta' => $txtRespuestaSecreta,
                'rolid' => $txtRolId,
            ]);
        
            $screenMensajeSistemaObject = new screenMensajeSistema();
            $screenMensajeSistemaObject->screenMensajeSistemaShow(
                $mensajeError . "<script>setTimeout(function(){ window.location.href = '$formEditarUsuarioUrl'; }, 5000);</script>",
                "<a href='$formEditarUsuarioUrl'>Volver al formulario de edición</a>"
            );
        }
        
    } elseif ($accion === 'eliminar') {
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $id = intval($_POST['id']);
            $controlGestionarUsuariosObject = new controlGestionarUsuarios();
            $controlGestionarUsuariosObject->eliminarUsuario($id);
        } else {
            $viewMessageSistemaObject = new screenMensajeSistema();
            $viewMessageSistemaObject->screenMensajeSistemaShow("ID de usuario no válido", "<a href='/moduloSeguridad/indexGestionarUsuarios.php'>Regresar al panel anterior</a>");
        }
    } else {
        $viewMessageSistemaObject = new screenMensajeSistema();
        $viewMessageSistemaObject->screenMensajeSistemaShow("Acción no reconocida", "<a href='/moduloSeguridad/indexGestionarUsuarios.php'>Regresar al panel anterior</a>");
    }
} else {
    header('Location: /moduloSeguridad/indexGestionarUsuarios.php');
    exit();
}
