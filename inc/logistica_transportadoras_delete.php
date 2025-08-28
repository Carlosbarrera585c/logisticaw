<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$nit = $_REQUEST['Nit'];


$sql = "DELETE FROM PruebaWilfred.dbo.interAppCIL_Transportadora
WHERE        (NitTransportadora = ?)";
$eliminar = $pdo->prepare($sql);
try
{
	$eliminar->execute([$nit]);
	echo "TRANSPORTADORA ELIMINADA CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_transportadoras.php');
	
}
catch(Exception $e)
{
	echo "No se pudo eliminar el Vehiculo. Error: ".$e;
	
}



//$sentencia = $pdo->prepare($sql);





?>