
<form id="guardarDatos">
    <div class="modal fade bd-example-modal-xl" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Requerimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Actividad:</label>
                                <textarea name="actividad0" id="actividad0" cols="30" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>    
                        <div class="col-sm-12 col-lg-4">
                            <h3 class="mb-4 pb-3">Imagen referencial</h3>
                            <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:100%;">
                                <img src="" alt="" class="position-absolute" id="imagenmuestra1" style="object-fit:cover;width:100%;height:100%;border-style:dashed;">
                                <div class="image-upload">
                                    <label for="file-input">
                                        <i class="img-otros fas fa-camera-retro"></i>
                                    </label>

                                    <input type="file" name="imagen" id="file-input"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <output id="list"></output>
                    <div class="modal-footer mt-5 pr-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Agregar Requerimiento</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
            $('#imagenmuestra1').attr('src', e.target.result);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('file-input').addEventListener('change', handleFileSelect, false);
  
    </script>