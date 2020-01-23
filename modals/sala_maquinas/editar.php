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
                            <div class="form-group mb-0">
                                <label class="col-form-label">Equipo:</label>
                                <select name="equipo" id="equipo" class="selectpicker form-control" data-live-search="true" required>
                                    <?php 
                                        $consulta = "call consulta_maquinas()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_maquina']."'>".$columna['maquina']."</option>";
                                        }
                                    ?>
                                </select>
                                <input type="hidden" id="id" name="id">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Temperatura:</label>
                                <input type="text" class="form-control" id="temperatura" name="temperatura" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Hora inicio congelación:</label>
                                <input type="time" class="form-control" name="inicio" id="inicio" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Hora termino congelación:</label>
                                <input type="time" class="form-control" name="termino" id="termino" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Editar Control</button>
                </div>
            </div>
        </div>
    </div>
</form>