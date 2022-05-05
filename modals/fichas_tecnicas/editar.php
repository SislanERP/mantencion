<form id="actualidarDatos">
    <div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Ficha </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Tipo Ficha:</label>
                                <select name="tipo" id="tipo" class="selectpicker form-control" data-live-search="true">
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
                            <div class="form-group mb-0">
                                <label class="col-form-label">Uso:</label>
                                <input type="text" id="uso" name="uso" class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Documento:</label>
                                <input type="file" id="documento" name="documento" class="form-control" style="border-style:dashed;">
                            </div>
                        </div>
                    </div>
                    <output id="list"></output>
                    <div class="modal-footer pr-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Editar Ficha</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>