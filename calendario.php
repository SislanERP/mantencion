<?php 
    session_start();
    include('php/conexion.php');
    require_once('php/bdd.php');
    $_SESSION['titulo'] = "Calendario";

    $sql = "SELECT a.id as id, b.equipo as title, a.start as start, a.end as end, a.color as color FROM events a left outer join equipos b on a.title = b.id_equipo ";
    
    $req = $bdd->prepare($sql);
    $req->execute();
    
    $events = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Sistema Mantención | <?=$_SESSION['titulo']?></title>
  <?php include('head.php')?>
</head>

<body>
    <?php include('menu.php')?>
    <div class="main-content">
        <?php include('nav.php')?>
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
        <div class="container-fluid mt--7 mb-5">
            <div class="row">
                <div class="col" >
                    <div class="card shadow">
                        <div class="resultado">
                            <div id="content">
                                <div class="content-fluid p-5 shadow bg-white e7" style="background:#fff;border-radius:15px;">
                                <div id="calendar" class="col-centered"></div>
                            </div>
                        </div>

                        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form class="form-horizontal" id="CrearEvento">
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
                                    <form class="form-horizontal" id="CrearPreventivo">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Crear Preventiva</h5>
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
                                            <input type="hidden" name="id1" class="form-control" id="id1">
                                            <input type="hidden" name="start1" class="form-control" id="start1">
                                            <input type="hidden" name="title1" class="form-control" id="title1">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                                            <button type="submit" class="btn btn-primary">Crear Preventivo</button>
                                        </div>
                                    </form>

                                    <form id="EliminarEvento" style="position: absolute;bottom: 1px;left: 18px;">
                                        <input type="hidden" name="id1" class="form-control" id="id1">
                                        <div class="form-group  mt-4 p-0"> 
                                            <div class="col-sm-offset-2 col-sm-10 p-0">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </div>
                                    </form>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mensaje"></div>

    <?php include('script.php');?>
    <script src="js/funciones/calendario.js"></script>
    <script src='js/fullcalendar/moment.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.js'></script>
	<script src='js/fullcalendar/locale/es.js'></script>

    <script>
        $(document).ready(function() {
            diseño();
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