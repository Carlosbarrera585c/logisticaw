<?php
include 'inc/conn.php';
include 'eas.php';
$eas = new eas();

try
{
	
	

	//Getting records (listAction)
	if($_GET["accion"] == "listar")
	{
		//Get records from database
		$sql = "SELECT        interAppCIL_ConfirmacionVehiculo.idConfirmacion, interAppCIL_ConfirmacionVehiculo.horaConfirma, interAppCIL_ConfirmacionVehiculo.placa, interAppCIL_ConfirmacionVehiculo.horaEstimada, 
                         interAppCIL_ConfirmacionVehiculo.valorFlete, interAppCIL_ConfirmacionVehiculo.horaAprob_Aseguradora, interAppCIL_Transportadora.Transportadora, interAppCIL_TipoEnvio.TipoEnvio, MTCDDAN.NOMCIUD AS CiudadOr, 
                         MTCDDAN_1.NOMCIUD AS CiudadDe, MTCDDAN_1.NOMDPTO AS DptoDe, interAppCIL_TipoVehiculo.TipoVehiculo, interAppCIL_Conductor.Nombre, interAppCIL_Conductor.Apellidos, interAppCIL_Conductor.Telefono, 
                         interAppCIL_MotivosPrecio.Motivo, interAppCIL_Rutas.Ruta
FROM            interAppCIL_ConfirmacionVehiculo LEFT OUTER JOIN
                         interAppCIL_Rutas ON interAppCIL_ConfirmacionVehiculo.idRuta = interAppCIL_Rutas.idRuta LEFT OUTER JOIN
                         interAppCIL_Conductor ON interAppCIL_ConfirmacionVehiculo.cedulaConductor = interAppCIL_Conductor.CedulaConductor LEFT OUTER JOIN
                         interAppCIL_MotivosPrecio ON interAppCIL_ConfirmacionVehiculo.idMotivoMod = interAppCIL_MotivosPrecio.idMotivo LEFT OUTER JOIN
                         interAppCIL_Vehiculo ON interAppCIL_ConfirmacionVehiculo.placa = interAppCIL_Vehiculo.Placa LEFT OUTER JOIN
                         interAppCIL_TipoVehiculo ON interAppCIL_Vehiculo.idTipoVehiculo = interAppCIL_TipoVehiculo.idTipoVehiculo LEFT OUTER JOIN
                         interAppCIL_TipoEnvio ON interAppCIL_ConfirmacionVehiculo.idTipoEnvio = interAppCIL_TipoEnvio.idTipoEnvio LEFT OUTER JOIN
                         MTCDDAN AS MTCDDAN_1 ON interAppCIL_ConfirmacionVehiculo.idCiudadDestino = MTCDDAN_1.CODIGO LEFT OUTER JOIN
                         MTCDDAN ON interAppCIL_ConfirmacionVehiculo.idCiudadOrigen = MTCDDAN.CODIGO LEFT OUTER JOIN
                         interAppCIL_Transportadora ON interAppCIL_ConfirmacionVehiculo.nit = interAppCIL_Transportadora.NitTransportadora
WHERE        (interAppCIL_ConfirmacionVehiculo.fechaConfirma = GETDATE())
ORDER BY interAppCIL_ConfirmacionVehiculo.idConfirmacion";
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		$json = array();            
		foreach ($results as $rs) {
                        //Capturamos Variables
			$json[] = array(
				'id' => $rs['idConfirmacion'],
				'fecha' => $rs['fechaConfirma'],
				'horaConfirma' => $rs['horaConfirma'],				
				'Transportadora' => $rs['Transportadora'],				
				'TipoEnvio' => $rs['TipoEnvio'],				
				'CiudadOr' => $rs['CiudadOr'], 				
				'CiudadDe' => $rs['CiudadDe'],
				'DptoDe' => $rs['DptoDe'],		
				'Ruta' => $rs['Ruta'],
				'placa' => $rs['placa'],				
				'TipoVehiculo' => $rs['TipoVehiculo'],				
				'Nombre' => $rs['Nombre'],		
				'Apellidos' => $rs['Apellidos'],
				'horaEstimada' => $rs['horaEstimada'],
				'valorFlete' => $rs['valorFlete'],				
				'MotivoMod' => $rs['Motivo'],
				'horaAprob_Aseguradora' => $rs['horaAprob_Aseguradora']
			);
		}
		$jsonstring = json_encode($json);
		echo $jsonstring;
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "crear")
	{
		//Insert record into database

		$sql = "INSERT INTO PruebaWilfred.dbo.interAppCIL_Conductor(CedulaConductor, Nombre, Apellidos, Telefono, LicenciaNro, FechaVencLicencia, ValorMultas)
VALUES(?,?,?,?,?,?,?)";
$insertar = $pdo->prepare($sql);
try
{
	$insertar->execute([$cedula, $nombre, $apellidos, $telefono, $licencia, $fechaVenLicencia, $valorMulta]);
	echo "CONDUCTOR CREADO CORRECTAMENTE";
	
}
catch(Exception $e)
{
	echo "No se pudo crear el Conductor. Error: ".$e;
	
}
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM interAppCIL_Conductor WHERE CedulaConductor = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE interAppCIL_Conductor SET Name = '" . $_POST["Name"] . "', Age = " . $_POST["Age"] . " WHERE PersonId = " . $_POST["PersonId"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM interAppCIL_Conductor WHERE CedulaConductor = " . $_POST["Cedula"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>