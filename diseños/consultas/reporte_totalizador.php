<?php
    session_start();
    require_once("../../php/conexion.php");

    $desde = $_SESSION['totalizador_desde']; 
    $hasta = $_SESSION['totalizador_hasta']; 

    header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
    header('Content-Disposition: attachment; filename=totalizador.xls');

    $consulta = "SELECT date(a.fecha) as Fecha, date_format(a.fecha,'%H:%i:%s') as Hora, a.valor as Valor FROM f_total_riles a WHERE date(a.fecha) between '$desde' and '$hasta' order by a.fecha";
    $resultado = mysqli_query(conectar(), $consulta );
    
?>
    <table class="table">
		<thead class="thead-light">
			<tr>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Metros Cúbicos</th>
			</tr>
		</thead>
<?php
            while($row = mysqli_fetch_array($resultado)){
?>
				<tr>
					<td><?=$row['Fecha']?></td>
					<td><?=$row['Hora'];?></td>
					<td><?=$row['Valor']?></td>
				</tr>
<?php
			}
?>
		</tbody>
	</table>  


    <table class="table">
        <?php
            $consulta = "SELECT  min(a.valor) as minimo , max(a.valor) as maximo FROM f_total_riles a WHERE date(a.fecha) between '$desde' and '$hasta'";
            $resultado = mysqli_query(conectar(), $consulta );
            if($row = mysqli_fetch_array($resultado)){
                $total = $row['maximo'] - $row['minimo'];
?>
				<tr>
					<td style="font-weight:bolder;background:yellow;">Totalizador</td>
					<td style="font-weight:bolder;background:yellow;"><?=$total?></td>
				</tr>
<?php
			}
?>
		</tbody>
	</table>  
