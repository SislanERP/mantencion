<form id="eliminarDatos">
    <div class="modal fade" id="dataDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <p>Esta acción eliminará de forma permanente el día libre de <b id="nom" class="font-weight-bold"></b> con fecha trabajada: (<b id="fec" class="font-weight-bold"></b>).</p>
                    <p>Deseas continuar?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</form>