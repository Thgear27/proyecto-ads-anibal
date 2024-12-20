<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class formEditarUsuario extends pantalla
{
    public function formEditarUsuarioShow($usuarioid,$nombreusuario,$contrasena,$nombres,$apellidos,$telefono,$email,$dni,$respuestasecreta,$rolid)
  {
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
      header("Location: /");
      exit();
    }

    $this->cabeceraShow("Usuario", "/assets/emitirCotizacion.js");

    $rol = $_SESSION['rol'];
    $login = $_SESSION['login'];
?>
    <!-- Contenedor principal -->
    <div style="display: flex;">
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
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Productos</a></li>
              <li><a href="../moduloVentas/emitirBoleta.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Proveedores</a></li>
              <li><a href="../moduloVentas/confirmarProductos.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Reporte</a></li>
              <li><a href="../moduloSeguridad/indexCambiarContrasena.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Compras</a></li>
              <li><a href="../moduloSeguridad/indexGestionarUsuarios.php" style="color: white; text-decoration: none; display: block; padding: 8px;">Usuarios</a></li>
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
            <li><a href="../moduloSeguridad/cerrarSesion.php" style="color: red; text-decoration: none; display: block; padding: 8px;">Cerrar Sesión</a></li>
          </ul>
        </nav>
      </aside>
      <main style="padding: 4rem 2rem;">
          <h1>Edición de usuario: <?= htmlspecialchars($nombreusuario) ?></h1>
          <h2>Datos a modificar:</h2>
          <form action="/moduloSeguridad/getGestionarUsuario.php" method="POST" class="emitir-cotizacion" id="emitir-cotizacion-form">
          <input type="hidden" name="accion" value="editar">
          <input type="text" name="usuarioid" minlength="4" maxlength="60" value="<?= $usuarioid ?>" hidden>
              <div class="input-container">
                  <label>Nombre de usuario: </label>
                  <input type="text" id="nrRucDni" value="<?= htmlspecialchars($nombreusuario) ?>" name="nombreusuario" required>
              </div>

              <div class="input-container">
                  <label>Contraseña: </label>
                  <input type="text" id="razonSocial" value="<?= htmlspecialchars($contrasena) ?>" name="contrasena" required>
              </div>

              <div class="input-container">
                  <label>Nombres: </label>
                  <input type="text" id="direccion" value="<?= htmlspecialchars($nombres) ?>" name="nombres" required>
              </div>

              <div class="input-container">
                  <label>Apellidos: </label>
                  <input type="text" id="obra" value="<?= htmlspecialchars($apellidos) ?>" name="apellidos" required>
              </div>

              <div class="input-container">
                  <label>Teléfono: </label>
                  <input type="text" id="obra" value="<?= htmlspecialchars($telefono) ?>" name="telefono" required>
              </div>

              <div class="input-container">
                  <label>Correo: </label>
                  <input type="text" id="obra" value="<?= htmlspecialchars($email) ?>" name="email" required>
              </div>

              <div class="input-container">
                  <label>DNI: </label>
                  <input type="text" id="obra" value="<?= htmlspecialchars($dni) ?>" name="dni" required>
              </div>

              <div class="input-container">
                  <label>Respuesta secreta: </label>
                  <input type="text" id="obra" value="<?= htmlspecialchars($respuestasecreta) ?>" name="respuestasecreta" required>
              </div>

              <div class="input-container">
                  <label>Rol: </label>
                  <div>
                      <!-- Radio Button: Jefe de Ventas -->
                      <label>
                          <input type="radio" name="rolid" value="1" 
                              <?= ($rolid == 1) ? 'checked' : ''; ?>> Jefe de Ventas
                      </label>

                      <!-- Radio Button: Vendedor -->
                      <label>
                          <input type="radio" name="rolid" value="2" 
                              <?= ($rolid == 2) ? 'checked' : ''; ?>> Vendedor
                      </label>

                      <!-- Radio Button: Cajero -->
                      <label>
                          <input type="radio" name="rolid" value="3" 
                              <?= ($rolid == 3) ? 'checked' : ''; ?>> Cajero
                      </label>
                  </div>
              </div>

              <!-- Botón de envío -->
              <button type="submit" name="btnEditarUsuario" style="width: 100%; font-size: 1.2rem; margin-top: 1rem;" class="btn">Actualizar datos</button>
          </form>
      </main>

    </div>
<?php
    $this->pieShow();
  }
}