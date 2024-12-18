<?php
include_once("../shared/pantalla.php");

class menuPrincipalSistema extends pantalla
{
  public function menuPrincipalSistemaShow()
  {
    // Validar si el usuario está autenticado
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
      header("Location: ../index.php");
      exit();
    }

    $this->cabeceraShow("Menú Principal del Sistema");

    $rol = $_SESSION['rol'];
    $login = $_SESSION['login'];
?>
    <!-- Contenedor principal -->
    <div style="display: flex; height: 100vh;">
      <!-- Menú lateral -->
      <aside style="width: 200px; background-color: #00695c; color: white; padding: 10px;">
        <h3 style="text-align: center; border-bottom: 2px solid white; padding-bottom: 10px;">Menú</h3>
        <nav>
          <ul style="list-style: none; padding: 0;">
            <?php
            // Menú para "cajero"
            if ($rol == "cajero") {
            ?>
              <li><a href="/moduloSeguridad/indexPanelPrincipal.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Menú</a></li>
              <li><a href="../moduloVentas/emitirBoleta.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Emitir Factura</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Emitir Boleta</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Emitir Nota Credito</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Compras</a></li>


            <?php
            }
            // Menú para "vendedor"
            elseif ($rol == "vendedor") {
            ?>
              <li><a href="/moduloSeguridad/indexPanelPrincipal.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Menú</a></li>
              <li><a href="../moduloVentas/indexCotizacion.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Cotizacion</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Productos</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Proeevedores</a></li>

            <?php

            }
            // Menú para "Jefe de Ventas"
            elseif ($rol === "jefeVentas") { // Verificar igualdad estricta
            ?>
              <li><a href="/moduloSeguridad/indexPanelPrincipal.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Menu</a></li>
              <li><a href="../moduloVentas/indexCotizacion.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Cotizacion</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Emitir Factura</a></li>
              <li><a href="../moduloVentas/emitirBoleta.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Emitir Boleta</a></li>
              <li><a href="../moduloVentas/confirmarProductos.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Emitir Nota de Credito</a></li>
              <li>
                <form method="post" action="../moduloVentas/getProducto.php" style="margin: 0;">
                  <input type="submit" name="btnProductos" value="Productos" style="color: white; text-decoration: none; display: block; padding: 8px; background-color: #00695c; border: none; cursor: pointer; font-size: 1em;">
                </form>
              </li>
              <li><a href="../moduloVentas/emitirBoleta.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Proveedores</a></li>
              <li><a href="../moduloVentas/indexReporteventas.php " style="color: white; text-decoration: none; display: block; padding: 8px;">Reporte Ventas</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Compras</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Usuarios</a></li>
            <?php
            }

            // Menú si el rol no es reconocido
            else {
            ?>
              <li>
                <p style="color: yellow; text-align: center;">Rol no identificado</p>
              </li>
            <?php
            }
            ?>
            <li><a href='/moduloSeguridad/cerrarSesion.php' style="color: red; text-decoration: none; display: block; padding: 8px;">Cerrar Sesión</a></li>
          </ul>
        </nav>
      </aside>

      <!-- Contenido principal -->
      <main style="flex: 1; padding: 20px; text-align: center;">
        <h1>Rol: <?= $rol ?></h1>
        <h1 style="color: #00695c;">Bienvenido, <?php echo htmlspecialchars($login); ?></h1>
        <img src="../moduloSeguridad/logo.png" alt="Logo" style="width: 600px; margin-top: 20px;">
      </main>
    </div>
<?php
    $this->pieShow();
  }
}
?>