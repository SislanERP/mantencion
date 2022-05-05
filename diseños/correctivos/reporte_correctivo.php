<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Correctivo</title>
    <style>
        td{font-size:15px; padding:3px;}
        ul{margin:1px !important;}
        .border{border:1px solid #c3c3c3;}
        .bl{border-left:1px solid #c3c3c3;}
        .br{border-right:1px solid #c3c3c3;}
        .bb{border-bottom:1px solid #c3c3c3;}
        .table{width:100%;border:1px solid #c3c3c3;}
        .table td{border:1px solid #c3c3c3;}
        table{border-spacing:0px;}
    </style>
</head>

<body>
    <table id="header" width="100%" class="border">
        <thead>
            <?php 
                $consulta = "call consulta_informe(1)";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna = mysqli_fetch_array( $resultado ))
                {
            ?>
                <tr>
                    <td class="br" rowspan="4" style="width:10%;"><img src="../../../img/brand/logo.png" alt="" style="width:90px;"></td>
                    <td class="br" rowspan="4" style="width:60%;text-align:center;"><h3><?=$columna['informe']?> <br><?=$columna['registro']?>   </br></h3></td>
                    <td class="br bb" style="font-size: 12px;text-align:center;">Versión</td>
                    <td class="bb" style="font-size: 12px;text-align:center;"><?=$columna['version']?></td>
                    <tr>
                        <td class="bb" colspan="2" style="font-size: 12px;height:18px;text-align:center;">Página 1 de 1</td>
                    </tr>
                    <tr>
                        <td class="br bb" style="font-size: 12px;text-align:center;">Fecha Elab</td>
                        <td class="bb" style="font-size: 12px;text-align:center;"><?php echo date("d/m/Y", strtotime($columna['fec_elaboracion']))?></td>
                    </tr>
                    <tr>
                        <td class="br" style="font-size: 12px;text-align:center;">Fecha Rev</td>
                        <td style="font-size: 12px;text-align:center;"><?php echo date("d/m/Y", strtotime($columna['fec_revision']))?></td>
                    </tr>
                </tr>
            <?php 
                }
            ?>
            
        <thead>
    </table>

    <?php
        $id = $_GET['id']; 
        $consulta = "call consulta_report_correctivo($id)";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        while ($columna = mysqli_fetch_array( $resultado ))
        {
            echo    "<table class='border' width='100%' style='padding:8px; margin-top:20px;'>
                        <thead>
                            <tr>
                                <td style='width:20%;'>N° Correctivo:</td>
                                <td style='width:50%;'>".$columna['id']."</td>
                                <td style='width:15%;'>Fecha Inicio:</td>
                                <td style='width:15%;'>".date("d/m/Y", strtotime($columna['fecha']))."</td>
                            </tr>
                            <tr>
                                <td>Responsable:</td>
                                <td>".$columna['responsable']."</td>
                                <td style='width:15%;'>Prioridad:</td>
                                <td style='width:15%;'>".$columna['prioridad']."</td>
                            </tr>
                            <tr>
                                <td>Tipo Mantenimiento:</td>
                                <td>".$columna['tipo_mantenimiento']."</td>
                                <td>OT Padre:</td>
                                <td>".$columna['ot_padre']."</td>
                            </tr>
                            <tr>
                                <td>Nombre Equipo:</td>
                                <td colspan='4'>".$columna['equipo']."</td>
                            </tr>
                        </thead>
                    </table>
    
                    <div>
                        <div style='border: 1px solid #c3c3c3;margin-top:20px;'>
                            <h3 style='text-align:center;margin:5px;'>Actividad</h3>
                        </div>
                        <div style='border: 1px solid #c3c3c3;height:200px;'>
                            <p style='margin-left:10px;'>".$columna['actividad']."</p>
                        </div>
                    </div>
                    
                    <div>
                        <div style='border: 1px solid #c3c3c3;margin-top:20px;'>
                            <h3 style='text-align:center;margin:5px;'>Detalle de Actividad</h3>
                        </div>
                        <div style='border: 1px solid #c3c3c3;height:200px;'>
                            
                        </div>
                    </div>
        
                    <div style='margin-top:150px;'>
                        <div>
                            <span>Responsable</span>
                            <span style='float:right;'>V°B Jefe Mantención</span>
                        </div>
                        <div>
                            <span style='font-weight:bolder;'>".$columna['responsable']."</span>
                        </div>
                    </div>
                    ";
        }    
    ?>
</body>
</html>