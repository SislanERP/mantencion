<?php 
    include('php/funciones.php');
?>

<?php
    $inactivo = 1800;
    $m1 = "";
    $c = 0;
    $c4 = "";
    $c3= 0;
    $arr[] = "";
    $arr1[] = "";
    $arr2[] = "";
    $arr4[]  = "";
    $dd = "";
    $dd1 = "";
 
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
    <?php include('footer.php');?>
<body>
    <div class="contenedor m-3">
        <table class="table" id="export">
            <thead>
                <tr>
                    <td class="border-bottom" colspan="2"></td>
                    <?php
                        $gantt = $_GET['id'];
                        $consulta = "SELECT MONTH(fec_inicio) as inicio, fec_inicio as fec_inicio, fec_termino as fec_termino, MONTH(fec_termino) as termino from gantt where id_gantt = $gantt";
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
                                $token1 = strtok($arr1[$uu], ".");
                                while($token1 !== false) {
                                    $dd .= "<td class='font-weight-bold border'>".$token1."</td>";
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
                                    $arr4[$c1] = $i;
                                    
                    ?>
                                        <td class="font-weight-bold text-center border" colspan="<?=$v?>"><?=$columna['mes']?></td>
                    <?php                 
                                }
                                $c1++;
                            }
                            
                    ?>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold border text-center">Tarea</td>
                                    <td class="font-weight-bold border">Responsable</td>
                                    <?=$dd?>
                                </tr>
                                    
                                        <?php 
                                            $consulta = "SELECT d.ubicacion as area, c.id_ubicacion as id FROM gantt_detalle_actividad a inner join gantt_detalle_equipo b on a.id_gantt_detalle_equipo = b.id_registro inner JOIN equipos c on b.id_equipo = c.id_equipo inner join ubicaciones d on c.id_ubicacion = d.id_ubicacion GROUP by d.ubicacion";
                                            $resultado = mysqli_query( conectar(), $consulta );
                                            while ($columna = mysqli_fetch_array( $resultado ))
                                            {
                                                echo "<tr><th style='color:gray;font-weight:600;border:1px solid #dee2e6 !important;'>".$columna['area']."</th><td style='border-right:1px solid #dee2e6 !important;'></td></tr>";
                                                $consulta1 = "SELECT c.equipo as equipo, b.id_equipo as id FROM gantt_detalle_actividad a inner join gantt_detalle_equipo b on a.id_gantt_detalle_equipo = b.id_registro inner JOIN equipos c on b.id_equipo = c.id_equipo inner join ubicaciones d on c.id_ubicacion = d.id_ubicacion where d.id_ubicacion = $columna[id] GROUP BY c.equipo";
                                                $resultado1 = mysqli_query( conectar(), $consulta1 );
                                                while ($columna1 = mysqli_fetch_array( $resultado1 ))
                                                {
                                                    echo "<tr><td class='pl-4' style='white-space: nowrap;color:#154D92;font-weight:600;border-right:1px solid #dee2e6 !important;'>".$columna1['equipo']."</td><td style='border-right:1px solid #dee2e6 !important;'></td></tr>";
                                                    $consulta2 = "SELECT a.actividad as actividad,e.nombre as responsable, a.id_registro as id FROM gantt_detalle_actividad a inner join gantt_detalle_equipo b on a.id_gantt_detalle_equipo = b.id_registro inner JOIN equipos c on b.id_equipo = c.id_equipo inner join ubicaciones d on c.id_ubicacion = d.id_ubicacion inner join trabajadores e on e.id_trabajador = a.id_usuario_responsable where b.id_equipo = $columna1[id]";
                                                    $resultado2 = mysqli_query( conectar(), $consulta2 );
                                                    while ($columna2 = mysqli_fetch_array( $resultado2 ))
                                                    {
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            echo "<td class='pl-5' style='border-right:1px solid #dee2e6 !important;'> - ".$columna2['actividad']."</td><td style='white-space: nowrap;border-right:1px solid #dee2e6 !important;'>".$columna2['responsable']."</td>";
                                                            $consulta3 = "SELECT fec_inicio,fec_termino FROM gantt_detalle_actividad WHERE id_registro = $columna2[id]";
                                                            $resultado3 = mysqli_query( conectar(), $consulta3 );
                                                            while ($columna3 = mysqli_fetch_array( $resultado3 ))
                                                            {
                                                                $c4 = 0;
                                                                $fecha_entero = strtotime($columna3['fec_inicio']);
                                                                $fecha_entero1 = strtotime($columna3['fec_termino']);
                                                                $dia = date("d", $fecha_entero);
                                                                $dia1 = date("d", $fecha_entero1);
                                                                $mes = date("m", $fecha_entero);
                                                                
                                                                for($i=$mes_inicio; $i<= $mes_termino; $i++)
                                                                { 
                                                                    $consulta4 = "SELECT * FROM meses WHERE id_mes=$i";
                                                                    $resultado4 = mysqli_query( conectar(), $consulta4 );
                                                                    if ($columna4 = mysqli_fetch_array( $resultado4 ))
                                                                    {
                                                                        
                                                                        $token1 = strtok($arr1[$c4], ".");
                                                                         while($token1 !== false) {
                                                                            echo "<td id='".$columna2['id'].$columna4['mes'].$token1."'></td>";
                                                                            $token1 = strtok(".");
                                                                        }
                                                                    }

                                                                    $c4++;
                                                                }

                                                                while($dia <= $dia1)
                                                                {
                                                                    $consulta5 = "SELECT * FROM meses WHERE id_mes=$mes";
                                                                    $resultado5 = mysqli_query( conectar(), $consulta5 );
                                                                    if ($columna5 = mysqli_fetch_array( $resultado5 ))   
                                                                    {
                                                                        echo "<script>$('#".$columna2['id'].$columna5['mes'].$dia."').css('background-color','#154D92');$('#".$columna2['id'].$columna5['mes'].$dia."').css({'border-color': '#fff', 'border-weight':'1px', 'border-style':'solid'});</script>";
                                                                    }

                                                                    $dia++;
                                                                }

                                                                
                                                            }

                                                            
                                                            ?>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                            </tbody>
                    <?php
                        }
                    ?>
                </tr>
            
        </table>
    </div>
</body>
<script>
    $(document).ready(function(){
        
        var htmls = "";
            var uri = 'data:application/vnd.ms-excel;base64,';
            var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv="content-type" content="application/vnd.ms-Excel; charset=UTF-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'; 
            var base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            };

            var format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            };

            htmls = $("#export").html();

            var ctx = {
                worksheet : 'Worksheet',
                table : htmls
            }


            var link = document.createElement("a");
            link.download = "cronograma.xls";
            link.href = uri + base64(format(template, ctx));
            link.click();

    });
</script>
</html>