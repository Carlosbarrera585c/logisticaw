<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$placa = $_REQUEST['placa'];


$sql = "DELETE FROM PruebaWilfred.dbo.interAppCIL_Vehiculo
WHERE  Placa = ?";
$eliminar = $pdo->prepare($sql);
try
{
	$eliminar->execute([$placa]);
	echo "VEHICULO ELIMINADO CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_vehiculos.php');
	
}
catch(Exception $e)
{
	echo "No se pudo eliminar el Vehiculo. Error: ".$e;
	
}



//$sentencia = $pdo->prepare($sql);





?>