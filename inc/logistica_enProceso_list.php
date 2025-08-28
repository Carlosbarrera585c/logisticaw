<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();
$sql = "SELECT DISTINCT COUNT(DISTINCT interAppCIL_Corte.Nro_Doc) AS Dctos, SUM(interAppCIL_Corte.Total_Prod) AS Valorizado, interAppCIL_Corte.Vehiculo, interAppCIL_Corte.NroProgramacion AS Nro, interAppCIL_Rutas.Ruta
FROM            interAppCIL_Rutas RIGHT OUTER JOIN
                         interAppCIL_ConfirmacionVehiculo ON interAppCIL_Rutas.idRuta = interAppCIL_ConfirmacionVehiculo.idRuta RIGHT OUTER JOIN
                         interAppCIL_Corte ON interAppCIL_ConfirmacionVehiculo.placa = interAppCIL_Corte.Vehiculo
WHERE        (interAppCIL_Corte.idEstadoProgramacion = 2)
GROUP BY interAppCIL_Corte.Vehiculo, interAppCIL_Corte.NroProgramacion, interAppCIL_Rutas.Ruta";

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
		'Nro' => $rs['Nro'],
		 'Vehiculo' => $rs['Vehiculo'],	
		 'Ruta' => $rs['Ruta'],	
		 'Dctos' => $rs['Dctos'],		 
		 'total' => '$ '.number_format($rs['Valorizado'], 0,  "", ",")

	);
}

$jsonstring = json_encode($json);
echo $jsonstring;
}

?>
                  