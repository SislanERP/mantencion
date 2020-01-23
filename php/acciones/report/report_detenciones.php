<?php
    session_start();
    require_once("../../conexion.php");
    require_once '../../../vendor/autoload.php'; 
    use Dompdf\Dompdf; 

    ob_start();
    include '../../../diseños/detenciones/reporte_detenciones.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);   
    $dompdf->setPaper('legal', 'landscape'); 
    $dompdf->render();
    $dompdf->stream("detenciones.pdf", array("Attachment" => 0));
?>