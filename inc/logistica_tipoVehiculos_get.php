<?php
include 'conn.php';
//include 'eas.php';
//$eas = new eas();

$id = $_REQUEST['id'];

$sql = "SELECT         interAppCIL_Vehiculo.id, interAppCIL_Vehiculo.Placa,interAppCIL_TipoVehiculo.idTipoVehiculo, interAppCIL_TipoVehiculo.TipoVehiculo, interAppCIL_Vehiculo.cedulaPropietario, interAppCIL_Vehiculo.nombrePropietario, interAppCIL_Vehiculo.FechaVencSOAT, 
interAppCIL_Vehiculo.FechaVencTECNO, interAppCIL_Vehiculo.CapacidadCargaTn, interAppCIL_Vehiculo.CapacidadVolumen
FROM           PruebaWilfred.dbo.interAppCIL_Vehiculo INNER JOIN
PruebaWilfred.dbo.interAppCIL_TipoVehiculo ON interAppCIL_Vehiculo.idTipoVehiculo = interAppCIL_TipoVehiculo.idTipoVehiculo
WHERE        interAppCIL_Vehiculo.id = ".$id;

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll();
$json = array();            
foreach ($results as $rs) {
                        //Capturamos Variables
	$json[] = array(		 
		 'id' => $rs['id'],
		 'placa' => $rs['Placa'],
		 'idtipo' => $rs['idTipoVehiculo'],
		 'tipo' => $rs['TipoVehiculo'],
		 'cedula' => $rs['cedulaPropietario'],
		 'propietario' => $rs['nombrePropietario'],
		 'fechaSoat' => $rs['FechaVencSOAT'],
		 'fechaTecno' => $rs['FechaVencTECNO'],
		 'capacidadTn' => $rs['CapacidadCargaTn'],
		 'capacidadVl' => $rs['CapacidadVolumen']		 
	);
}
$jsonstring = json_encode($json);
echo $jsonstring;

?>              