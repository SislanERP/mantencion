<?php
	session_start();
	require_once("../php/conexion.php");

    $id_usuario = $_SESSION['id_user'];
    $query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['usuario'], ENT_QUOTES)));
    $consulta = "call consulta_acceso_menu($query)";
    $resultado = mysqli_query(conectar(), $consulta );
?>
    
        <table class="table table-bordered" style="width:99%;">
            <thead class="thead-light">
                <tr>
                    <th>Menu</th>
                    <th class="text-center">Acceso</th>
                    <th class="text-center">Agregar</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                    while ($columna = mysqli_fetch_array( $resultado ))
                    {
                ?>
                            <tr>
                                <td>
                                    <i class="<?php echo $columna['icono']?>"></i>
                                    <?php echo $columna['menu'];?>

                                    <?php if($columna['acceso'] == 1){?>
                                        <td class="text-center"><input class="form-check-input ml-0 mt-2" type="checkbox" id="<?php echo $columna['id_menu']."1";?>" name="<?php echo $columna['id_menu']."1";?>" checked><label class="m-0 d-flex justify-content-center check" for="<?php echo $columna['id_menu']."1";?>"></label></td>
                                    <?php }else{?>
                                        <td class="text-center"><input class="form-check-input ml-0 mt-2" type="checkbox" id="<?php echo $columna['id_menu']."1";?>" name="<?php echo $columna['id_menu']."1";?>"><label class="m-0 d-flex justify-content-center check" for="<?php echo $columna['id_menu']."1";?>"></label></td>
                                    <?php }?>

                                    <?php if($columna['agregar'] == 1){?>
                                        <td class="text-center"><input class="form-check-input ml-0 mt-2" type="checkbox" id="<?php echo $columna['id_menu']."2";?>" name="<?php echo $columna['id_menu']."2";?>" checked><label class="m-0 d-flex justify-content-center check" for="<?php echo $columna['id_menu']."2";?>"></label></td>
                                    <?php }else{?>
                                        <td class="text-center"><input class="form-check-input ml-0 mt-2" type="checkbox" id="<?php echo $columna['id_menu']."2";?>" name="<?php echo $columna['id_menu']."2";?>"><label class="m-0 d-flex justify-content-center check" for="<?php echo $columna['id_menu']."2";?>"></label></td>
                                    <?php }?>

                                    <?php if($columna['editar'] == 1){?>
                                        <td class="text-center"><input class="form-check-input ml-0 mt-2" type="checkbox" id="<?php echo $columna['id_menu']."3";?>" name="<?php echo $columna['id_menu']."3";?>" checked><label class="m-0 d-flex justify-content-center check" for="<?php echo $columna['id_menu']."3";?>"></label></td>
                                    <?php }else{?>
                                        <td class="text-center"><input class="form-check-input ml-0 mt-2" type="checkbox" id="<?php echo $columna['id_menu']."3";?>" name="<?php echo $columna['id_menu']."3";?>"><label class="m-0 d-flex justify-content-center check" for="<?php echo $columna['id_menu']."3";?>"></label></td>
                                    <?php }?>
                                    

                                    <?php if($columna['eliminar'] == 1){?>
                                        <td class="text-center"><input class="form-check-input ml-0 mt-2" type="checkbox" id="<?php echo $columna['id_menu']."4";?>" name="<?php echo $columna['id_menu']."4";?>" checked><label class="m-0 d-flex justify-content-center check" for="<?php echo $columna['id_menu']."4";?>"></label></td>
                                    <?php }else{?>
                                        <td class="text-center"><input class="form-check-input ml-0 mt-2" type="checkbox" id="<?php echo $columna['id_menu']."4";?>" name="<?php echo $columna['id_menu']."4";?>"><label class="m-0 d-flex justify-content-center check" for="<?php echo $columna['id_menu']."4";?>"></label></td>
                                    <?php }?>
                            </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        