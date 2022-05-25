<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $consulta = "call consulta_menu()";
    $result = mysqli_query(conectar(), $consulta );
    $contador = 1;
    $contador1 = 1;
    $test = array();
    $test1 = array();
    
    while ($campo = mysqli_fetch_array( $result ))
    {
        
        while($contador <= 4)
        {
            $correlativo = $campo['id_menu'].$contador;
            if(empty($_POST[$correlativo])){$_POST[$correlativo]=0;}else{$_POST[$correlativo]=1;}
            $test[$contador] = $_POST[$correlativo];
            $contador = $contador + 1;
        }

        $consulta = "SELECT * from accesos where id_usuario_acceso = $_POST[usuario] and id_menu = $campo[id_menu]";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        {
            $query="UPDATE accesos SET acceso=$test[1],agregar=$test[2],editar=$test[3],eliminar=$test[4],fec_edicion='$fecha',id_usuario_edicion=$id_usuario where id_usuario_acceso=$_POST[usuario] and id_menu = $columna[id_menu]";
            if (conectar()->query($query) === TRUE) {
                $messages[] = "Acceso guardado satisfactoriamente.";
            }
            else
            {
                   $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
            }
        }
        else
        {
            $consulta = "SELECT max(id_registro) as correlativo FROM accesos";
            $resultado = mysqli_query( conectar(), $consulta );
            if ($columna = mysqli_fetch_array( $resultado ))
            { 
                $id = $columna['correlativo'] + 1;
            }
            else
            {
                $id = 1;
            }

            $query="INSERT INTO accesos (id_registro,id_usuario_acceso,id_menu,acceso,agregar,editar,eliminar,fec_registro,id_usuario_registro) VALUES($id,$_POST[usuario],$campo[id_menu],$test[1],$test[2],$test[3],$test[4],'$fecha',$id_usuario)";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Acceso guardado satisfactoriamente.";
            }

            else
            {
                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
            }
        }

        $contador = 1;
    }    

    if (isset($errors)){
			
        ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> 
                    Lo siento algo ha salido mal intenta nuevamente.
            </div>
            <?php
            }
            if (isset($messages)){
                
                ?>
                <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Bien hecho!</strong>
                        Acceso guardado satisfactoriamente.
                </div>
                <?php
            }

    
?>