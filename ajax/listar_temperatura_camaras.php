<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];
		
    $desde = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['desde'], ENT_QUOTES)));
    $hasta = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['hasta'], ENT_QUOTES)));

    $_SESSION['temperatura_camaras_desde'] = $desde;
    $_SESSION['temperatura_camaras_hasta'] = $hasta;

    $tables="   historial_camara a inner join 
                memorias b on a.id_memoria = b.id_registro ";

    $campos="   a.id_registro as id,
                b.nombre as ubicacion,
                a.fecha as fecha,
                a.valor as temperatura";
	$sWhere="   date(a.fecha) between '".$desde."' and '".$hasta."'";
	$sWhere.="  order by a.fecha asc";

    include 'pagination.php'; 

    $page = getPaginationPos();
	$per_page = 10;
    $adjacents  = 10;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);
	$reload = 'consulta_camara.php';

    $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

    if ($numrows>0){
        
?>
        <div class="d-flex justify-content-end">
            <!-- <h1>Totalizador: <?=$total?> m³</h1> -->
            <a href="diseños/camara/reporte_temperatura_camaras.php" class="btn btn-primary agregar e6">
                <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
            </a>
        </div>
	    <table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Ubicación</th>
				  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Temperatura</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
                    <td><?=$row['ubicacion']?></td>
					<td><?php echo date("d/m/Y", strtotime($row['fecha']));?></td>
					<td><?php $hora = strtotime($row['fecha']);echo date("H:i",$hora);?></td>
                    <td><?=$row['temperatura']?> °C</td>
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
                setcookie('page_camara_temperatura',$_REQUEST['page'],time() + 86400);
                return $_REQUEST['page'];
            } 
            else 
            {
                return ($_COOKIE['page_camara_temperatura']!='' ? $_COOKIE['page_camara_temperatura'] : 1);
            }
            
        }
?>

		  