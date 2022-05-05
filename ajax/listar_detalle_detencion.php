<?php
	require_once("../php/conexion.php");
	session_start();

    $id = $_GET['id'];
    $query = mysqli_query(conectar(),"CALL listar_detalle_detencion($id)");
?>
			  <thead class="thead-light">
				<tr>
				  <th scope="col" style="width:170px;">Tipo Falla</th>
				  <th scope="col" style="width:250px;">Equipo</th>
				  <th scope="col">Detalle</th>
				  <th scope="col" style="width:90px;">Hora Falla</th>
				  <th scope="col" style="width:90px;">Tiempo</th>
                  <th scope="col" style="width:90px;">Detención?</th>
				  <th scope="col" style="width:80px;">Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			    while($row = mysqli_fetch_array($query)){
?>
				<tr>
                    <td><?php echo $row['tipo_falla'];?></td>
					<td><?php echo $row['equipo'];?></td>
					<td><?php echo $row['descripcion'];?></td>
					<td><?php $cadena = substr($row['hora_falla'], 0, -3); echo $cadena;?></td>
					<td><?php $cadena = substr($row['tiempo'], 0, -3); echo $cadena;?></td>
                    <td>
                        <?php 
                                if($row['detencion'] == 1)
                                {
                                    ?>
                                    <img src="img/iconos/nok.svg" width="22px" alt="Detención Proceso">
                                    <?php
                                } 
                                else
                                {
                                    ?>
                                    <img src="img/iconos/ok.svg" width="22px" alt="Proceso Normal">
                                    <?php
                                }
                        ?>
                    </td>
                    <td>
                        <a class="text-dark" href="#" data-toggle="modal" data-target="#dataDeleteDetalle" data-id="<?=$row['id']?>" title="Eliminar">
                            <i class="fa fa-trash-alt pl-1" style="font-size:20px;"></i>
                        </a>
                    </td>
				</tr>
<?php
			    }
?>
			</tbody>
