<?php
include 'conn.php';
//include 'eas.php';
//$eas = new eas();
$sql = "SELECT CODIGO, NOMCIUD, NOMDPTO
FROM            MTCDDAN
WHERE        (NOMDPTO <> '')
ORDER BY NOMCIUD";

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = array();            
foreach ($results as $rs) {
                        //Capturamos Variables
	$json[] = array(
		'id' => $rs['CODIGO'],
		'Ciudad' => $rs['NOMCIUD'].' - '.$rs['NOMDPTO']
	);
}
$jsonstring = json_encode($json);
echo $jsonstring;

?>
                  