<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();
$sql = "SELECT DISTINCT CIUDADCLI as Destino, COUNT(DISTINCT Nro_Doc) AS Dctos, SUM(Total_Prod) AS Valorizado
FROM            interAppCIL_Corte
WHERE        (idEstadoProgramacion = 1)
GROUP BY CIUDADCLI";

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
if(!$results){
	die('No hay datos para mostar');
}
else{
$json = array();            
foreach ($results as $rs) {
                       
	$json["data"][] = array(		
		'destino' => $rs['Destino'],
		 'dctos' => $rs['Dctos'],		 
		 'total' => '$ '.number_format($rs['Valorizado'], 0,  "", ",")

	);
}

$jsonstring = json_encode($json);
echo $jsonstring;
}

?>
                  