<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php'); // Clase base vista

class panelProveedores extends pantalla
{
    public function panelProveedoresShow($proveedores = null)
    {
        $this->cabeceraShow("Gestión de Proveedores"); // Cabecera
?>
        <!-- Botón regresar al panel principal -->
        <a class="regresar-boton" href="/moduloSeguridad/indexPanelPrincipal.php">Regresar al panel principal</a>
        <tr>
            <a href="/moduloVentas/indexEditarProveedores.php>">Agregar</a>
        </tr>

        <!-- Contenedor principal -->
        <div class="container">
            <h1 style="margin-bottom: 20px;">Gestión de Proveedores</h1>

            <!-- Tabla de proveedores -->
            <div class="scrollable">
                <table id="proveedoresTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número RUC</th>
                            <th>Razón Social</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th>Fecha Registro</th>
                            <th>Acción</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php if ($proveedores !== null) : ?>
                            <?php foreach ($proveedores as $proveedor) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($proveedor['ProveedorID']) ?></td>
                                    <td><?= htmlspecialchars($proveedor['NumeroRUC']) ?></td>
                                    <td><?= htmlspecialchars($proveedor['RazonSocial']) ?></td>
                                    <td><?= htmlspecialchars($proveedor['Telefono']) ?></td>
                                    <td><?= htmlspecialchars($proveedor['Email']) ?></td>
                                    <td><?= htmlspecialchars($proveedor['Direccion']) ?></td>
                                    <td><?= htmlspecialchars($proveedor['FechaRegistro']) ?></td>
                                    <td>
                                        <a href="indexEditarProveedores.php?id=<?= htmlspecialchars($proveedor['ProveedorID']) ?>
                                            &numeroRUC=<?= htmlspecialchars($proveedor['NumeroRUC']) ?>
                                            &razonSocial=<?= urlencode($proveedor['RazonSocial']) ?>
                                            &telefono=<?= htmlspecialchars($proveedor['Telefono']) ?>
                                            &email=<?= htmlspecialchars($proveedor['Email']) ?>
                                            &direccion=<?= urlencode($proveedor['Direccion']) ?>">Editar</a>
                                        <a href="/moduloVentas/getProveedor.php?accion=eliminar&id=<?= htmlspecialchars($proveedor['ProveedorID']) ?>">Eliminar</a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">No se encontraron proveedores.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
<?php
        $this->pieShow(); // Pie de página
    }
}
?>