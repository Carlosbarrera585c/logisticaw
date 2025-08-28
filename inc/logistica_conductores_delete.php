<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$id = $_REQUEST['id'];

/*
//Mostramos Variables
echo '<br>CEDULA:  '.$cedula;
echo '<br>NOMBRE:  '.$nombre;
echo '<br>APELLIDOS:  '.$apellidos;
echo '<br>TELEFONO:  '.$telefono;
echo '<br>NUMERO LICENCIA:  '.$licencia;
echo '<br>FECHA VENCIMIENTO:  '.$fechaVenLicencia;
echo '<br>VALOR MULTAS:  '.$valorMulta;
*/
$sql = "DELETE FROM PruebaWilfred.dbo.interAppCIL_Conductor
WHERE  id = ?";
$eliminar = $pdo->prepare($sql);
try
{
	$eliminar->execute([$id]);
	echo "CONDUCTOR ELIMINADO CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_conductores.php');
	
}
catch(Exception $e)
{
	echo "No se pudo eliminar el Conductor. Error: ".$e;
	
}



//$sentencia = $pdo->prepare($sql);





?>