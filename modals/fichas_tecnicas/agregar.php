<form id="guardarDatos">
    <div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Ficha </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Tipo Ficha:</label>
                                <select name="tipo0" id="tipo0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_tipo_ficha()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_tipo_ficha']."'>".$columna['tipo']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0 d-none" id="fp1">
                                <label class="col-form-label">Equipos:</label>
                                <select name="equipos0" id="equipos0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_estado_equipos(1)";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_equipo']."'>".$columna['equipo']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" id="nombre0" name="nombre0" class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Uso:</label>
                                <input type="text" id="uso0" name="uso0" class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Documento:</label>
                                <input type="file" id="documento0" name="documento0" class="form-control" style="border-style:dashed;">
                            </div>
                        </div>
                    </div>
                    <output id="list"></output>
                    <div class="modal-footer pr-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>