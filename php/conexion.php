<?php
    // define('DB_HOST','localhost');
    // define('DB_USER','root');
    // define('DB_PASS','betroox1229');
    // define('DB_NAME','mantencion');

    define('DB_HOST','sislanmysql.mysql.database.azure.com');
    define('DB_USER','dba@sislanmysql');
    define('DB_PASS','Sql747526');
    define('DB_NAME','mantencion');

    # conectare la base de datos
    function conectar(){
        $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $con->query("SET NAMES 'utf8'");
        if(!$con){
            die("imposible conectarse: ".mysqli_error($con));
        }
        else{ return $con;}
    }
?>