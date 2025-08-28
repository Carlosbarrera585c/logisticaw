<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();


$nroProg = $_REQUEST['nroProg'];

$sql = "SELECT        interAppCIL_Corte.Nro_Doc AS Documento, interAppCIL_Corte.Empresa, interAppCIL_Corte.Nombre_Cliente AS Cliente, interAppCIL_Corte.CIUDADCLI AS Destino, interAppCIL_Corte.DIR AS Direccion, 
                         interAppCIL_Corte.Nota_Encabezado AS Observacion, SUM(interAppCIL_Corte.Cantidad) AS Cantidad, SUM(interAppCIL_Corte.Total_Prod) AS Valorizado, interAppCIL_Corte.Transportadora AS nit, interAppCIL_Corte.Vehiculo, 
                         interAppCIL_Corte.idTipoVehiculo, interAppCIL_Corte.idTipoEnvio, interAppCIL_Corte.idEstadoProgramacion AS idEstado, interAppCIL_Corte.Conductor AS cedula, interAppCIL_Rutas.Ruta, 
                         interAppCIL_Transportadora.Transportadora, interAppCIL_TipoEnvio.TipoEnvio, interAppCIL_TipoVehiculo.TipoVehiculo, interAppCIL_Vehiculo.id, interAppCIL_Conductor.Nombre, interAppCIL_Conductor.Apellidos
FROM            interAppCIL_TipoEnvio RIGHT OUTER JOIN
                         interAppCIL_TipoVehiculo RIGHT OUTER JOIN
                         interAppCIL_Vehiculo RIGHT OUTER JOIN
                         interAppCIL_Corte INNER JOIN
                         interAppCIL_Conductor ON interAppCIL_Corte.Conductor = interAppCIL_Conductor.CedulaConductor ON interAppCIL_Vehiculo.Placa = interAppCIL_Corte.Vehiculo ON 
                         interAppCIL_TipoVehiculo.idTipoVehiculo = interAppCIL_Corte.idTipoVehiculo ON interAppCIL_TipoEnvio.idTipoEnvio = interAppCIL_Corte.idTipoEnvio LEFT OUTER JOIN
                         interAppCIL_Transportadora ON interAppCIL_Corte.Transportadora = interAppCIL_Transportadora.NitTransportadora LEFT OUTER JOIN
                         interAppCIL_ConfirmacionVehiculo ON interAppCIL_Corte.Vehiculo = interAppCIL_ConfirmacionVehiculo.placa LEFT OUTER JOIN
                         interAppCIL_Rutas ON interAppCIL_ConfirmacionVehiculo.idRuta = interAppCIL_Rutas.idRuta
WHERE        (interAppCIL_Corte.NroProgramacion = '".$nroProg."')
GROUP BY interAppCIL_Corte.Nro_Doc, interAppCIL_Corte.Empresa, interAppCIL_Corte.Nombre_Cliente, interAppCIL_Corte.CIUDADCLI, interAppCIL_Corte.DIR, interAppCIL_Corte.Nota_Encabezado, interAppCIL_Corte.Transportadora, 
                         interAppCIL_Corte.Vehiculo, interAppCIL_Corte.idTipoVehiculo, interAppCIL_Corte.idTipoEnvio, interAppCIL_Corte.idEstadoProgramacion, interAppCIL_Corte.Conductor, interAppCIL_Rutas.Ruta, 
                         interAppCIL_Transportadora.Transportadora, interAppCIL_TipoEnvio.TipoEnvio, interAppCIL_TipoVehiculo.TipoVehiculo, interAppCIL_Vehiculo.id, interAppCIL_Conductor.Nombre, interAppCIL_Conductor.Apellidos";

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

$json = array();            
foreach ($results as $rs) {
                       
	$json["data"][] = array(
		'Documento' => $rs['Documento'],
		'Cliente' => $rs['Cliente'],
		 'Destino' => $rs['Destino'],
		 'Direccion' => $rs['Direccion'],
		'Observacion' => $rs['Observacion'],
		 'Cantidad' => $rs['Cantidad'],		 
		 'Valorizado' => '$'.number_format($rs['Valorizado'], 0,  "", ","),
		 'Transportadora' => $rs['Transportadora'],
		 'nit' => $rs['nit'],
		 'idVehiculo' => $rs['id'],
		 'Vehiculo' => $rs['Vehiculo'],
		 'idTipoVehiculo' => $rs['idTipoVehiculo'],
		 'TipoVehiculo' => $rs['TipoVehiculo'],
		'idTipoEnvio' => $rs['idTipoEnvio'],
		'TipoEnvio' => $rs['TipoEnvio'],
		'cedula' => $rs['cedula'],
		 'Conductor' => $rs['Nombre'].' '.$rs['Apellidos'],
		 'idEstado' => $rs['idEstado'],
		 'Ruta' => $rs['Ruta']		

	);
}

$jsonstring = json_encode($json);
//$jsonstring = json_encode($destino);
echo $jsonstring;

?>
                  