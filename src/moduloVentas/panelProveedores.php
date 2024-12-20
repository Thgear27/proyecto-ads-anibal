<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php'); // Clase base vista

class panelProveedores extends pantalla
{
    public function panelProveedoresShow($proveedores = null)
    {
        $this->cabeceraShow("Gestión de Proveedores"); // Cabecera

?>
        <style>
            /* General */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f9fa;
            }

            h1 {
                text-align: center;
                color: #333;
                font-size: 28px;
                margin-bottom: 20px;
            }

            /* Contenedor */
            .container {
                width: 90%;
                margin: 20px auto;
                background-color: #fff;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            }

            /* Botones */
            .regresar-boton {
                display: inline-block;
                background-color: #007bff;
                color: white;
                padding: 8px 12px;
                border-radius: 5px;
                text-decoration: none;
                margin-bottom: 15px;
            }

            .regresar-boton:hover {
                background-color: #0056b3;
            }

            a[href*="Agregar"] {
                display: inline-block;
                background-color: #28a745;
                color: white;
                padding: 8px 12px;
                border-radius: 5px;
                text-decoration: none;
                font-weight: bold;
                margin: 10px 0;
            }

            a[href*="Agregar"]:hover {
                background-color: #218838;
            }

            /* Tabla */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #fff;
            }

            th {
                background-color: rgb(44, 129, 64);
                color: white;
                padding: 10px;
                text-align: center;
                font-size: 14px;
            }

            td {
                padding: 8px;
                border: 1px solid #ddd;
                text-align: center;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            tr:nth-child(odd) {
                background-color: #eaffea;
            }

            a {
                text-decoration: none;
                font-weight: bold;
                padding: 5px;
                border-radius: 5px;
            }

            /* Estilos para Editar y Eliminar */
            a[href*="Editar"] {
                color: white;
                background-color: #17a2b8;
                padding: 5px 10px;
                margin-right: 5px;
            }

            a[href*="Editar"]:hover {
                background-color: #138496;
            }

            a[href*="eliminar"] {
                color: white;
                background-color: #dc3545;
                padding: 5px 10px;
            }

            a[href*="eliminar"]:hover {
                background-color: #c82333;
            }
        </style>

        <!-- Botón regresar al panel principal -->
        <a class="regresar-boton" href="/moduloSeguridad/indexPanelPrincipal.php">Regresar al panel principal</a>
        <tr>
            <a href="./indexAgregarProveedor.php">Agregar</a>
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
                                    <td>
                                        <form action="/moduloVentas/getProveedor.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="accion" value="eliminar">
                                            <input type="hidden" name="idProveedor" value="<?= htmlspecialchars($proveedor['ProveedorID']) ?>">
                                            <button type="submit" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                                🗑 Eliminar
                                            </button>
                                        </form>
                                        <a href="indexEditarProveedores.php?id=<?= htmlspecialchars($proveedor['ProveedorID']) ?>&numeroRUC=<?= htmlspecialchars($proveedor['NumeroRUC']) ?>&razonSocial=<?= urlencode($proveedor['RazonSocial']) ?>&telefono=<?= htmlspecialchars($proveedor['Telefono']) ?>&email=<?= htmlspecialchars($proveedor['Email']) ?>&direccion=<?= urlencode($proveedor['Direccion']) ?>">Editar</a>
                                    </td>
                                    </td>
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