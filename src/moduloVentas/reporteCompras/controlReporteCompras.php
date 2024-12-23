<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/shared/screenMensajeSistema.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/compras.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class controlReporteCompras
{
    public function generarPdf($fechadesde, $fechahasta, $compras)
    {
        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF();

        // Establecer propiedades del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Reporte de Compras');
        $pdf->SetSubject('Detalle de Compras');

        // Establecer márgenes
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Establecer auto página break
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Establecer factor de escala de imagen
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Añadir una página
        $pdf->AddPage();

        // Establecer contenido HTML
        $html = '<h1 style="text-align: center;">REPORTE DE COMPRAS</h1>';

        if ($fechadesde != null && $fechahasta != null) {
            $html .= '<p><strong>DE:</strong> ' . $fechadesde . '</p>';
            $html .= '<p><strong>HASTA:</strong> ' . $fechahasta . '</p>';
        } else if ($fechadesde != null) {
            $html .= '<p><strong>DESDE:</strong> ' . $fechadesde . '</p>';
        }

        // Tabla con estilo HTML
        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #008000; color: #ffffff;">
                        <th style="text-align: center;">PROVEEDOR</th>
                        <th style="text-align: center;">RUC</th>
                        <th style="text-align: center;">TIPO</th>
                        <th style="text-align: center;">FECHA</th>
                        <th style="text-align: center;">CONCEPTO</th>
                        <th style="text-align: center;">MONTO</th>
                    </tr>
                </thead>
                <tbody>';

        $totalMonto = 0; // Para calcular el monto total

        foreach ($compras as $compra) {
            $html .= '<tr>
                    <td>' . $compra['Proveedor'] . '</td>
                    <td>' . $compra['NumeroRUC'] . '</td>
                    <td>' . $compra['TipoComprobanteRecibido'] . '</td>
                    <td>' . $compra['FechaEmision'] . '</td>
                    <td>' . $compra['Observaciones'] . '</td>
                    <td style="text-align: right;">' . number_format($compra['ImporteTotal'], 2) . '</td>
                  </tr>';
            $totalMonto += $compra['ImporteTotal'];
        }

        $html .= '</tbody>
            </table>';

        // Monto total
        $html .= '<p style="text-align: right; font-weight: bold;">MONTO TOTAL: ' . number_format($totalMonto, 2) . '</p>';

        // Imprimir el contenido HTML
        $pdf->writeHTML($html, true, false, true, false, '');

        // Salida del archivo
        $pdf->Output('reporte_compras.pdf', 'I');
    }
}
