<?php
include 'conn.php';
//include 'eas.php';
//$eas = new eas();

$id = $_REQUEST['id'];

$sql = "select * from PruebaWilfred.dbo.interAppCIL_Conductor
WHERE        interAppCIL_Conductor.id = ".$id;

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll();
$json = array();            
foreach ($results as $rs) {
                        //Capturamos Variables
	$json[] = array(		 
		'id' => $rs['id'],
		'cedula' => $rs['CedulaConductor'],
		'nombre' => $rs['Nombre'],
		'apellidos' => $rs['Apellidos'],		
		'telefono' => $rs['Telefono'],
		'licencia' => $rs['LicenciaNro'],
		'fecha' => $rs['FechaVencLicencia'],
		'valor_multas' => $rs['ValorMultas']	 
	);
}
$jsonstring = json_encode($json);
echo $jsonstring;

?>              