<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$nit = $_REQUEST['nit'];
$tipo = $_REQUEST['tipo'];
$ciudadO = $_REQUEST['ciudadO'];
$ciudadD = $_REQUEST['ciudadD'];


$sql = "DELETE FROM PruebaWilfred.dbo.interAppCIL_FleteXTransportadora
WHERE        (nitTransp = ?) AND (idTipoEnvio = ?) AND (CiudadOrigen = ?) AND (CiudadDestino = ?)";
$eliminar = $pdo->prepare($sql);
try
{
	$eliminar->execute([$nit, $tipo, $ciudadO, $ciudadD]);
	echo "FLETE ELIMINADO CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_fletesxtransportadora.php');
	
}
catch(Exception $e)
{
	echo "No se pudo eliminar el Conductor. Error: ".$e;
	
}

?>