<form id="actualidarDatos">
    <div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row e12">
                        <div class="col-6 e5">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo date("Y-m-d");?>">
                                <input type="hidden" id="id" name="id">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Área:</label>
                                <select name="area" id="area" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_areas()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_area']."'>".$columna['area']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Producto:</label>
                                <select name="producto" id="producto" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_productos()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_producto']."'>".$columna['producto']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fase del proceso:</label>
                                <select name="fase" id="fase" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_fases()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_fase']."'>".$columna['fase']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Detectado Por:</label>
                                <select name="detector" id="detector" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_detectores()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_personal']."'>".$columna['nombre']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Descripción de la desviación:</label>
                                <textarea name="desviacion" id="desviacion" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-6 e5">
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
                    <output id="list"></output>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Editar No Conformidad</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>