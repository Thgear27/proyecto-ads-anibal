<?php
include_once("../modelo/conexion.php");
include_once("../modelo/EreporteVentas.php");
include_once("../shared/screenMensajeSistema.php");
require_once("../vendor/autoload.php"); // Incluir TCPDF

class controlReporteVentas
{
    public function generarReporte($desde, $hasta)
    {
        if (empty($desde) || empty($hasta)) {
            $this->mostrarError("Campos incompletos", "Debe completar las fechas 'Desde' y 'Hasta'.", "indexReporteventas.php");
            exit(); // Detiene la ejecución
        }

        $modelo = new EreporteVentas();
        $datosReporte = $modelo->obtenerReportePorFechas($desde, $hasta);

        if (empty($datosReporte)) {
            $this->mostrarError("Sin resultados", "No se encontraron reportes en el rango de fechas seleccionado.", "indexReporteventas.php");
            exit(); // Detiene la ejecución
        }

        return $datosReporte;
    }

    public function generarPDF($desde, $hasta)
    {
        $modelo = new EreporteVentas();
        $datosReporte = $modelo->obtenerReportePorFechas($desde, $hasta);

        if (empty($datosReporte)) {
            $this->mostrarError("Sin resultados", "No se encontraron reportes en el rango de fechas seleccionado.", "indexReporteventas.php");
            return;
        }

        // Calcular totales
        $totalImporte = 0;
        $totalCosto = 0;
        $totalGanancia = 0;

        foreach ($datosReporte as $reporte) {
            $totalImporte += $reporte['ImporteTotal'];
            $totalCosto += $reporte['CostoTotal'];
            $totalGanancia += $reporte['Ganancia'];
        }

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Reporte de Ventas');
        $pdf->AddPage();

        $html = '<h1>Reporte de Ventas</h1>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5">
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
                    </tr>';
        foreach ($datosReporte as $reporte) {
            $html .= "<tr>
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
        $html .= '</table>';

        // Agregar resumen al final
        $html .= '<h3>Resumen</h3>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5">
                    <tr>
                        <th>Importe Total</th>
                        <th>Costo Total</th>
                        <th>Ganancia</th>
                    </tr>
                    <tr>
                        <td>' . number_format($totalImporte, 2) . '</td>
                        <td>' . number_format($totalCosto, 2) . '</td>
                        <td>' . number_format($totalGanancia, 2) . '</td>
                    </tr>
                  </table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output("Reporte_Ventas_{$desde}_{$hasta}.pdf", 'I');

        // Solución al problema de reenvío del formulario
        // Después de generar el PDF, redirigir al usuario
        header("Location: indexReporteventas.php");
        exit();
    }

    public function mostrarError($titulo, $mensaje, $link)
    {
        $objMensaje = new screenMensajeSistema();
        $objMensaje->screenMensajeSistemaShow($titulo, $mensaje, "<a href='$link'>Volver al reporte</a>");
    }
}

