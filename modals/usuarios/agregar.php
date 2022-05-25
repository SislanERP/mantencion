<form id="guardarDatos">
    <div class="modal fade bd-example-modal" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre0" id="nombre0" required>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Correo:</label>
                                <input type="email" class="form-control" name="correo0" id="correo0" required>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Perfil:</label>
                                <select name="perfil0" id="perfil0" class="selectpicker form-control" data-live-search="true" title="SELECCIONAR PERFIL" required>
                                    <?php 
                                        $consulta = "call consulta_perfil()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_registro']."'>".$columna['perfil']."</option>";   
                                        }
                                    ?>
                                </select>
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