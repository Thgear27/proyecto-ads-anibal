<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/pantalla.php');

class panelReporteCompras extends pantalla
{
    public function panelReporteComprasShow($compras = null)
    {
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != "SI") {
            header("Location: /");
            exit();
        }

        $this->cabeceraShow("Reporte de compras");

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
            <main style="padding: 0 2rem;">
                <h1 style="color: #00695c;">Reporte de compras</h1>

                <form method="post" action="../moduloVentas/reporteCompras/getCompras.php">
                    <h3>Filtrar por fecha</h3>
                    <div class="fechas-filtro">
                        <div class="form-group">
                            <label for="fechadesde">Desde:</label>
                            <input type="date" id="fechadesde" name="txtFechaDesde">
                        </div>
                        <div class="form-group">
                            <label for="fechahasta">Hasta:</label>
                            <input type="date" id="fechahasta" name="txtFechaHasta">
                        </div>
                    </div>
                    <div class="btn-group">
                        <input type="submit" name="btnBuscar" value="Buscar">
                        <input type="submit" name="btnImprimir" value="Imprimir">
                    </div>
                </form>

                <div class="table-cotizaciones">
                    <table id="compras-table">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>RUC</th>
                                <th>Tipo</th>
                                <th>Fecha Emisión</th>
                                <th>Fecha Vencimiento</th>
                                <th>Concepto</th>
                                <th>Monto</th>
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
                                        <td><?= $compra['FechaVencimiento']; ?></td>
                                        <td><?= $compra['Observaciones']; ?></td>
                                        <td><?= $compra['ImporteTotal']; ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else : ?>
                                <tr>
                                    <td colspan="7">No se encontraron compras.</td>
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