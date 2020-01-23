<form id="guardarDatos">
    <div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Detención </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Tipo Falla:</label>
                                <select name="tipo0" id="tipo0" class="selectpicker form-control" data-live-search="true" required>
                                    <?php 
                                        $consulta = "call consulta_tipo_falla()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_tipo_falla']."'>".$columna['tipo']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Equipo:</label>
                                <select name="equipo0" id="equipo0" class="selectpicker form-control" data-live-search="true" required>
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
                                <label class="col-form-label">Descripción:</label>
                                <textarea name="descripcion0" id="descripcion0" cols="20" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Hora de Falla:</label>
                                <input type="time" class="form-control" name="falla0" id="falla0" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Tiempo:</label>
                                <input type="time" class="form-control" name="tiempo0" id="tiempo0" required>
                            </div>
                            
                            <div class="form-group mb-0 d-flex align-items-center">
                                <label class="col-form-label">Detención de proceso:</label>
                                <div class="form-check ml-3">
                                    <input class="form-check-input mt-3" type="radio" name="detencion_proceso0" id="detencion_proceso1" value="1" checked>
                                    <label class="form-check-label" for="detencion_proceso1">
                                        Sí
                                    </label>
                                </div>
                                <div class="form-check ml-3">
                                    <input class="form-check-input mt-3" type="radio" name="detencion_proceso0" id="detencion_proceso2" value="0">
                                    <label class="form-check-label" for="detencion_proceso2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <output id="list"></output>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Agregar Detención</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>