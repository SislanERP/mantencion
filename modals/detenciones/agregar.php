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
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" name="fecha0" id="fecha0" value="<?php echo date("Y-m-d");?>" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Camiones:</label>
                                <input type="number" class="form-control" name="camiones0" id="camiones0" onkeypress='validate(event)' min="0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Kilos Mm.PP:</label>
                                <input type="number" class="form-control" name="kilos_mm_pp0" id="kilos_mm_pp0" onkeypress='validate(event)' min="0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Kilos Producidos:</label>
                                <input type="number" class="form-control" name="kilos_producidos0" id="kilos_producidos0" onkeypress='validate(event)' min="0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Rendimiento:</label>
                                <input type="decimal" class="form-control" name="rendimiento0" id="rendimiento0" onkeypress='validate(event)' min="0">
                            </div>
                            
                            <div class="form-group mb-0">
                                <label class="col-form-label">Kilos Embolsado:</label>
                                <input type="number" class="form-control" name="kilos_embolsado0" id="kilos_embolsado0" onkeypress='validate(event)' min="0">
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