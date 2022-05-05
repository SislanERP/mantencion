<form id="actualidarDatos">
    <div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Día Libre </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Trabajador:</label>
                                <select name="trabajador" id="trabajador" class="selectpicker form-control" data-live-search="true" disabled>
                                    <?php 
                                        $consulta = "call consulta_trabajadores()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_usuario']."'>".$columna['nombre']."</option>";
                                        }
                                    ?>
                                </select>
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha Trabajada:</label>
                                <input type="date" id="fecha_trabajada" name="fecha_trabajada" class="form-control" disabled>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha Pagada:</label>
                                <input type="date" id="fecha_pagada" name="fecha_pagada" class="form-control" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                    </div>
                    <output id="list"></output>
                    <div class="modal-footer pr-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>