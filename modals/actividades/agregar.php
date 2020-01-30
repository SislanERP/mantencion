<form id="guardarDatos">
    <div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Trabajo </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" name="fecha0" id="fecha0" value="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Turno:</label>
                                <select name="turno0" id="turno0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_turnos()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_turno']."'>".$columna['turno']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Equipo:</label>
                                <select name="equipo0" id="equipo0" class="selectpicker form-control" data-live-search="true">
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
                                <label class="col-form-label">Estado:</label>
                                <select name="estado0" id="estado0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_estados()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_estado']."'>".$columna['estado']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Actividad:</label>
                                <input type="text" class="form-control" name="actividad0" id="actividad0">
                            </div>
                            
                            <div class="form-group mb-0">
                                <label class="col-form-label">Detalle Actividad:</label>
                                <textarea name="detalle0" id="detalle0" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <output id="list"></output>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>