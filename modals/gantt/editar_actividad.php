<form id="actualidarActividad">
    <div class="modal fade" id="dataActividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label class="col-form-label">Fecha Inicio:</label>
                                <input type="date" id="inicio1" name="inicio1" class="form-control" required>
                                <input type="hidden" id="idd" name="idd">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha Termino:</label>
                                <input type="date" id="termino1" name="termino1" class="form-control" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Responsable:</label>
                                <select name="responsable1" id="responsable1" class="selectpicker form-control" data-live-search="true">
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
                            <div class="form-group mb-0">
                                <label>Actividad</label>
                                <textarea class="form-control" name="actividad1" id="actividad1" cols="10" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Editar actividad</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>