<?php
	session_start();
	require_once("../php/conexion.php");

    $id_usuario = $_SESSION['id_user'];
    $query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['usuario'], ENT_QUOTES)));
    
    function consulta_sub_menu($menu)
    {
        global $query;
        $consulta = "call consulta_acceso_sub_menu($menu,$query)";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        while ($columna = mysqli_fetch_array( $resultado ))
        { 
            echo    "<tr>
                        <td class='pl-5'>".$columna['submenu']."</td>";
                        if($columna['acceso'] == 1){
                            echo "<td class='text-center'><input class='form-check-input ml-0 mt-2' type='checkbox' id='".$columna['id_menu'].$columna['id_registro']."1' name='".$columna['id_menu'].$columna['id_registro']."1' checked><label class='m-0 d-flex justify-content-center check' for='".$columna['id_menu'].$columna['id_registro']."1'></label></td>";
                        }
                        else{
                            echo "<td class='text-center'><input class='form-check-input ml-0 mt-2' type='checkbox' id='".$columna['id_menu'].$columna['id_registro']."1' name='".$columna['id_menu'].$columna['id_registro']."1'><label class='m-0 d-flex justify-content-center check' for='".$columna['id_menu'].$columna['id_registro']."1'></label></td>";
                        }

                        if($columna['agregar'] == 1){
                            echo "<td class='text-center'><input class='form-check-input ml-0 mt-2' type='checkbox' id='".$columna['id_menu'].$columna['id_registro']."2' name='".$columna['id_menu'].$columna['id_registro']."2' checked><label class='m-0 d-flex justify-content-center check' for='".$columna['id_menu'].$columna['id_registro']."2'></label></td>";
                        }
                        else{
                            echo "<td class='text-center'><input class='form-check-input ml-0 mt-2' type='checkbox' id='".$columna['id_menu'].$columna['id_registro']."2' name='".$columna['id_menu'].$columna['id_registro']."2' ><label class='m-0 d-flex justify-content-center check' for='".$columna['id_menu'].$columna['id_registro']."2'></label></td>";                       
                        }

                        if($columna['editar'] == 1){
                            echo "<td class='text-center'><input class='form-check-input ml-0 mt-2' type='checkbox' id='".$columna['id_menu'].$columna['id_registro']."3' name='".$columna['id_menu'].$columna['id_registro']."3' checked><label class='m-0 d-flex justify-content-center check' for='".$columna['id_menu'].$columna['id_registro']."3'></label></td>";
                        }
                        else{
                            echo "<td class='text-center'><input class='form-check-input ml-0 mt-2' type='checkbox' id='".$columna['id_menu'].$columna['id_registro']."3' name='".$columna['id_menu'].$columna['id_registro']."3' ><label class='m-0 d-flex justify-content-center check' for='".$columna['id_menu'].$columna['id_registro']."3'></label></td>";
                        }
                        

                        if($columna['eliminar'] == 1){
                            echo "<td class='text-center'><input class='form-check-input ml-0 mt-2' type='checkbox' id='".$columna['id_menu'].$columna['id_registro']."4' name='".$columna['id_menu'].$columna['id_registro']."4' checked><label class='m-0 d-flex justify-content-center check' for='".$columna['id_menu'].$columna['id_registro']."4'></label></td>";
                        }
                        else{
                            echo "<td class='text-center'><input class='form-check-input ml-0 mt-2' type='checkbox' id='".$columna['id_menu'].$columna['id_registro']."4' name='".$columna['id_menu'].$columna['id_registro']."4' ><label class='m-0 d-flex justify-content-center check' for='".$columna['id_menu'].$columna['id_registro']."4'></label></td>";
                        }
                echo   "</tr>";
        }
    }

    function consulta_existe_sub_menu($menu)
    {
        $consulta = "call consulta_sub_menu($menu)";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        $count = mysqli_num_rows($resultado);
        return $count;
    }

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
                        if($columna['id_menu'] == 9 || $columna['id_menu'] == 8){}
                        else
                        {
                ?>
                            <tr>
                                <td>
                                    <img width="35px" height="35px" src="<?php echo $columna['icono']?>" alt="">
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
                                    
                                    <?php
                                        if(consulta_existe_sub_menu($columna['id_menu']) > 0)
                                        {
                                            consulta_sub_menu($columna['id_menu']);
                                        }
                                    ?>
                            </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
        