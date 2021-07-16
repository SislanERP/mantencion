<form id="CopiarEquipo">
    <div class="modal fade" id="dataCopiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Copiar este equipo:</label>
                                <select name="e_copiar" id="e_copiar" class="selectpicker form-control" data-live-search="true">
                                <?php 
                                    $consulta = "call consulta_equipos()";
                                    $resultado = mysqli_query(conectar(), $consulta );
                                    while ($columna = mysqli_fetch_array( $resultado ))
                                    { 
                                        echo    "<option value='".$columna['id_equipo']."'>".$columna['equipo']."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">A este equipo:</label>
                                <select name="e_pegar" id="e_pegar" class="selectpicker form-control" data-live-search="true">
                                <?php 
                                    $consulta = "call consulta_equipos()";
                                    $resultado = mysqli_query(conectar(), $consulta );
                                    while ($columna = mysqli_fetch_array( $resultado ))
                                    { 
                                        echo    "<option value='".$columna['id_equipo']."'>".$columna['equipo']."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Copiar equipo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>