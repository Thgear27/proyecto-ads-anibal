<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class panelEmitirFactura extends pantalla
{
  public function panelEmitirFacturaShow($productos = null)
  {
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
      header("Location: /");
      exit();
    }

    $this->cabeceraShow("Emitir Factura", "/assets/emitirFactura.js");

    $rol = $_SESSION['rol'];
    $login = $_SESSION['login'];
?>
    <!-- Contenedor principal -->
    <div style="display: flex;">
      <!-- Menú lateral -->
      <?php
      $this->menuShow($rol);
      ?>

      <!-- Contenido principal -->
      <main style="padding: 4rem 2rem;">
        <h1>Emisión de Factura</h1>
        <h2>Información del comprador:</h2>
        <form action="/moduloVentas/getEmitirFactura.php" method="POST" class="emitir-cotizacion" id="emitir-factura-form">
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
          <table id="facturas-table">
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
                  <td colspan="6">No se encontraron productos disponibles.</td>
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