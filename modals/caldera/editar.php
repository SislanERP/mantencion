<form id="actualidarDatos">
    <div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="id" id="id">
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
                                <label class="col-form-label">Tipo Consumo:</label>
                                <select name="tipo" id="tipo" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_tipo_consumo()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_tipo']."'>".$columna['consumo']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Consumo m³ (Entrada):</label>
                                <input type="number" class="form-control" name="entrada" id="entrada">
                            </div>
                            
                            <div class="form-group mb-0">
                                <label class="col-form-label">Consumo m³ (Salida)</label>
                                <input type="number" class="form-control" name="salida" id="salida">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Editar Consumo</button>
                </div>
            </div>
        </div>
    </div>
</form>