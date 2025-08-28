<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$cedula = $_POST['updateCedula'];
$nombre = $_POST['updateNombre'];
$apellidos = $_POST['updateApellidos'];
$telefono = $_POST['updateTel'];
$licencia = $_POST['updateNumLicencia'];
$fechaVenLicencia = $_POST['updateFechaVencLicencia'];
$valorMulta = $_POST['updateValorMultas'];


$sql = "UPDATE PruebaWilfred.dbo.interAppCIL_Conductor
SET                Nombre = ?, Apellidos = ?, Telefono = ?, LicenciaNro = ?, FechaVencLicencia = ?, ValorMultas = ?
WHERE        (CedulaConductor = ?)";

$actualizar = $pdo->prepare($sql);
try
{
	$actualizar->execute([$nombre, $apellidos, $telefono, $licencia, $fechaVenLicencia, $valorMulta, $cedula]);
	echo "CONDUCTOR ACTUALIZADO CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_conductores.php');
	
}
catch(Exception $e)
{
	echo "No se pudo Actualizar el Conductor. Error: ".$e;
	
}



//$sentencia = $pdo->prepare($sql);





?>