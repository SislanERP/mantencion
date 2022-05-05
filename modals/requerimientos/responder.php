
<form id="Responder">
    <div class="modal fade bd-example-modal-xl" id="dataResponder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Responder Requerimiento </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row e12">
                        <div class="col-sm-12 col-lg-7">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Actividad:</label>
                                <textarea name="actividad1" id="actividad1" cols="30" rows="3" class="form-control" required></textarea>
                                <input type="hidden" id="id1" name="id1">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Prioridad:</label>
                                <select name="prioridad1" id="prioridad1" class="selectpicker form-control" data-live-search="true">
                                <?php
                                    $consulta = "call  consulta_prioridades()";
                                    $resultado = mysqli_query(conectar(), $consulta );
                                    while ($columna = mysqli_fetch_array( $resultado ))
                                    { 
                                    echo    "<option value='".$columna['id_prioridad']."'>".$columna['prioridad']."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Responsable:</label>
                                <select name="responsable1" id="responsable1" class="selectpicker form-control" data-live-search="true">
                                <?php
                                    $consulta = "call  consulta_trabajadores()";
                                    $resultado = mysqli_query(conectar(), $consulta );
                                    while ($columna = mysqli_fetch_array( $resultado ))
                                    { 
                                    echo    "<option value='".$columna['id_trabajador']."'>".$columna['nombre']."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Desarrollo:</label>
                                <textarea name="desarrollo1" id="desarrollo1" cols="30" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Estado:</label>
                                <select name="estado1" id="estado1" class="selectpicker form-control" data-live-search="true">
                                <?php
                                    $consulta = "call   consulta_estados()";
                                    $resultado = mysqli_query(conectar(), $consulta );
                                    while ($columna = mysqli_fetch_array( $resultado ))
                                    { 
                                    echo    "<option value='".$columna['id_estado']."'>".$columna['estado']."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="row" id="blo">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Finalizado?</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="radio" id="inlineCheckbox1" value="0" name="radio">
                                        <label class="form-check-label" for="inlineCheckbox1">NO</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-5">
                                        <input class="form-check-input" type="radio" id="inlineCheckbox2" value="1" name="radio">
                                        <label class="form-check-label" for="inlineCheckbox2">SI</label>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-sm-12 col-lg-4">
                            <h3 class="mb-4 pb-3">Imagen referencial</h3>
                            <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:300px;">
                                <a data-fancybox="gallery" href="#" id="img-href" style="display: contents;"><img src="" alt="" class="position-absolute" id="imagenmuestra1" style="object-fit:cover;width:100%;height:300px;border-style:dashed;"></a>
                                <div class="image-upload">
                                    <label for="file-input-responder">
                                        <i class="img-otros fas fa-camera-retro"></i>
                                    </label>

                                    <input type="file" name="imagen" id="file-input-responder" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3 pr-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary" id="esta">Responder Requerimiento</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>