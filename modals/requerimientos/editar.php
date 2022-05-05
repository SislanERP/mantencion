<form id="actualidarDatos">
  <div class="modal fade bd-example-modal-xl" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="datos_ajax"></div>
          <div class="row e12">
            <div class="col-sm-12 col-lg-8">
              <div class="form-group mb-0">
                <label class="col-form-label">Actividad:</label>
                <textarea name="actividad" id="actividad" cols="30" rows="10" class="form-control"></textarea>
                <input type="hidden" name="id-edit" id="id-edit">
              </div>
            </div> 
            <div class="col-sm-12 col-lg-4">
                <h3 class="mb-4 pb-3">Imagen referencial</h3>
                <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:100%;">
                    <a data-fancybox="gallery" href="#" id="img-href-edit" style="display: contents;">
                        <img src="" alt="" class="position-absolute" id="img" style="object-fit:cover;width:100%;height:100%;border-style:dashed;">
                    </a>
                    <div class="image-upload">
                        <label for="img-edit">
                            <i class="img-otros fas fa-camera-retro"></i>
                        </label>
                        <input type="file" name="imagen" id="img-edit"/>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer mt-6 pr-0">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Editar Requerimiento</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>