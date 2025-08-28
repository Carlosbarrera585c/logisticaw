<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();

	//Capturamos Variables
$transportadora = $_REQUEST['txtTransportadora'];
$tipoenvio = $_REQUEST['txtTipoEnvio'];
$origen = $_REQUEST['txtOrigen'];
$destino = $_REQUEST['txtDestino'];
$ruta = $_REQUEST['txtRuta'];
$fletea = $_REQUEST['txtValorFeteA'];
$fleteb = $_REQUEST['txtValorFeteB'];
$fletec = $_REQUEST['txtValorFeteC'];
$tiempo = $_REQUEST['txtTiempoEstimado'];
$vhasta = $_REQUEST['txtVigenciaHasta'];

$sql = "INSERT INTO PruebaWilfred.dbo.interAppCIL_FleteXTransportadora
                         (nitTransp, idTipoEnvio, CiudadOrigen, CiudadDestino, Ruta, idClasificacionProd, Precio, TiempoEstimado, Vigencia)
		VALUES        (?,?,?,?,?,?,?,?,?)";
$insertar = $pdo->prepare($sql);
try
{
	$insertar->execute([$transportadora, $tipoenvio, $origen, $destino, $ruta,1, $fletea, $tiempo, $vhasta]);
	$insertar->execute([$transportadora, $tipoenvio, $origen, $destino, $ruta,2, $fleteb, $tiempo, $vhasta]);
	$insertar->execute([$transportadora, $tipoenvio, $origen, $destino, $ruta,3, $fletec, $tiempo, $vhasta]);
	
	echo "CONDUCTOR CREADO CORRECTAMENTE";
	//header('Location: http://localhost/logistica/logistica_fletesxtransportadora.php');
	
}
catch(Exception $e)
{
	echo "No se pudo crear el Conductor. Error: ".$e;
	
}


?>