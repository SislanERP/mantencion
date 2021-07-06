<form id="guardarDatos">
    <div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Cronograma </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha Inicio:</label>
                                <input type="date" id="inicio0" name="inicio0" class="form-control" value="<?php echo date("Y-m-d");?>" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha Termino:</label>
                                <input type="date" id="termino0" name="termino0" class="form-control" value="<?php echo date("Y-m-d");?>" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Año:</label>
                                <input type="number" class="form-control" id="año0" name="año0" min="2021" required/>
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