<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	desincrustador a";

		$campos="	a.fecha as fecha,
					a.consumo as consumo,
                    a.turbiedad as turbiedad,
                    a.dureza as dureza,
                    a.ph as ph,
                    a.conductividad as conductividad";
		$sWhere=" a.fecha LIKE '%".$query."%'";
		$sWhere.=" order by a.id_registro desc";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 20;
        $adjacents  = 20;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'desincrustador.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
                    <th>Fecha</th>
                    <th>Consumo</th>
                    <th>Turbiedad</th>
					<th>Dureza</th>
                    <th>PH</th>
                    <th>Conductividad</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo date("d/m/Y h:i:s", strtotime($row['fecha']));?></td>
					<td><?php echo $row['consumo'];?></td>
					<td><?php echo $row['turbiedad'];?></td>
					<td><?php echo $row['dureza'];?></td>
                    <td><?php echo $row['ph'];?></td>
                    <td><?php echo number_format($row['conductividad'], 0, ',', '.');?></td>
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
			<div class="alert alert-warning alert-dismissable mt-3">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	}
?>

		  