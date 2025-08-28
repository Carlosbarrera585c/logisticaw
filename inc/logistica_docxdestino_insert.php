<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();

$destino = $_REQUEST['destino'];
$nroProg = $_REQUEST['nroProg'];
$idTrans = $_REQUEST['idTrans'];
$placa = $_REQUEST['placa'];
$tipoEnvio = $_REQUEST['tipoEnvio'];
$tipoVehiculo = $_REQUEST['tipoVehiculo'];
$conductor = $_REQUEST['conductor'];


$sql = "UPDATE       interAppCIL_Corte
SET                Transportadora = '".$idTrans."', idTipoEnvio = ".$tipoEnvio.", idTipoVehiculo = ".$tipoVehiculo.", Vehiculo = '".$placa."', idEstadoProgramacion = 2, NroProgramacion = '".$nroProg."', Conductor = '".$conductor."', [Hora IniciaProgramacion] = GETDATE()
WHERE        (CIUDADCLI LIKE '".$destino."%')";

$statement = $pdo->prepare($sql);
$statement->execute();

$sql = "SELECT        Nro_Doc AS Documento, Empresa, Nombre_Cliente AS Cliente, CIUDADCLI AS Destino, DIR AS Direccion, Nota_Encabezado as Observacion, SUM(Cantidad) AS Cantidad, SUM(Total_Prod) AS Valorizado
FROM            interAppCIL_Corte

WHERE        (NroProgramacion = '".$nroProg."')
GROUP BY Nro_Doc, Empresa, Nombre_Cliente, CIUDADCLI, DIR, Nota_Encabezado";

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
		 'Valorizado' => '$'.number_format($rs['Valorizado'], 0,  "", ",")

	);
}

$jsonstring = json_encode($json);
//$jsonstring = json_encode($destino);
echo $jsonstring;

?>
                  