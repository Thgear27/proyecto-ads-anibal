<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class panelGestionarProductos extends pantalla
{
    public function panelGestionarProductosShow($productos = null)
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
                        <li><a href="../moduloSeguridad/cerrarSesion.php" style="color: red; text-decoration: none; display: block; padding: 8px;">Cerrar Sesión</a></li>
                    </ul>
                </nav>
            </aside>

            <!-- Contenido principal -->
            <main style="padding: 0 2rem;">
                <h1 style="color: #00695c;">Gestión de productos</h1>

                <form method="post" action="../moduloVentas/getProducto.php">
                    <button type="submit" name="btnAgregarProducto" class="btn agregar"><i class="fa-solid fa-plus" style="color: #FFF;"></i>Agregar producto</button>
                </form>

                <div class="table-cotizaciones">
                    <table id="productos-table">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nombre</th>
                                <th>Medida</th>
                                <th>Venta</th>
                                <th>Compra</th>
                                <th>Proveedor</th>
                                <th colspan="2" class="centered-colspan">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($productos !== null) : ?>

                                <?php foreach ($productos as $producto) : ?>
                                    <tr>
                                        <td><?= $producto['ProductoID']; ?></td>
                                        <td><?= $producto['Descripcion']; ?></td>
                                        <td><?= $producto['UnidadMedida']; ?></td>
                                        <td><?= $producto['ValorUnitarioVenta']; ?></td>
                                        <td><?= $producto['ValorUnitarioCompra']; ?></td>
                                        <td><?= $producto['RazonSocial']; ?></td>
                                        <form method="post" action="../moduloVentas/getProducto.php">
                                            <input type="hidden" name="idProducto" value="<?= $producto['ProductoID']; ?>">
                                            <td>
                                                <button type="submit" name="btnEditarProducto" class="btn editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>Editar
                                                </button>
                                            </td>
                                            <td>
                                                <button type="submit" name="btnEliminarProducto" class="btn eliminar">
                                                    <i class="fa-solid fa-trash"></i>Eliminar
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No se encontraron productos.</td>
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