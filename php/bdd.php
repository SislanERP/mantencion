<?php
try
{
	$bdd = new PDO('mysql:host=sislanmysql.mysql.database.azure.com;dbname=mantencion;charset=utf8', 'dba@sislanmysql', 'Sql747526');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
