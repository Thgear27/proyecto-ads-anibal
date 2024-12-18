<?php
include_once(__DIR__ . "/../shared/pantalla.php");

class formEditarProveedor extends pantalla
{
    public function formEditarProveedorShow($id, $numeroRUC, $razonSocial, $telefono, $email, $direccion)
    {
        $this->cabeceraShow('Editar Proveedor'); // Título de la página
?>
        <!-- Botón regresar al panel principal -->
        <a class="regresar-boton" href="/moduloSeguridad/indexPanelPrincipal.php">Regresar al panel principal</a>

        <h1 style="margin-bottom: 20px;">Editar Proveedor: <?= htmlspecialchars($razonSocial) ?></h1>

        <!-- Formulario de edición -->
        <form action="/moduloVentas/getProveedor.php" method="POST">
            <input type="hidden" name="idProveedor" value="<?= htmlspecialchars($id) ?>">

            <div>
                <label for="numeroRUC">Número RUC:</label>
                <input type="text" id="numeroRUC" name="numeroRUC" value="<?= htmlspecialchars($numeroRUC) ?>" required>
            </div>
            <div>
                <label for="razonSocial">Razón Social:</label>
                <input type="text" id="razonSocial" name="razonSocial" value="<?= htmlspecialchars($razonSocial) ?>" required>
            </div>
            <div>
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($telefono) ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($direccion) ?>" required>
            </div>

            <input type="submit" value="Editar Proveedor" name="btnEditarProveedor">
        </form>
<?php
        $this->pieShow(); // Pie de página
    }
}
?>
