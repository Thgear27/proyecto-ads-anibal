<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class panelEditarProducto extends pantalla
{
    public function panelEditarProductoShow($datosProducto, $proveedores)
    {
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
            header("Location: /");
            exit();
        }

        $this->cabeceraShow("Gestionar Productos");

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
            <main style="display: flex; justify-content: center; align-items: center; flex: 1;">
                <div class="form-container">
                    <h2>Editar producto</h2>
                    <form method="post" action="getProducto.php">
                        <!-- Campo Nombre -->
                        <div class="form-input">
                            <label for="codigo">Código:</label>
                            <input type="text" name="codigo" id="codigo" value="<?php echo $datosProducto['CodigoProducto'] ?>" placeholder="Ingrese el código">
                        </div>

                        <div class="form-input">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" placeholder="Ingrese la descripción"><?php echo $datosProducto['Descripcion'] ?></textarea>
                        </div>

                        <!-- Campo Medida -->
                        <div class="form-input">
                            <label for="medida">Medida:</label>
                            <select name="medida" id="medida">
                                <option value="">Seleccione una medida</option>
                                <?php
                                $medidas = ["Unidad", "Bolsa", "Metro"];
                                foreach ($medidas as $medida) {
                                    $selected = $datosProducto['UnidadMedida'] == $medida ? "selected" : "";
                                ?>
                                <option value="<?php echo $medida ?>" <?php echo $selected ?>><?php echo $medida ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Precio de Venta -->
                        <div class="form-input">
                            <label for="precioVenta">Precio de venta:</label>
                            <input type="number" name="precioVenta" id="precioVenta" value="<?php echo $datosProducto['ValorUnitarioVenta'] ?>" placeholder="Ingrese el precio de venta" step="0.01" min="0">
                        </div>

                        <!-- Precio de Costo -->
                        <div class="form-input">
                            <label for="precioCompra">Precio de compra:</label>
                            <input type="number" name="precioCompra" id="precioCompra" value="<?php echo $datosProducto['ValorUnitarioCompra'] ?>" placeholder="Ingrese el precio de compra" step="0.01" min="0">
                        </div>

                        <!-- Proveedores -->
                        <div class="form-input">
                            <label for="proveedor">Proveedores:</label>
                            <select name="proveedor" id="proveedor">
                                <option value="">Seleccione un proveedor</option>
                                <?php foreach ($proveedores as $proveedor){
                                    $idProveedor = $proveedor['ProveedorID'];
                                    $razonSocial = $proveedor['RazonSocial'];
                                    $selected = $datosProducto['ProveedorID'] == $idProveedor ? "selected" : "";
                                ?>
                                <option value="<?php echo $idProveedor ?>" <?php echo $selected ?>><?php echo $razonSocial ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="form-buttons">
                            <input type="hidden" name="idProducto" value="<?php echo $datosProducto['ProductoID']; ?>">
                            <a href="indexGestionarProductos.php" class="btn cancelar">Cancelar</a>
                            <button type="submit" name="btnGuardar" class="btn guardar">Guardar</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
<?php
        $this->pieShow();
    }
}
?>