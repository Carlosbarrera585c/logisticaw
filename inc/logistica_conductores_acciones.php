<?php
include 'inc/conn.php';
include 'eas.php';
$eas = new eas();

try
{
	//Open database connection
/*	$con = mysql_connect("sqlsrv:Server=SISTEMAS\SQL","sa","inter");
	mysql_select_db("PruebaWilfred.dbo", $con);*/
	

	//Getting records (listAction)
	if($_GET["action"] == "listar")
	{
		//Get record count
		$sql = "SELECT COUNT(*) AS RecordCount FROM interAppCIL_Conductor";
		$result =  $pdo->prepare($sql);
		$result->execute();

		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = $pdo->prepare("SELECT * FROM interAppCIL_Conductor ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] );
		$result->execute();
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
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