<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];
		
    $desde = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['desde'], ENT_QUOTES)));
    $hasta = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['hasta'], ENT_QUOTES)));

    $_SESSION['totalizador_desde'] = $desde;
    $_SESSION['totalizador_hasta'] = $hasta;

    $tables="   f_total_riles a";

    $campos="   a.fecha as Hora,
                a.valor as Valor";
	$sWhere="   date(a.fecha) between '".$desde."' and '".$hasta."'";
	$sWhere.="  order by a.fecha";

    include 'pagination.php'; 

    $page = getPaginationPos();
	$per_page = 10;
    $adjacents  = 10;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);
	$reload = 'consulta_plc.php';

    $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

    if ($numrows>0){
        $consulta = "SELECT  min(a.valor) as minimo , max(a.valor) as maximo FROM f_total_riles a WHERE date(a.fecha) between '$desde' and '$hasta'";
        $resultado = mysqli_query(conectar(), $consulta );
        if($row = mysqli_fetch_array($resultado)){
            $total = $row['maximo'] - $row['minimo'];
        }
?>
        <div class="d-flex justify-content-between">
            <h1>Totalizador: <?=$total?> m³</h1>
            <a href="diseños/consultas/reporte_totalizador.php" class="btn btn-primary agregar e6">
                <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
            </a>
        </div>
	    <table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Fecha - Hora</th>
				  <th>Metros Cúbicos</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?=$row['Hora'];?></td>
					<td><?=$row['Valor']?> m³</td>
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
                setcookie('page_totalizador',$_REQUEST['page'],time() + 86400);
                return $_REQUEST['page'];
            } 
            else 
            {
                return ($_COOKIE['page_totalizador']!='' ? $_COOKIE['page_totalizador'] : 1);
            }
            
        }
?>

		  