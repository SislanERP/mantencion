<?php
    session_start();
    include ('../../conexion.php');
    require_once '../../../vendor/autoload.php'; 
    use Dompdf\Dompdf; 

    ob_start();
    include '../../../VistaReporte.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);   
    $dompdf->setPaper('legal', 'portrait'); 
    $dompdf->render();
    $dompdf->stream('FicheroEjemplo.pdf', array("Attachment" => 0));
?>