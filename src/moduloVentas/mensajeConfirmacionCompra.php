<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class mensajeConfirmacionCompra extends pantalla
{
  public function mensajeConfirmacionCompraShow($idCompra)
  {
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
      header("Location: /");
      exit();
    }

    $this->cabeceraShow("Gestionar Compras");

    $rol = $_SESSION['rol'];
    $login = $_SESSION['login'];
?>

    <!-- Contenedor principal -->
    <div style="display: flex; height: 100vh;">
      <!-- Menú lateral -->
      <?php
      $this->menuShow($rol);
      ?>

      <!-- Contenido principal -->
      <main style="display: flex; justify-content: center; align-items: center; flex: 1;">
        <form method="post" action="/moduloVentas/getGestionarCompras.php">
          <div id="confirmationModal" class="modal">
            <div class="modal-content">
              <input type="hidden" name="idCompra" value="<?php echo $idCompra; ?>">
              <h3>Mensaje de confirmación</h3>
              <div class="warning-icon">⚠️</div>
              <h3>¿Estás seguro de borrar esta compra?</h3>
              <div class="buttons">
                <a href="indexGestionarCompras.php" class="btnMensaje btn-no">No</a>
                <button type="submit" name="btnConfirmarEliminar" class="btnMensaje btn-yes">Sí</button>
              </div>
            </div>
          </div>
        </form>
      </main>
    </div>
<?php
    $this->pieShow();
  }
}
?>