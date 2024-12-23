<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class panelGestionarCompras extends pantalla
{
  public function panelGestionarComprasShow($compras = null)
  {
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
      header("Location: /");
      exit();
    }


    $this->cabeceraShow("Gestionar Compras");

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
        <h1 style="color: #00695c;">Gestionar Documentos Compras</h1>
        <div class="filters-container">
          <a href="/moduloventas/indexAgregarCompra.php" class="btn" style="margin-bottom: 1rem;">Agregar Compra</a>
        </div>
        <div class="table-cotizaciones">
          <table id="cotaizaciones-table">
            <thead>
              <tr>
                <th>Proveedor</th>
                <th>RUC</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Monto</th>
                <th>E</th>
                <th>B</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($compras !== null) : ?>

                <?php foreach ($compras as $compra) : ?>
                  <tr>
                    <td><?= $compra['Proveedor']; ?></td>
                    <td><?= $compra['NumeroRUC']; ?></td>
                    <td><?= $compra['TipoComprobanteRecibido']; ?></td>
                    <td><?= $compra['FechaEmision']; ?></td>
                    <td><?= $compra['Observaciones']; ?></td>
                    <td><?= $compra['ImporteTotal']; ?></td>
                    <td>
                      <form action="/moduloVentas/getGestionarCompras.php" method="post">
                        <input type="hidden" name="txtIdCompra" value="<?= $compra['ComprobanteRecibidoID']; ?>">
                        <input type="submit" name="btnEditarCompra" value="editar">
                      </form>
                    </td>
                    <td>
                      <form action="/moduloVentas/getGestionarCompras.php" method="post">
                        <input type="hidden" name="txtIdCompra" value="<?= $compra['ComprobanteRecibidoID']; ?>">
                        <input type="submit" name="btnEliminarCompra" value="borrar">
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>

              <?php else : ?>
                <tr>
                  <td colspan="8">no se encontraron solicitudes.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

      </main>
    </div>
<?php
    $this->pieShow();
  }
}
?>