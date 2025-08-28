<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$sql = "SELECT DISTINCT interAppCIL_ConfirmacionVehiculo.nit, interAppCIL_Transportadora.Transportadora
FROM            interAppCIL_ConfirmacionVehiculo LEFT OUTER JOIN
                         interAppCIL_Transportadora ON interAppCIL_ConfirmacionVehiculo.nit = interAppCIL_Transportadora.NitTransportadora
WHERE        (interAppCIL_ConfirmacionVehiculo.estado = 0)
";
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		$json = array();            
		foreach ($results as $rs) {
                        //Capturamos Variables
			$json[] = array(
				
				'nit'	=> $rs['nit'],			
				'Transportadora' => $rs['Transportadora']
			);
		}
		$jsonstring = json_encode($json);
		echo $jsonstring;


?>