<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class panelEmitirCotizacion extends pantalla
{
  public function panelEmitirCotizacionShow($productos = null)
  {
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
      header("Location: /");
      exit();
    }

    $this->cabeceraShow("Cotazación", "/assets/emitirCotizacion.js");

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
            <li><a href="/moduloSeguridad/cerrarSesion.php" style="color: red; text-decoration: none; display: block; padding: 8px;">Cerrar Sesión</a></li>
          </ul>
        </nav>
      </aside>

      <!-- Contenido principal -->
      <main style="padding: 4rem 2rem;">
        <h1>Emisión de Cotización</h1>
        <h2>Información del comprador:</h2>
        <form action="/moduloVentas/getEmitirCotizacion.php" method="POST" class="emitir-cotizacion" id="emitir-cotizacion-form">
          <div class="input-container">
            <label>Nro de RUC / DNI:</label>
            <input type="text" id="nrRucDni" name="txtNrRucDni" required>
          </div>

          <div class="input-container">
            <label>Razón Social:</label>
            <input type="text" id="razonSocial" name="txtRazonSocial" required>
          </div>

          <div class="input-container">
            <label>Dirección: </label>
            <input type="text" id="direccion" name="txtDireccion" required>
          </div>

          <div class="input-container">
            <label>Obra: </label>
            <input type="text" id="obra" name="txtObra" required>
          </div>

          <div class="input-container">
            <span>Moneda:</span>
            <label>
              <input type="radio" name="txtMoneda" value="PEN" checked>
              Soles (PEN)
            </label>
            <label>
              <input type="radio" name="txtMoneda" value="USD">
              Dólares (USD)
            </label>
          </div>
          <input type="hidden" name="productsArray" id="productsArrayInput">
          <input type="hidden" name="btnSiguiente" value="Siguiente">
        </form>
        <h2>Información de los productos:</h2>
        <div class="table-cotizaciones">
          <table id="cotaizaciones-table">
            <thead>
              <tr>
                <th>Nro</th>
                <th>Producto</th>
                <th>Und</th>
                <th>Venta</th>
                <th>Compra</th>
                <th>Cantidad</th>
                <th>-</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($productos !== null) : ?>

                <?php foreach ($productos as $producto) : ?>
                  <tr>
                    <td><?= $producto['ID']; ?></td>
                    <td><?= $producto['NombreProducto']; ?></td>
                    <td><?= $producto['Unidad']; ?></td>
                    <td><?= $producto['PrecioVenta']; ?></td>
                    <td><?= $producto['PrecioCompra']; ?></td>
                    <td>
                      <input type="number" data-product-amount data-product-id="<?= $producto['ID']; ?>" data-product-name="<?= $producto['NombreProducto']; ?>" data-product-price="<?= $producto['PrecioVenta']; ?>" class="add-product" />
                    </td>
                    <td>
                      <input type="checkbox" data-product-checkbox data-product-id="<?= $producto['ID']; ?>" data-product-name="<?= $producto['NombreProducto']; ?>" data-product-price="<?= $producto['PrecioVenta']; ?>" class="add-product" />
                    </td>
                  </tr>
                <?php endforeach; ?>

              <?php else : ?>
                <tr>
                  <td colspan="6">No se encontraron solicitudes.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <button style="width: 100%; font-size: 1.2rem; margin-top: 1rem;" class="btn" id="btnSiguiente">Siguiente</button>
      </main>
    </div>
<?php
    $this->pieShow();
  }
}
?>