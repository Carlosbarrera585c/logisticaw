<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$placa = $_POST['updatePlaca'];
$tipo = $_POST['updateTipoVehiculo'];
$cedula = $_POST['updateCedulaPropietario'];
$propietario = $_POST['updatePropietario'];
$soat = $_POST['updateSoat'];
$tecno = $_POST['updateTecno'];
$peso = $_POST['updatePeso'];
$volumen = $_POST['updateVolumen'];

$sql = "UPDATE PruebaWilfred.dbo.interAppCIL_Vehiculo
SET idTipoVehiculo = ?, cedulaPropietario = ?, nombrePropietario = ?, FechaVencSOAT = ?, FechaVencTECNO = ?, CapacidadCargaTn = ?, CapacidadVolumen =?
WHERE        (Placa = ?)";

$actualizar = $pdo->prepare($sql);
try
{
	$actualizar->execute([$tipo, $cedula, $propietario, $soat, $tecno, $peso, $volumen, $placa]);

	echo "VEHICULO ACTUALIZADO CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_vehiculos.php');
	
}
catch(Exception $e)
{
	echo "No se pudo Actualizar el Vehiculo. Error: ".$e;
	
}



?>