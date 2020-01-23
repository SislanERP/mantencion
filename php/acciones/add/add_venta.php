<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    $venta = $_SESSION['n_venta'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");
    $consulta = "SELECT max(id_venta) as correlativo FROM venta";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    if(empty($_POST['tipo_descuento']))
    {
        if($_POST['tipo_pago'] == 1)
        {
            $query="INSERT INTO venta (id_venta,fecha,id_tipo_pago,id_usuario,subtotal,total,paga,vuelto) values($contador,'$fecha',$_POST[tipo_pago],$id_usuario,$_POST[subtotal],$_POST[total],$_POST[paga],$_POST[vuelto])";
            if (conectar()->query($query) === TRUE) 
            {
                $consulta = "SELECT * FROM temporal where id_venta=$venta";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                    $consulta1 = "SELECT max(id_registro) as correlativo FROM venta_detalle";
                    $resultado1 = mysqli_query( conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if ($columna = mysqli_fetch_array( $resultado1 ))
                    { 
                        $contador1 = $columna['correlativo'] + 1;
                    }
                    else
                    {
                        $contador1 = 1;
                    }

                    $query="INSERT INTO venta_detalle(id_registro,id_venta,codigo,cantidad) VALUES ($contador1,$columna1[id_venta],'$columna1[codigo]',$columna1[cantidad])";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $consulta1 = "SELECT * FROM productos where codigo='$columna1[codigo]'";
                        $resultado1 = mysqli_query(conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                        if ($columna2 = mysqli_fetch_array( $resultado1 ))
                        {
                            $stock = $columna2['stock'] - $columna1['cantidad'];
                            $query1="UPDATE productos SET stock=$stock WHERE codigo = '$columna1[codigo]'";
                            if (conectar()->query($query1) === TRUE) 
                            {
                            }
                        }
                    }
                }

                $query="delete from temporal where id_venta=$venta";
                if (conectar()->query($query) === TRUE) 
                {
                    echo "1";
                }
            }
        }
        else
        {
            $query="INSERT INTO venta (id_venta,fecha,id_tipo_pago,id_usuario,subtotal,total) values($contador,'$fecha',$_POST[tipo_pago],$id_usuario,$_POST[subtotal],$_POST[total])";
            if (conectar()->query($query) === TRUE) 
            {
                $consulta = "SELECT * FROM temporal where id_venta=$venta";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                    $consulta1 = "SELECT max(id_registro) as correlativo FROM venta_detalle";
                    $resultado1 = mysqli_query( conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if ($columna = mysqli_fetch_array( $resultado1 ))
                    { 
                        $contador1 = $columna['correlativo'] + 1;
                    }
                    else
                    {
                        $contador1 = 1;
                    }

                    $query="INSERT INTO venta_detalle(id_registro,id_venta,codigo,cantidad) VALUES ($contador1,$columna1[id_venta],'$columna1[codigo]',$columna1[cantidad])";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $consulta1 = "SELECT * FROM productos where codigo='$columna1[codigo]'";
                        $resultado1 = mysqli_query(conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                        if ($columna2 = mysqli_fetch_array( $resultado1 ))
                        {
                            $stock = $columna2['stock'] - $columna1['cantidad'];
                            $query1="UPDATE productos SET stock=$stock WHERE codigo = '$columna1[codigo]'";
                            if (conectar()->query($query1) === TRUE) 
                            {
                            }
                        }
                    }
                }

                $query="delete from temporal where id_venta=$venta";
                if (conectar()->query($query) === TRUE) 
                {
                    echo "1";
                }
            }
        }
        
    }
    else
    {
        if($_POST['tipo_pago'] == 1)
        {
            $query="INSERT INTO venta (id_venta,fecha,id_tipo_pago,id_usuario,subtotal,tipo_descuento,descuento,total,paga,vuelto) values($contador,'$fecha',$_POST[tipo_pago],$id_usuario,$_POST[subtotal],'$_POST[tipo_descuento]',$_POST[descuento],$_POST[total],$_POST[paga],$_POST[vuelto])";
            if (conectar()->query($query) === TRUE) 
            {
                $consulta = "SELECT * FROM temporal where id_venta=$venta";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                    $consulta1 = "SELECT max(id_registro) as correlativo FROM venta_detalle";
                    $resultado1 = mysqli_query( conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if ($columna = mysqli_fetch_array( $resultado1 ))
                    { 
                        $contador1 = $columna['correlativo'] + 1;
                    }
                    else
                    {
                        $contador1 = 1;
                    }

                    $query="INSERT INTO venta_detalle(id_registro,id_venta,codigo,cantidad) VALUES ($contador1,$columna1[id_venta],'$columna1[codigo]',$columna1[cantidad])";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $consulta1 = "SELECT * FROM productos where codigo='$columna1[codigo]'";
                        $resultado1 = mysqli_query(conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                        if ($columna2 = mysqli_fetch_array( $resultado1 ))
                        {
                            $stock = $columna2['stock'] - $columna1['cantidad'];
                            $query1="UPDATE productos SET stock=$stock WHERE codigo = '$columna1[codigo]'";
                            if (conectar()->query($query1) === TRUE) 
                            {
                            }
                        }
                    }
                }

                $query="delete from temporal where id_venta=$venta";
                if (conectar()->query($query) === TRUE) 
                {
                    echo "1";
                }
            }
        }
        else
        {
            $query="INSERT INTO venta (id_venta,fecha,id_tipo_pago,id_usuario,subtotal,tipo_descuento,descuento,total) values($contador,'$fecha',$_POST[tipo_pago],$id_usuario,$_POST[subtotal],'$_POST[tipo_descuento]',$_POST[descuento],$_POST[total])";
            if (conectar()->query($query) === TRUE) 
            {
                $consulta = "SELECT * FROM temporal where id_venta=$venta";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                    $consulta1 = "SELECT max(id_registro) as correlativo FROM venta_detalle";
                    $resultado1 = mysqli_query( conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                    if ($columna = mysqli_fetch_array( $resultado1 ))
                    { 
                        $contador1 = $columna['correlativo'] + 1;
                    }
                    else
                    {
                        $contador1 = 1;
                    }

                    $query="INSERT INTO venta_detalle(id_registro,id_venta,codigo,cantidad) VALUES ($contador1,$columna1[id_venta],'$columna1[codigo]',$columna1[cantidad])";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $consulta1 = "SELECT * FROM productos where codigo='$columna1[codigo]'";
                        $resultado1 = mysqli_query(conectar(), $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                        if ($columna2 = mysqli_fetch_array( $resultado1 ))
                        {
                            $stock = $columna2['stock'] - $columna1['cantidad'];
                            $query1="UPDATE productos SET stock=$stock WHERE codigo = '$columna1[codigo]'";
                            if (conectar()->query($query1) === TRUE) 
                            {
                            }
                        }
                    }
                }

                $query="delete from temporal where id_venta=$venta";
                if (conectar()->query($query) === TRUE) 
                {
                    echo "1";
                }
            }
        }
        
    }
?>