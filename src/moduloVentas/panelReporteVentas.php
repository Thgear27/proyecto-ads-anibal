<?php
class panelReporteVentas
{
    public function panelReporteVentasShow($datosReporte)
    {
?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reporte de Ventas</title>
            <style>
                /* General */
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                    color: #333;
                }

                h1 {
                    text-align: center;
                    color: #00695c;
                    margin-top: 20px;
                }

                /* Formulario */
                form {
                    display: flex;
                    justify-content: center;
                    gap: 10px;
                    margin: 20px 0;
                }

                label {
                    font-weight: bold;
                }

                input[type="date"] {
                    padding: 5px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                button {
                    background-color: #00695c;
                    color: white;
                    border: none;
                    padding: 8px 15px;
                    cursor: pointer;
                    border-radius: 5px;
                    font-weight: bold;
                }

                button:hover {
                    background-color: #004d40;
                }

                /* Tabla */
                table {
                    margin: 20px auto;
                    width: 90%;
                    border-collapse: collapse;
                    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
                    background-color: #fff;
                }

                th,
                td {
                    border: 1px solid #ddd;
                    padding: 10px;
                    text-align: center;
                }

                th {
                    background-color: #00695c;
                    color: white;
                }

                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }

                tr:hover {
                    background-color: #e0f2f1;
                }

                /* Botón Salir */
                .btn-salir {
                    display: block;
                    text-align: center;
                    margin: 20px auto;
                    background-color: #d32f2f;
                    color: white;
                    padding: 10px 15px;
                    text-decoration: none;
                    border-radius: 5px;
                    font-weight: bold;
                }

                .btn-salir:hover {
                    background-color: #b71c1c;
                }
            </style>
        </head>

        <body>
            <h1>Reporte de Ventas</h1>

            <form method="POST" action="getReporteVenta.php">
                <label for="desde">Desde:</label>
                <input type="date" name="desde" id="desde" value="<?php echo isset($_POST['desde']) ? $_POST['desde'] : ''; ?>">

                <label for="hasta">Hasta:</label>
                <input type="date" name="hasta" id="hasta" value="<?php echo isset($_POST['hasta']) ? $_POST['hasta'] : ''; ?>">

                <button type="submit" name="btnBuscar">Buscar</button>
                <button type="submit" name="btnGenerarReporte">Generar reporte</button>
            </form>





            <!-- Tabla -->
            <table>
                <tr>
                    <th>Serie y Correlativo</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Obra</th>
                    <th>Orden de Compra</th>
                    <th>Fecha Emisión</th>
                    <th>Importe Total</th>
                    <th>Costo Total</th>
                    <th>Ganancia</th>
                </tr>
                <?php if (!empty($datosReporte)) {
                    foreach ($datosReporte as $reporte) {
                        echo "<tr>
                                <td>{$reporte['NumeroSerieYCorrelativo']}</td>
                                <td>{$reporte['TipoComprobante']}</td>
                                <td>{$reporte['NombreCompletoORazonSocial']}</td>
                                <td>{$reporte['Obra']}</td>
                                <td>{$reporte['OrdenDeCompra']}</td>
                                <td>{$reporte['FechaEmision']}</td>
                                <td>{$reporte['ImporteTotal']}</td>
                                <td>{$reporte['CostoTotal']}</td>
                                <td>{$reporte['Ganancia']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align: center;'>No hay datos disponibles</td></tr>";
                } ?>
            </table>

            <!-- Botón Salir -->
        </body>

        </html>
<?php
    }
}
?>