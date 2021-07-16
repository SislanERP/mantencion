<?php 
    include('php/funciones.php');
?>

<?php
    $inactivo = 1800;
    $m1 = "";
    $c = 0;
    $c2 = 0;
    $arr[] = "";
    $arr1[] = "";
    $dd="";
 
    if(isset($_SESSION['id_user']) ) {
        $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
            echo "<script>location.href='index.php';</script>";
            die();
        }
        else
        {
            $_SESSION['tiempo'] = time();
        }
    }
    else
    {
        echo "<script>location.href='index.php';</script>";
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <div class="contenedor m-3 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <td colspan="2"></td>
                    <?php 
                        $consulta = "SELECT MONTH(fec_inicio) as inicio, fec_inicio as fec_inicio, fec_termino as fec_termino, MONTH(fec_termino) as termino from gantt where id_gantt = 1";
                        $resultado = mysqli_query( conectar(), $consulta );
                        if ($columna = mysqli_fetch_array( $resultado ))
                        {
                            $mes_inicio = $columna['inicio'];
                            $mes_termino = $columna['termino'];
                            $dia_inicial = $columna['fec_inicio']; //PRIMER DIA
                            $dia_final = $columna['fec_termino']; //ULTIMO DIA
                            
                            //DIAS POR MES
                            while ($dia_inicial <= $dia_final)
                            {
                                $fecha_entero = strtotime($dia_inicial);
                                $dia = date("d", $fecha_entero);
                                $mes = date("m", $fecha_entero);

                                $m1 .= $dia.".";
                                $dia_inicial = date("Y-m-d",strtotime($dia_inicial."+ 1 days"));
                                $fecha_entero_sumado = strtotime($dia_inicial);
                                $mes_sumado = date("m", $fecha_entero_sumado);
                                if($mes <> $mes_sumado)
                                {
                                   $m1.="</br>";
                                }
                            }
                           
                            $token = strtok($m1, " </br>");
                            while($token !== false) {
                                $arr[$c] = substr_count($token, '.'); 
                                $arr1[$c] = $token;
                                $token = strtok(" </br>");
                                $c++;
                            }


                            $cc = count($arr1);
                            for($uu = 0 ; $uu < $cc ; $uu++)
                            {
                                echo $uu;
                                $token1 = strtok($arr1[$uu], ".");
                                while($token1 !== false) {
                                    $dd .= "<td>".$token1."</td>";
                                    $token1 = strtok(".");
                                }
    
                            }
                            
                            $c1=0;

                            for($i=$mes_inicio; $i<= $mes_termino; $i++)
                            {
                                $consulta = "SELECT * FROM meses WHERE id_mes=$i";
                                $resultado = mysqli_query( conectar(), $consulta );
                                if ($columna = mysqli_fetch_array( $resultado ))
                                {
                                    $v = $arr[$c1];
                                    
                    ?>
                                        
                                        <td colspan="<?=$v?>"><?=$columna['mes']?></td>
                                    
                    <?php                 
                                }
                                $c1++;
                            }
                            
                    ?>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tarea</td>
                                            <td>Responsable</td>
                                            <?php 
                                                 $o = count($arr1);
                                                 for($u=0;$u<=$o;$u++)
                                                 {
                                                     echo $dd;
                                                 }
                                            ?>
                                        </tr>
                                        <tr>
                                        <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                    <?php
                        }
                    ?>
                </tr>
            
        </table>
    </div>
    
</body>
</html>