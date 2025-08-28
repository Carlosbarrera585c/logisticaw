<?php
include 'conn.php';
//include 'eas.php';
//$eas = new eas();
$sql = "SELECT        id, Transportadora
FROM            PruebaWilfred.dbo.interAppCIL_Transportadora
WHERE        (activa = 1)";

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = array();            
foreach ($results as $rs) {
                        //Capturamos Variables
	$json[] = array(
		'id' => $rs['id'],
		'Transportadora' => $rs['Transportadora']
	);
}
$jsonstring = json_encode($json);
echo $jsonstring;

?>
                  