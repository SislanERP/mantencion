<?php
	session_start();
	require_once("../php/conexion.php");

    $gantt = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));
	$tables="	gantt_detalle_actividad a inner join
                gantt_detalle_equipo b on a.id_gantt_detalle_equipo = b.id_registro inner join
                trabajadores c on a.id_usuario_responsable = c.id_trabajador inner join
                gantt d on b.id_gantt = d.id_gantt";

	$campos="	a.id_registro as id,
                a.actividad as actividad,
                c.nombre as responsable,
                a.fec_inicio as inicio,
                a.fec_termino as termino,
                d.id_gantt as gantt,
                a.id_usuario_responsable as id_responsable";
	$sWhere=" a.id_gantt_detalle_equipo = $gantt";

    include 'pagination.php'; 

    $page = 1;
	$per_page = 1000;
    $adjacents  = 1000;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}else{$numrows =0;}
    $total_pages = ceil($numrows/$per_page);
	$reload = 'gantt.php';

    $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

    if ($numrows>0){
?>
	<table class="table mt-2">
			  <thead class="thead-light">
				<tr>
				  <th>Actividad</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Termino</th>
                  <th>Responsable</th>
                  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
                    <td><?php echo $row['actividad'];?></td>
                    <td><?php echo $row['inicio'];?></td>
                    <td><?php echo $row['termino'];?></td>
                    <td><?php echo $row['responsable'];?></td>
					<td>
                        <div class="d-flex">
                            <form id="EliminarActividad<?=$row['id']?>">
                                <input type="hidden" id='id_registro_eliminar<?=$row['id']?>' value="<?=$row['id']?>"/>
                                <button type="button" data-toggle="modal" data-target="#dataActividad" data-id="<?=$row['id']?>" data-i="<?=$row['inicio']?>" data-t="<?=$row['termino']?>" data-r="<?=$row['id_responsable']?>" data-a="<?=$row['actividad']?>" class="btn p-0"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
                                <button type="submit" class="btn p-0"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
                            </form>
                        </div>
                    </td>
				</tr>

                <script>
                    $( "#EliminarActividad<?=$row['id']?>" ).submit(function( event ) {
                        var id = $("#id_registro_eliminar<?=$row['id']?>").val();
                        var parametros = {'query':id};
                        $.ajax({
                            url: "php/acciones/delete/delete_gantt_detalle_actividad.php",
                            data: parametros,
                            success: function(data){
                                $(".mensaje_gantt_actividades").show();
                                $(".mensaje_gantt_actividades").html(data);
                                setTimeout(function() { $('.mensaje_gantt_actividades').fadeOut('fast'); }, 3000);
                                var id = $("#id_gantt").val();
                                actividades_gantt(id);
                            }
                        });
                        event.preventDefault();
                    });
                </script>
                
				<?php
			}
			?>
			</tbody>
		</table>
		
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

		  