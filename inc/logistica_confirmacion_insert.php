<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$placa = $_POST['txtPlaca'];
$idTipoVehiculo = $_POST['txtTipoVehiculo'];
$cedulaPropietario = $_POST['txtCedulaPropietario'];
$nombrePropietario = $_POST['txtPropietario'];
$FechaVencSOAT = $_POST['txtSoat'];
$FechaVencTECNO = $_POST['txtTecno'];
$CapacidadCargaTn = $_POST['txtPeso'];
$CapacidadVolumen = $_POST['txtVolumen'];



$sql = "INSERT INTO PruebaWilfred.dbo.interAppCIL_Vehiculo(Placa, idTipoVehiculo, cedulaPropietario, nombrePropietario , FechaVencSOAT, FechaVencTECNO, CapacidadCargaTn, CapacidadVolumen)
			VALUES     (?,?,?,?,?,?,?,?)";
$insertar = $pdo->prepare($sql);
try
{
	$insertar->execute([$placa, $idTipoVehiculo, $cedulaPropietario, $nombrePropietario, $FechaVencSOAT, $FechaVencTECNO, $CapacidadCargaTn, $CapacidadVolumen]);
	echo "VEHICULO CREADO CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_vehiculos.php');
	
}
catch(Exception $e)
{
	echo "No se pudo crear el Vehiculo. Error: ".$e;
	
}



//$sentencia = $pdo->prepare($sql);





?>