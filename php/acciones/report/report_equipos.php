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
    $dompdf->setPaper('A4', 'portrait'); 
    $dompdf->render();
    $dompdf->stream("equipos.pdf", array("Attachment" => 0));
?>