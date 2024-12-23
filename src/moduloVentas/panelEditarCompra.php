<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class panelEditarCompra extends pantalla
{
  public function panelEditarCompraShow($compra, $proveedores)
  {
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
      header("Location: /");
      exit();
    }

    $this->cabeceraShow("Compra");

    $rol = $_SESSION['rol'];
    $login = $_SESSION['login'];
?>
    <!-- contenedor principal -->
    <div style="display: flex; height: 100vh;">
      <!-- menú lateral -->
      <?php
      $this->menuShow($rol);
      ?>

      <!-- contenido principal -->
      <main style="padding: 0 2rem;">
        <h2>Editar Compra</h2>
        <form action="/moduloVentas/getGestionarCompras.php" method="POST">
          <input type="hidden" name="txtIdCompra" value="<?= $compra['ComprobanteRecibidoID']; ?>" />
          <div style="display: flex; flex-direction: column; gap: 10px; max-width: 400px;">
            <!-- Proveedor -->
            <label for="proveedor">Proveedor:</label>
            <select name="proveedor" id="proveedor" required>
              <?php foreach ($proveedores as $proveedor): ?>
                <option value="<?= $proveedor['ProveedorID']; ?>" <?= $proveedor['ProveedorID'] == $compra['ProveedorID'] ? 'selected' : ''; ?>>
                  <?= $proveedor['RazonSocial']; ?>
                </option>
              <?php endforeach; ?>
            </select>

            <!-- RUC/DNI -->
            <label for="ruc">RUC/DNI:</label>
            <input type="text" name="ruc" id="ruc" value="<?= $compra['NumeroRUC']; ?>" required />

            <!-- Tipo -->
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
              <option value="Factura" <?= $compra['TipoComprobanteRecibido'] === 'Factura' ? 'selected' : ''; ?>>Factura</option>
              <option value="Boleta" <?= $compra['TipoComprobanteRecibido'] === 'Boleta' ? 'selected' : ''; ?>>Boleta</option>
            </select>

            <!-- Fecha -->
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?= $compra['FechaEmision']; ?>" required />

            <!-- Concepto -->
            <label for="concepto">Concepto:</label>
            <input type="text" name="concepto" id="concepto" value="<?= $compra['Observaciones']; ?>" required />

            <!-- Monto -->
            <label for="monto">Monto:</label>
            <input type="number" name="monto" id="monto" value="<?= $compra['ImporteTotal']; ?>" step="0.01" required />

            <!-- Botones -->
            <div style="display: flex; gap: 20px;">
              <a style="padding: 10px 20px; background-color: red; color: white;" href="/moduloVentas/indexGestionarCompras.php">Cancelar</a>
              <button name="btnGuardar" type="submit" style="padding: 10px 20px; background-color: green; color: white;">Guardar</button>
            </div>
          </div>
        </form>
      </main>
    </div>
<?php
    $this->pieshow();
  }
}
?>