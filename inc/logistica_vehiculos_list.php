<?php
include 'conn.php';
//include 'eas.php';
//$eas = new eas();
$sql = "SELECT         interAppCIL_Vehiculo.id, interAppCIL_Vehiculo.Placa,interAppCIL_TipoVehiculo.idTipoVehiculo, interAppCIL_TipoVehiculo.TipoVehiculo, interAppCIL_Vehiculo.cedulaPropietario, interAppCIL_Vehiculo.nombrePropietario, interAppCIL_Vehiculo.FechaVencSOAT, 
                         interAppCIL_Vehiculo.FechaVencTECNO, interAppCIL_Vehiculo.CapacidadCargaTn, interAppCIL_Vehiculo.CapacidadVolumen
						FROM           PruebaWilfred.dbo.interAppCIL_Vehiculo INNER JOIN
                         PruebaWilfred.dbo.interAppCIL_TipoVehiculo ON interAppCIL_Vehiculo.idTipoVehiculo = interAppCIL_TipoVehiculo.idTipoVehiculo";

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
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
                  