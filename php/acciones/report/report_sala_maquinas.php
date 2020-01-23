<?php
    session_start();
    require_once("../../conexion.php");
    require_once '../../../vendor/autoload.php'; 
    use Dompdf\Dompdf; 

    ob_start();
    include '../../../diseños/sala_maquinas/reporte_sala_maquinas.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);   
    $dompdf->setPaper('A4', 'landscape'); 
    $dompdf->render();
    $dompdf->stream("sala_maquinas.pdf", array("Attachment" => 0));
?>