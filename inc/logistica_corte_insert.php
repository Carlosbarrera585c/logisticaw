<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$id = $_POST['id'];
$empresa= $_POST['empresa'];
$fecha= $_POST['fecha'];
$hora= $_POST['hora'];
$dcto= $_POST['dcto'];
$nit= $_POST['nit'];
$cliente= $_POST['cliente'];
$bodega= $_POST['bodega'];
$producto= $_POST['producto'];
$cantidad= $_POST['cantidad'];
$vlrUnitario= $_POST['vlrUnitario'];
$total= $_POST['total'];
$encabezado= $_POST['encabezado'];
$detalle= $_POST['detalle'];
$usuario= 'WTOVAR';
$destino= $_POST['destino'];
$direccion= $_POST['direccion'];
$tipo= $_POST['tipo'];
$estado= 1;


	if($empresa=='VALENCIA'){
		$sqlV ="UPDATE INTERLLANTAS.dbo.MVTRADE SET PLANPED = 1 WHERE (PLANPED = 0) AND (IDMVTRADE = ?)";
		//$actualizarV = $pdo->prepare($sqlV);
		//$actualizarV->bindParam(1, $id);
		//$actualizarV->bindParam(2, $dcto);
		//$actualizarV->execute();
	}
	else{
		$sqlI ="UPDATE LLANTASERP.dbo.MVTRADE SET PLANPED = 1 WHERE (PLANPED = 0) AND (IDMVTRADE = ?)";
		$actualizarI = $pdo->prepare($sqlI);
		$actualizarI->bindParam(1, $id);
		//$actualizarI->bindParam(2, $dcto);
		$actualizarI->execute();
	}


/*
$sql = "INSERT INTO PruebaWilfred.dbo.interAppCIL_Corte
                         (fechaHoraCorte, Empresa, fecha_Doc, Hora_Doc, Nro_Doc, Nit, Nombre_Cliente, Bodega, Producto, Cantidad, Vlr_Unitario, Total_Prod, Nota_Encabezado, Nota_Detalle, Usuario, CIUDADCLI, DIR, TIPO_FLETE, 
                         idEstadoProgramacion)
VALUES        (GETDATE(),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$insertar = $pdo->prepare($sql);

try
{
	$insertar->bindParam(1, $empresa);
	$insertar->bindParam(2, $fecha);
	$insertar->bindParam(3, $hora);
	$insertar->bindParam(4, $dcto);
	$insertar->bindParam(5, $nit);
	$insertar->bindParam(6, $cliente);
	$insertar->bindParam(7, $bodega);
	$insertar->bindParam(8, $producto);
	$insertar->bindParam(9, $cantidad);
	$insertar->bindParam(10, $vlrUnitario);
	$insertar->bindParam(11, $total);
	$insertar->bindParam(12, $encabezado);
	$insertar->bindParam(13, $detalle);
	$insertar->bindParam(14, $usuario);
	$insertar->bindParam(15, $destino);
	$insertar->bindParam(16, $direccion);
	$insertar->bindParam(17, $tipo);
	$insertar->bindParam(18, $estado);		

	$insertar->execute();
	
	//
	
        
	echo "Ingreso exitoso!";
	
	
}
catch(Exception $e)
{
	echo "Error ingresando el documento. Error: ".$e;
	
}
*/
?>