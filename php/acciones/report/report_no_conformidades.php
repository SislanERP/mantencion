<?php
    session_start();
    require_once("../../conexion.php");
    require_once '../../../vendor/autoload.php'; 
    use Dompdf\Dompdf; 

    ob_start();
    include '../../../diseños/no_conformidades/reporte_no_conformidades.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->set_option("isPhpEnabled", true);
       
    $dompdf->setPaper('A4', 'portrait'); 
    $dompdf->render();
    $dompdf->stream("no_conformidades.pdf", array("Attachment" => 0));
?>