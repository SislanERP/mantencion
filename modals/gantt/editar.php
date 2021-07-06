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
                                <label class="col-form-label">Fecha Inicio:</label>
                                <input type="date" id="inicio" name="inicio" class="form-control" required>
                                <input type="hidden" id="id" name="id">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha Termino:</label>
                                <input type="date" id="termino" name="termino" class="form-control" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Año:</label>
                                <input type="number" class="form-control" id="año" name="año" min="2021" required/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Editar Cronograma</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>