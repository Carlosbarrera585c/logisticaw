<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$cedula = $_POST['txtCedula'];
$nombre = $_POST['txtNombre'];
$apellidos = $_POST['txtApellidos'];
$telefono = $_POST['txtTel'];
$licencia = $_POST['txtNumLicencia'];
$fechaVenLicencia = $_POST['txtFechaVencLicencia'];
$valorMulta = $_POST['txtValorMultas'];

$sql = "INSERT INTO PruebaWilfred.dbo.interAppCIL_Conductor(CedulaConductor, Nombre, Apellidos, Telefono, LicenciaNro, FechaVencLicencia, ValorMultas)
VALUES(?,?,?,?,?,?,?)";
$insertar = $pdo->prepare($sql);
try
{
	$insertar->execute([$cedula, $nombre, $apellidos, $telefono, $licencia, $fechaVenLicencia, $valorMulta]);
	echo "CONDUCTOR CREADO CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_conductores.php');
	
}
catch(Exception $e)
{
	echo "No se pudo crear el Conductor. Error: ".$e;
	
}



//$sentencia = $pdo->prepare($sql);





?>