<?php
	session_start();
	require_once("../php/conexion.php");

    $id_usuario = $_SESSION['id_user'];
    $contador = 0;

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$tables="	libres a";

        $campos="	a.id_libre as id,
                    a.fec_trabajada as fec_trabajada,
					a.fec_pagada as fec_pagada";
		$sWhere=" a.id_usuario_registro= ".$id_usuario." and a.fec_pagada IS NULL";
		$sWhere.=" order by a.id_libre";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 6;
        $adjacents  = 6;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'libres.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Fecha Trabajada</th>
				  <th>Fecha Pagada</th>
                  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo date("d/m/Y", strtotime($row['fec_trabajada']));?></td>
                    <td><?php if(empty($row['fec_pagada'])){echo "Pendiente";}else{echo date("d/m/Y", strtotime($row['fec_pagada']));}?></td>
					<td>
						<?php
								$id_usuario = $_SESSION['id_user'];
								$token = $_SESSION['page'];
								$consulta = "call consulta_acceso_sub_pagina('$token',$id_usuario)";
								$resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
								while ($columna = mysqli_fetch_array( $resultado ))
								{ 
									if($columna['editar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
									if($columna['eliminar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-dia="<?php echo date("d/m/Y", strtotime($row['fec_trabajada']))?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
								}
						?>
					</td>
				</tr>
				<?php $contador =$contador +1;
			}
			?>
			</tbody>
		</table>
		<div class="table-pagination d-flex justify-content-between">
            <span class="w-100 font-weight-bolder"><?php echo "Días Pendientes: " .$contador; $_SESSION['pendientes'] = $contador;?></span>
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

		  