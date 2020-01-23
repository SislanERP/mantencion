<?php
    session_start();
    include ('../../conexion.php');
    require_once '../../../vendor/autoload.php'; 
    use Dompdf\Dompdf; 
    
    $id_usuario = $_SESSION['id_user'];
    $cotizacion = $_SESSION['n_cotizacion'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT max(id_cotizacion) as correlativo FROM cotizacion";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    if(empty($_POST['vehiculo']))
    {
        $errors []= "Debe seleccionar una patente.";
    }
    else
    {
        $consulta = "SELECT * FROM temporal where id_venta=$cotizacion";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        $totalFilas = mysqli_num_rows($resultado); 
        if($totalFilas == 0)
        {
            $errors []= "Debe ingresar productos en la cotización.";
        }

        else
        {
            $query="INSERT INTO cotizacion(id_cotizacion,id_vehiculo,id_usuario,fecha) VALUES ($cotizacion,$_POST[vehiculo],'$id_usuario','$fecha')";
            if (conectar()->query($query) === TRUE)
            {
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                    $consulta1 = "SELECT max(id_registro) as correlativo FROM cotizacion_detalle";
                    $resultado1 = mysqli_query( conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if ($columna = mysqli_fetch_array( $resultado1 ))
                    { 
                        $contador1 = $columna['correlativo'] + 1;
                    }
                    else
                    {
                        $contador1 = 1;
                    }

                    $query="INSERT INTO cotizacion_detalle(id_registro,id_cotizacion,codigo,cantidad) VALUES ($contador1,$columna1[id_venta],'$columna1[codigo]',$columna1[cantidad])";
                    if (conectar()->query($query) === TRUE) 
                    {
                        
                    }
                }

                $query="delete from temporal where id_venta=$cotizacion";
                if (conectar()->query($query) === TRUE) 
                {
                    $_SESSION['n_cotizacion'] = $cotizacion; 
                    ob_start();
                    include '../../../VistaImprimir.php';
                    $html = ob_get_clean();
                    $dompdf = new Dompdf();
                    $dompdf->loadHtml($html);   
                    $dompdf->setPaper('legal', 'portrait'); 
                    $dompdf->render();
                    $output = $dompdf->output();
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] .'/dichiloe/lubricentro/cotizaciones/'.$cotizacion.'.pdf', $output);
                    //file_put_contents($_SERVER['DOCUMENT_ROOT'] .'/cotizaciones/'.$cotizacion.'.pdf', $output);
                    echo "1";
                }
            }
        }
    }

    if (isset($errors)){
			
        ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> 
                    <?php
                        foreach ($errors as $error) {
                                echo $error;
                            }
                        ?>
            </div>
            <?php
            }
            if (isset($messages)){
                
                ?>
                <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Bien hecho!</strong>
                        <?php
                            foreach ($messages as $message) {
                                    echo $message;
                                }
                            ?>
                </div>
                <?php
            }                
                
?>