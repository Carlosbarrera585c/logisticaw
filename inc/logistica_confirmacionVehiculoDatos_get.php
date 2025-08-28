<?php
include 'conn.php';
//include 'eas.php';
//$eas = new eas();

$nit = $_REQUEST['nit'];
$placa = $_REQUEST['placa'];

$sql = "SELECT        interAppCIL_ConfirmacionVehiculo.idConfirmacion, interAppCIL_ConfirmacionVehiculo.nit, interAppCIL_Transportadora.Transportadora, interAppCIL_ConfirmacionVehiculo.idTipoEnvio, interAppCIL_TipoEnvio.TipoEnvio, 
                         interAppCIL_ConfirmacionVehiculo.idCiudadOrigen, MTCDDAN.NOMCIUD AS CiudadOr, MTCDDAN_1.NOMCIUD AS CiudadDe, MTCDDAN_1.NOMDPTO AS DptoDe, MTCDDAN.NOMDPTO AS DptoOr, 
                         interAppCIL_ConfirmacionVehiculo.idCiudadDestino, interAppCIL_ConfirmacionVehiculo.idRuta, interAppCIL_Rutas.Ruta, interAppCIL_ConfirmacionVehiculo.placa, interAppCIL_Vehiculo.idTipoVehiculo, 
                         interAppCIL_ConfirmacionVehiculo.cedulaConductor, interAppCIL_Conductor.Nombre, interAppCIL_Conductor.Apellidos, interAppCIL_ConfirmacionVehiculo.horaEstimada, interAppCIL_ConfirmacionVehiculo.valorFlete, 
                         interAppCIL_ConfirmacionVehiculo.idMotivoMod, interAppCIL_MotivosPrecio.Motivo, interAppCIL_ConfirmacionVehiculo.horaAprob_Aseguradora, interAppCIL_TipoVehiculo.TipoVehiculo, interAppCIL_Vehiculo.id
FROM            interAppCIL_TipoVehiculo INNER JOIN
                         interAppCIL_Vehiculo ON interAppCIL_TipoVehiculo.idTipoVehiculo = interAppCIL_Vehiculo.idTipoVehiculo RIGHT OUTER JOIN
                         interAppCIL_ConfirmacionVehiculo INNER JOIN
                         interAppCIL_TipoEnvio ON interAppCIL_ConfirmacionVehiculo.idTipoEnvio = interAppCIL_TipoEnvio.idTipoEnvio LEFT OUTER JOIN
                         interAppCIL_Conductor ON interAppCIL_ConfirmacionVehiculo.cedulaConductor = interAppCIL_Conductor.CedulaConductor LEFT OUTER JOIN
                         interAppCIL_MotivosPrecio ON interAppCIL_ConfirmacionVehiculo.idMotivoMod = interAppCIL_MotivosPrecio.idMotivo ON interAppCIL_Vehiculo.Placa = interAppCIL_ConfirmacionVehiculo.placa LEFT OUTER JOIN
                         MTCDDAN ON interAppCIL_ConfirmacionVehiculo.idCiudadOrigen = MTCDDAN.CODIGO LEFT OUTER JOIN
                         MTCDDAN AS MTCDDAN_1 ON interAppCIL_ConfirmacionVehiculo.idCiudadDestino = MTCDDAN_1.CODIGO LEFT OUTER JOIN
                         interAppCIL_Rutas ON interAppCIL_ConfirmacionVehiculo.idRuta = interAppCIL_Rutas.idRuta LEFT OUTER JOIN
                         interAppCIL_Transportadora ON interAppCIL_ConfirmacionVehiculo.nit = interAppCIL_Transportadora.NitTransportadora
WHERE        (interAppCIL_ConfirmacionVehiculo.estado = 0) AND (interAppCIL_ConfirmacionVehiculo.nit = '".$nit."') AND (interAppCIL_ConfirmacionVehiculo.placa = '".$placa."') AND (interAppCIL_ConfirmacionVehiculo.cancelado = 0)";

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll();
$json = array();            
foreach ($results as $rs) {
                        //Capturamos Variables
	$json[] = array(		 
		'idVehiculo' => $rs['id'],
		'placa' => $rs['placa'],
		'cedula' => $rs['cedulaConductor'],
		'Conductor' =>  $rs['Nombre'].' '.$rs['Apellidos'],
		'idTipoVehiculo' => $rs['idTipoVehiculo'],
		'TipoVehiculo' => $rs['TipoVehiculo'],
		'Ruta' => $rs['Ruta'],
		'idTipoEnvio' => $rs['idTipoEnvio'],		
		'TipoEnvio' => $rs['TipoEnvio'],		 
	);
}
$jsonstring = json_encode($json);
echo $jsonstring;

?> 