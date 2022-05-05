<form id="actualidarDatos">
    <div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date("Y-m-d");?>" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Turno:</label>
                                <select name="turno" id="turno" class="selectpicker form-control" data-live-search="true">
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
                                <label class="col-form-label">Hora encendido</label>
                                <input type="time" class="form-control" name="h_encendido" id="h_encendido">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Hora apagado</label>
                                <input type="time" class="form-control" name="h_apagado" id="h_apagado">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Observación:</label>
                                <textarea name="observacion" id="observacion" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <output id="list"></output>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>