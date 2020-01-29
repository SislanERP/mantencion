<form id="actualidarDatos">
  <div class="modal fade bd-example-modal-lg" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="datos_ajax"></div>
          <div class="row">
            <div class="col-6">
              <div class="form-group mb-0">
                <label class="col-form-label">Actividad:</label>
                <textarea name="actividad" id="actividad" cols="30" rows="10" class="form-control"></textarea>
                <input type="hidden" name="id" id="id">
              </div>
            </div> 
            <div class="col-6">
              <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:300px;">
                <img src="" alt="" class="pt-3 rounded-circle position-absolute" id="img" style="object-fit:cover;width:280px;height:300px;">
                <div class="image-upload">
                  <label for="img-edit">
                    <img src="img/iconos/camara.svg"/> 
                  </label>

                  <input type="file" name="imagen" id="img-edit"/>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer mt-5">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar Requerimiento</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>