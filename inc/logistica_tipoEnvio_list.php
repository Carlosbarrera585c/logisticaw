<?php
include 'conn.php';
//include 'eas.php';
//$eas = new eas();
$sql = "SELECT       idTipoEnvio, TipoEnvio
FROM            interAppCIL_TipoEnvio";

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = array();            
foreach ($results as $rs) {
                        //Capturamos Variables
	$json[] = array(
		'id' => $rs['idTipoEnvio'],
		'TipoEnvio' => $rs['TipoEnvio']
	);
}
$jsonstring = json_encode($json);
echo $jsonstring;

?>
                  