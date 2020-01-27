<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mantencion;charset=utf8', 'root', 'betroox1229');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
