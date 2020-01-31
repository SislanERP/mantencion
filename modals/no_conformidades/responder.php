<form id="Responder">
    <div class="modal fade" id="dataResponder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Responder No Conformidad </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row e12">
                        <div class="col-6 e5">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Descripción / Consecuencia / Alcance:</label>
                                        <textarea name="desviacion1" id="desviacion1" cols="30" rows="3" class="form-control" readonly></textarea>
                                        <input type="hidden" id="id1" name="id1">
                                        <input type="hidden" id="area" name="area">
                                        <input type="hidden" id="depa" name="depa">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Causa Raíz:</label>
                                        <textarea name="causa1" id="causa1" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Acciones Correctivas:</label>
                                        <textarea name="correctivo1" id="correctivo1" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Acciones Preventivas:</label>
                                        <textarea name="preventivo1" id="preventivo1" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Responsable Ejecución</label>
                                        <input type="text" id="responsable1" name="responsable1" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Fecha Ejecución</label>
                                        <input type="date" id="ejecucion1" name="ejecucion1" class="form-control" value="<?php echo date("Y-m-d");?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="blo">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Estado</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="radio" id="inlineCheckbox1" value="0" name="radio" style="margin-top:10px !important;">
                                        <label class="form-check-label" for="inlineCheckbox1">En Proceso</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-5">
                                        <input class="form-check-input" type="radio" id="inlineCheckbox2" value="1" name="radio" style="margin-top:10px !important;">
                                        <label class="form-check-label" for="inlineCheckbox2">Terminado</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0">
                                        <label class="col-form-label">Seguimiento / Observaciones:</label>
                                        <textarea name="observaciones1" id="observaciones1" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-0" id="esta">
                                <label class="col-form-label">Estado:</label>
                                <select name="estado" id="estado" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_int_estado_calidad()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_estado']."'>".$columna['estado']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-6 e5">
                            <div class="col-12 e5">
                                <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:300px;">
                                    <img src="" alt="" class="pt-3 rounded-circle position-absolute" id="img" style="object-fit:cover;width:280px;height:300px;">
                                    <div class="image-upload">
                                        <label for="img-edit">
                                            <img src="img/iconos/camara.svg" id="im1"/> 
                                        </label>

                                        <input type="file" name="imagen" id="img-edit"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 e5">
                                <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:300px;">
                                    <img src="" alt="" class="pt-3 rounded-circle position-absolute" id="img1" style="object-fit:cover;width:280px;height:300px;">
                                    <div class="image-upload">
                                        <label for="img-edit1">
                                            <img src="img/iconos/camara.svg" id="im2"/> 
                                        </label>

                                        <input type="file" name="imagen1" id="img-edit1"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <output id="list"></output>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary" id="bot">Responder No Conformidad</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>