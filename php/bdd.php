<?php
try
{
        //$bdd = new PDO('mysql:host=localhost;dbname=mantencion;charset=utf8', 'root', 'betroox1229');
        $bdd = new PDO('mysql:host=sislanmysql.mysql.database.azure.com;dbname=mantencion;charset=utf8', 'dba@sislanmysql', 'Sql747526');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
