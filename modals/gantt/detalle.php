
    <div class="modal bd-example-modal-lg fade" id="dataDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle cronograma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-equipos" data-toggle="tab" href="#equipos" role="tab" aria-controls="equipos" aria-selected="true">Equipos</a>
                        </li>
                        <li class="nav-item d-none tab-1">
                            <a class="nav-link" id="home-actividades" data-toggle="tab" href="#actividades" role="tab" aria-controls="actividades" aria-selected="false">Actividades</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="equipos" role="tabpanel" aria-labelledby="home-equipos">
                            <form id="AddEquipo">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Área</label>
                                        <select name="area" id="area" class="selectpicker form-control" data-live-search="true">
                                            <?php 
                                                $consulta = "call consulta_ubicaciones()";
                                                $resultado = mysqli_query(conectar(), $consulta );
                                                while ($columna = mysqli_fetch_array( $resultado ))
                                                { 
                                                    echo    "<option value='".$columna['id_ubicacion']."'>".$columna['ubicacion']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <input type="hidden" id="id_gantt" name="id_gantt">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Equipo</label>
                                        <div id="select_equipos"></div>
                                    </div>
                                    <div class="pr-3 pb-3 d-flex w-100 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                    <div class="mensaje_gantt_equipo w-100 pl-3 pr-3"></div>
                                    <div id="listado_equipos_gantt" class="w-100 pl-3 pr-3"></div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="actividades" role="tabpanel" aria-labelledby="home-actividades">
                            <form id="AddActividad">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Fecha inicio</label>
                                        <input class="form-control" type="date" id="fec_inicio" name="fec_inicio" value="<?php echo date("Y-m-d");?>">
                                        <input type="hidden" id="id_gantt_equipo" name="id_gantt_equipo" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Fecha termino</label>
                                        <input class="form-control" type="date" id="fec_termino" name="fec_termino" value="<?php echo date("Y-m-d");?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Responsable</label>
                                        <select name="responsable" id="responsable" class="selectpicker form-control" data-live-search="true">
                                            <?php 
                                                $consulta = "call consulta_trabajadores()";
                                                $resultado = mysqli_query(conectar(), $consulta );
                                                while ($columna = mysqli_fetch_array( $resultado ))
                                                { 
                                                    echo    "<option value='".$columna['id_trabajador']."'>".$columna['nombre']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12" >
                                        <label>Actividad</label>
                                        <textarea class="form-control" name="actividad" id="actividad" cols="10" rows="3"></textarea>
                                    </div>
                                    <div class="pr-3 pb-3 d-flex w-100 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                    <div class="mensaje_gantt_actividades w-100 pl-3 pr-3"></div>
                                    <div id="listado_actividades_gantt" class="w-100 pl-3 pr-3"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    