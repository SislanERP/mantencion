<form id="actualidarDatos">
    <div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Detención </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" required>
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Camiones:</label>
                                <input type="number" class="form-control" name="camiones" id="camiones" onkeypress='validate(event)' min="0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Kilos Mm.PP:</label>
                                <input type="number" class="form-control" name="kilos_mm_pp" id="kilos_mm_pp" onkeypress='validate(event)' min="0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Kilos Producidos:</label>
                                <input type="number" class="form-control" name="kilos_producidos" id="kilos_producidos" onkeypress='validate(event)' min="0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Rendimiento:</label>
                                <input type="decimal" class="form-control" name="rendimiento" id="rendimiento" onkeypress='validate(event)' min="0">
                            </div>
                            
                            <div class="form-group mb-0">
                                <label class="col-form-label">Kilos Embolsado:</label>
                                <input type="number" class="form-control" name="kilos_embolsado" id="kilos_embolsado" onkeypress='validate(event)' min="0">
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