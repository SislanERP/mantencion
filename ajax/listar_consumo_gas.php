<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];
		
    $desde = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['desde'], ENT_QUOTES)));
    $hasta = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['hasta'], ENT_QUOTES)));

    $_SESSION['totalizador_gas_desde'] = $desde;
    $_SESSION['totalizador_gas_hasta'] = $hasta;

    $tables="   caldera a inner join 
                detalle_caldera b on a.id_control = b.id_control ";

    $campos="   a.fecha as fecha,
                a.hora_encendido as inicio,
                a.hora_apagado as detencion,
                (select x1.entrada from detalle_caldera x1 where x1.id_control = a.id_control and x1.id_tipo = 2 order by x1.id_registro asc limit 1) as entrada,
                (select x2.salida from detalle_caldera x2 where x2.id_control = a.id_control and x2.id_tipo = 2  order by x2.id_registro desc limit 1) as salida";
	$sWhere="   b.id_tipo = 2 and date(a.fecha) between '".$desde."' and '".$hasta."'";
	$sWhere.="  group by a.fecha";

    include 'pagination.php'; 

    $page = getPaginationPos();
	$per_page = 10;
    $adjacents  = 10;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);
	$reload = 'consulta_caldera.php';

    $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

    if ($numrows>0){
        while($row1 = mysqli_fetch_array($query)){
            $dia = $row1['salida'] - $row1['entrada'];
            $total = $total + $dia;
        }
?>
        <div class="d-flex justify-content-between">
            <h1>Totalizador: <?=$total?> m³</h1>
            <a href="diseños/caldera/reporte_gas.php" class="btn btn-primary agregar e6">
                <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
            </a>
        </div>
	    <table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Fecha</th>
				  <th>Hora encendido</th>
                  <th>Hora apagado</th>
                  <th>Entrada m³</th>
                  <th>Salida m³</th>
                  <th>Total día m³</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo date("d/m/Y", strtotime($row['fecha']));?></td>
					<td><?php $entrada = strtotime($row['inicio']);echo date("H:i",$entrada);?></td>
                    <td><?php $salida = strtotime($row['detencion']);echo date("H:i",$salida);?></td>
                    <td><?=$row['entrada']?> m³</td>
                    <td><?=$row['salida']?> m³</td>
                    <td><?=$row['salida'] - $row['entrada']?> m³</td>
				</tr>
				<?php

                
			}
			?>
			</tbody>
		</table>
		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable mt-3 w-100">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}

        function getPaginationPos(){
            if (isset($_REQUEST['page']) && !empty($_REQUEST['page']))
            {
                setcookie('page_caldera_gas',$_REQUEST['page'],time() + 86400);
                return $_REQUEST['page'];
            } 
            else 
            {
                return ($_COOKIE['page_caldera_gas']!='' ? $_COOKIE['page_caldera_gas'] : 1);
            }
            
        }
?>

		  