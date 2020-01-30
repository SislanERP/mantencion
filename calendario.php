<?php 
    include('php/funciones.php');
    require_once('php/bdd.php');


    $sql = "SELECT a.id as id, b.equipo as title, a.start as start, a.end as end, a.color as color FROM events a left outer join equipos b on a.title = b.id_equipo ";
    
    $req = $bdd->prepare($sql);
    $req->execute();
    
    $events = $req->fetchAll();

?>

<?php
    $inactivo = 1800;
 
    if(isset($_SESSION['id_user']) ) {
        $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
            echo "<script>location.href='index.php';</script>";
            die();
        }
        else
        {
            $_SESSION['tiempo'] = time();
        }
    }
    else
    {
        echo "<script>location.href='index.php';</script>";
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <?php include('head.php');?>
<body>
    <?php include('nav.php');?>

    <div id="content">
      <div class="content-fluid p-5 shadow mb-5 bg-white e7" style="background:#fff;border-radius:15px;">
        <div id="calendar" class="col-centered"></div>
    </div>
  </div>


  <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="php/acciones/add/add_evento.php">
			
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Evento </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
			  <div class="modal-body">
				
                    <div class="form-group mb-0">
                        <label class="col-form-label">Equipo:</label>
                        <select name="title" id="title" class="selectpicker form-control" data-live-search="true" required>
                        <?php 
                            $consulta = "call consulta_equipos()";
                            $resultado = mysqli_query(conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            { 
                                echo    "<option value='".$columna['id_equipo']."'>".$columna['equipo']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label">Frecuencia:</label>
                        <select name="frecuencia" id="frecuencia" class="selectpicker form-control" data-live-search="true" required>
                        <?php 
                            $consulta = "call consulta_frecuencia()";
                            $resultado = mysqli_query(conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            { 
                                echo    "<option value='".$columna['id_frecuencia']."'>".$columna['frecuencia']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label">Fecha Inicio:</label>
                        <input type="date" name="start" class="form-control" id="start" readonly>
                    </div>
				  
				  <div class="form-group">
					  <input type="hidden" name="end" class="form-control" id="end" readonly>
				  </div>
				
			  </div>
			  <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="php/acciones/update/update_evento_title.php">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Preventiva </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
			  <div class="modal-body">
				
                <div class="form-group mb-0">
                    <label class="col-form-label">Responsable:</label>
                    <select name="responsable" id="responsable" class="selectpicker form-control" data-live-search="true" required>
                        <?php 
                            $consulta = "call   consulta_trabajadores()";
                            $resultado = mysqli_query(conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            { 
                                echo    "<option value='".$columna['id_trabajador']."'>".$columna['nombre']."</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-0">
                    <label class="col-form-label">Prioridad:</label>
                    <select name="prioridad" id="prioridad" class="selectpicker form-control" data-live-search="true" required>
                        <?php 
                            $consulta = "call   consulta_prioridades()";
                            $resultado = mysqli_query(conectar(), $consulta );
                            while ($columna = mysqli_fetch_array( $resultado ))
                            { 
                                echo    "<option value='".$columna['id_prioridad']."'>".$columna['prioridad']."</option>";
                            }
                        ?>
                    </select>
                </div>

				<div class="form-group  mt-4 p-0"> 
					<div class="col-sm-offset-2 col-sm-10 p-0">
						<a href="" class="text-danger p-0">Eliminar Evento</a>
					</div>
				</div>
				  
                <input type="hidden" name="id1" class="form-control" id="id1">
                <input type="hidden" name="start1" class="form-control" id="start1">
				<input type="hidden" name="title1" class="form-control" id="title1">
				
			  </div>
			  <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
				<button type="submit" class="btn btn-primary">Crear Preventivo</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

  
              
    <?php include('footer.php');?>
    <script src='js/fullcalendar/moment.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.js'></script>
	<script src='js/fullcalendar/locale/es.js'></script>

    <script>
		$(document).ready(function(){
            load(1);
		});
    </script>

<script>

$(document).ready(function() {

    var date = new Date();
   var yyyy = date.getFullYear().toString();
   var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
   var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
        header: {
             language: 'es',
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay',

        },
        defaultDate: yyyy+"-"+mm+"-"+dd,
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            
            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
            $('#ModalAdd').modal('show');
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                $('#ModalEdit #id1').val(event.id);
                $('#ModalEdit #title1').val(event.title);
                $('#ModalEdit #color').val(event.color);
                $('#ModalEdit #start1').val(moment(event.start).format('YYYY-MM-DD'));
                $('#ModalEdit').modal('show');
            });
        },
        eventDrop: function(event, delta, revertFunc) { // si changement de position

            edit(event);

        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

            edit(event);

        },
        events: [
        <?php foreach($events as $event): 
        
            $start = explode(" ", $event['start']);
            $end = explode(" ", $event['end']);
            if($start[1] == '00:00:00'){
                $start = $start[0];
            }else{
                $start = $event['start'];
            }
            if($end[1] == '00:00:00'){
                $end = $end[0];
            }else{
                $end = $event['end'];
            }
        ?>
            {
                id: '<?php echo $event['id']; ?>',
                title: '<?php echo $event['title']; ?>',
                start: '<?php echo $start; ?>',
                end: '<?php echo $end; ?>',
                color: '<?php echo $event['color']; ?>',
            },
        <?php endforeach; ?>
        ]
    });
    
    function edit(event){
        start = event.start.format('YYYY-MM-DD');
        if(event.end){
            end = event.end.format('YYYY-MM-DD');
        }else{
            end = start;
        }
        
        id =  event.id;
        
        Event = [];
        Event[0] = id;
        Event[1] = start;
        Event[2] = end;
        
        $.ajax({
         url: 'php/acciones/update/update_evento_date.php',
         type: "POST",
         data: {Event:Event},
         success: function(rep) {

            }
        });
    }
    
});

</script>


</body>
</html>