<?php
session_start();

$mensajeError = '';

$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';

// Si el rol no es "vendedor" o "jefeVentas", redirigir al panel principal
if ($rol != "vendedor" && $rol != "jefeVentas") {
  header('Location: /moduloSeguridad/indexPanelPrincipal.php');
  exit();
}

function validarBoton($btnbuscar)
{
  return isset($btnbuscar);
}

echo "<pre>";
echo "Contenido de \$_POST:\n";
print_r($_POST);
echo "\n\nContenido de \$_FILES:\n";
print_r($_FILES);
echo "</pre>";

if (validarBoton($_POST['btnSiguiente'])) {
  echo "Siguiente";
} else {
  echo "Hay un problema dio mio, aaah";
}