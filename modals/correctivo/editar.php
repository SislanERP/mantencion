<form id="actualidarDatos">
    <div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar correctivo </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" class="form-control">
                                <input type="hidden" id="id" name="id"> 
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">OT Padre:</label>
                                <input type="text" id="ot_padre" name="ot_padre" class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Prioridad:</label>
                                <select name="prioridad" id="prioridad" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_prioridades()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_prioridad']."'>".$columna['prioridad']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Equipo:</label>
                                <select name="equipo" id="equipo" class="selectpicker form-control" data-live-search="true">
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
                                <label class="col-form-label">Responsable:</label>
                                <select name="responsable" id="responsable" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_responsables()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_usuario']."'>".$columna['nombre']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Estado:</label>
                                <select name="estado" id="estado" class="selectpicker form-control" data-live-search="true">
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
                                <textarea name="actividad" id="actividad" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pr-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Editar Actividad</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>