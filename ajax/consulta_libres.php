<?php
	session_start();
	require_once("../php/conexion.php");

	$id_usuario = $_SESSION['id_user'];

    $query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$tables="	libres";

	$campos="	*";
	$sWhere=" id_usuario_registro = $query and fec_pagada is null";
	$sWhere.=" order by fec_trabajada asc";

    include 'pagination.php'; 

    $page = getPaginationPos();
	$per_page = 8;
    $adjacents  = 8;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);
	$reload = 'consulta_libres.php';

    $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

    if ($numrows>0){
?>
	<table class="table mt-5">
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
					<td><?php echo $row['fec_pagada'];?></td>
					<td>
						<?php
                                $token = $_SESSION['page'];
								$consulta = "call consulta_acceso_sub_pagina('$token',$id_usuario)";
								$resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
								if ($columna = mysqli_fetch_array( $resultado ))
								{ 
                                    
									if($columna['editar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id_libre']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
						?>
						<?php
									if($columna['eliminar'] == 1){
						?>
										<button type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id_libre']?>" data-fecha="<?php echo date("d/m/Y", strtotime($row['fec_trabajada']))?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<?php
									}
								}
						?>
					</td>
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
	
?>
<?php 
function getPaginationPos(){
	if (isset($_REQUEST['page']) && !empty($_REQUEST['page']))
	{
		setcookie('page_consulta_libres',$_REQUEST['page'],time() + 86400);
		return $_REQUEST['page'];
	} 
	else 
	{
		return ($_COOKIE['page_consulta_libres']!='' ? $_COOKIE['page_consulta_libres'] : 1);
	}
	
}
?>

		  