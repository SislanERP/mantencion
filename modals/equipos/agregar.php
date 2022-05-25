
<form id="guardarDatos">
    <div class="modal fade bd-example-modal-xl" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Equipo </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre0" id="nombre0" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Marca:</label>
                                <input type="text" class="form-control" name="marca0" id="marca0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Ubicación:</label>
                                <select name="ubicacion0" id="ubicacion0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_ubicaciones()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_registro']."'>".$columna['ubicacion']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Estado:</label>
                                <select name="estado0" id="estado0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_estado_equipo()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_registro']."'>".$columna['estado']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Características:</label>
                                <textarea name="caracteristicas0" id="caracteristicas0" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:100%;">
                                <img src="" alt="" class="position-absolute" id="imagenmuestra1" style="object-fit:cover;width:90%;height:90%;box-shadow: 10px 8px 20px #c3c3c3;border-style:dashed;">
                                <div class="image-upload">
                                    <label for="file-input">
                                        <i class="img-otros fas fa-camera-retro"></i>
                                    </label>

                                    <input type="file" name="imagen" id="file-input"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
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