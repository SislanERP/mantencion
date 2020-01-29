<?php
    session_start();
    require_once("../../conexion.php");
    require_once '../../../vendor/autoload.php'; 
    use Dompdf\Dompdf; 

    ob_start();
    include '../../../diseños/equipos/reporte_equipos.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);  
    $dompdf->set_option("isPhpEnabled", true);

    
if ( isset($pdf) ) { 
    $pdf->page_script('
        if ($PAGE_COUNT > 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 12;
            $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
            $y = 15;
            $x = 520;
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}
    $dompdf->setPaper('legal', 'portrait'); 
    $dompdf->render();
    $dompdf->stream("equipos.pdf", array("Attachment" => 0));
?>