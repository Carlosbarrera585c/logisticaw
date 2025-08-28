<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();
$sql = "SELECT     EMPRESA = 'INTERLLANTAS',TRADE.FECHA AS Fecha_Dcto, TRADE.HORA, CAST(MVTRADE.TIPODCTO + '' + MVTRADE.NRODCTO AS Char(12)) AS NumeroDocumento, 
                      MVTRADE.NRODCTO AS Documento, TRADE.NIT, MTPROCLI.NOMBRE AS Nombre_Cliente, MVTRADE.BODEGA, MVTRADE.PRODUCTO, 
                      MVTRADE.NOMBRE AS Nombre_Producto_Mvto, CASE WHEN TipoDcto.DctoMae = 'NC' OR
                      TipoDcto.Positivo = 1 THEN MvTrade.Cantidad * - 1 ELSE MvTrade.Cantidad END AS Cantidad, MVTRADE.VALORUNIT AS Vlr_Unitario, 
                      MVTRADE.VLRVENTA AS Vlr_Venta, MTMERCIA.ESPRODUCTO AS Es_Producto, CASE WHEN TipoDcto.DctoMae = 'NC' OR
                      TipoDcto.Positivo = 1 THEN ((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100) 
                      - (((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100)) 
                      * - 1 ELSE ((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100) - (((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100)) END AS Total_Prod, CASE WHEN TipoDcto.DctoMae = 'NC' OR
                      TipoDcto.Positivo = 1 THEN ((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * Mvtrade.Descuento / 100) 
                      - (((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100) 
                      + ((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * Mvtrade.Descuento / 100) - (((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100)) * MvTrade.IVA / 100) 
                      * - 1 ELSE (MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * Mvtrade.Descuento / 100) - (((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100) + ((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      - ((MvTrade.Cantidad * MvTrade.ValorUnit) * Mvtrade.Descuento / 100) - (((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100)) * MvTrade.IVA / 100 END AS Total_Neto, TRADE.NOTA AS Nota_Encabezado, MVTRADE.NOTA AS Nota_Detalle,
                       MVTRADE.PLANPED, MVTRADE.IDMVTRADE, MVTRADE.COSTO, GS_UsrBodega.CodUsuario AS Usuario, CIUDAD.NOMBRE AS CIUDADCLI, 
                      MTPROCLI.DIRECCION AS DIR, 
                      CASE WHEN (MTMERCIA.DESCRIPCIO LIKE 'ACEITE%'OR MTMERCIA.DESCRIPCIO LIKE '%RUBIA %') THEN 'ACEITE' WHEN MTMERCIA.DESCRIPCIO LIKE '%BAT%' THEN 'BATERIA' WHEN MTMERCIA.CODUBICA
                       = 'A' THEN 'A' WHEN MTMERCIA.CODUBICA = 'B' THEN 'B' WHEN (MTMERCIA.CODUBICA = 'C' OR MTMERCIA.DESCRIPCIO LIKE '%COMPASAL%') THEN 'C' WHEN MTMERCIA.CODUBICA = 'OTR' THEN 'OTR' WHEN MTMERCIA.DESCRIPCIO
                       LIKE '%PLUMILLA%' THEN 'PLUMILLA' WHEN MTMERCIA.DESCRIPCIO LIKE '%TAPETE%' THEN 'TAPETES' ELSE 'OTROS' END AS TIPO, 
                      MTMERCIA.DESCRIPCIO
FROM         LLANTASERP.dbo.TIPODCTO INNER JOIN
                      LLANTASERP.dbo.MTMERCIA INNER JOIN
                      LLANTASERP.dbo.MVTRADE INNER JOIN
                      LLANTASERP.dbo.TRADE ON LLANTASERP.dbo.MVTRADE.ORIGEN = LLANTASERP.dbo.TRADE.ORIGEN AND LLANTASERP.dbo.MVTRADE.TIPODCTO = LLANTASERP.dbo.TRADE.TIPODCTO AND LLANTASERP.dbo.MVTRADE.NRODCTO = LLANTASERP.dbo.TRADE.NRODCTO ON 
                      LLANTASERP.dbo.MTMERCIA.CODIGO = LLANTASERP.dbo.MVTRADE.PRODUCTO INNER JOIN
                      LLANTASERP.dbo.TIPOMVTO ON LLANTASERP.dbo.TRADE.TIPOMVTO = LLANTASERP.dbo.TIPOMVTO.TIPOMVTO INNER JOIN
                      LLANTASERP.dbo.CIUDAD INNER JOIN
                      LLANTASERP.dbo.MTPROCLI ON LLANTASERP.dbo.CIUDAD.CODCIUDAD = LLANTASERP.dbo.MTPROCLI.CIUDAD ON LLANTASERP.dbo.MTPROCLI.NIT = LLANTASERP.dbo.TRADE.NIT INNER JOIN
                      LLANTASERP.dbo.GS_UsrBodega ON LLANTASERP.dbo.MVTRADE.BODEGA = LLANTASERP.dbo.GS_UsrBodega.Bodega ON LLANTASERP.dbo.TIPODCTO.TIPODCTO = LLANTASERP.dbo.MVTRADE.TIPODCTO AND 
                      LLANTASERP.dbo.TIPODCTO.ORIGEN = LLANTASERP.dbo.MVTRADE.ORIGEN
WHERE     (TRADE.ORIGEN = 'FAC') AND (TIPODCTO.DCTOMAE IN ('FA', 'RE')) AND (TRADE.TIPODCTO IN ('fa', 're','vl')) AND (year(TRADE.FECHA) >= 2019) AND (MVTRADE.PLANPED = 0)
                       AND (GS_UsrBodega.CodUsuario = 'JGONZALEZC') AND (MVTRADE.BODEGA = 'BCALIPUERTO' OR
                      MVTRADE.BODEGA = 'BOD6' OR
                      MVTRADE.BODEGA = 'BMANDATO' OR
                      MVTRADE.BODEGA = 'BINVTERCEROS' OR
                      MVTRADE.BODEGA = 'RESBOD6') OR
                      (TRADE.ORIGEN = 'INV') AND (TRADE.TIPODCTO IN ('SO', 'IL', 'GH')) AND (year(TRADE.FECHA) >= 2019) AND (MVTRADE.PLANPED = 0) AND 
                      (GS_UsrBodega.CodUsuario = 'JGONZALEZC') AND (MVTRADE.BODEGA = 'BCALIPUERTO' OR
                      MVTRADE.BODEGA = 'BOD6' OR
                      MVTRADE.BODEGA = 'BMANDATO' OR
                      MVTRADE.BODEGA = 'BINVTERCEROS' OR
                      MVTRADE.BODEGA = 'RESBOD6') AND (TRADE.NIT <> '111')

UNION
SELECT     EMPRESA = 'VALENCIA',TRADE.FECHA AS Fecha_Dcto, TRADE.HORA, CAST(MVTRADE.TIPODCTO + '' + MVTRADE.NRODCTO AS Char(12)) AS NumeroDocumento, 
                      MVTRADE.NRODCTO AS Documento, TRADE.NIT, MTPROCLI.NOMBRE AS Nombre_Cliente, MVTRADE.BODEGA, MVTRADE.PRODUCTO, 
                      MVTRADE.NOMBRE AS Nombre_Producto_Mvto, CASE WHEN TipoDcto.DctoMae = 'NC' OR
                      TipoDcto.Positivo = 1 THEN MvTrade.Cantidad * - 1 ELSE MvTrade.Cantidad END AS Cantidad, MVTRADE.VALORUNIT AS Vlr_Unitario, 
                      MVTRADE.VLRVENTA AS Vlr_Venta, MTMERCIA.ESPRODUCTO AS Es_Producto, CASE WHEN TipoDcto.DctoMae = 'NC' OR
                      TipoDcto.Positivo = 1 THEN ((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100) 
                      - (((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100)) 
                      * - 1 ELSE ((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100) - (((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100)) END AS Total_Prod, CASE WHEN TipoDcto.DctoMae = 'NC' OR
                      TipoDcto.Positivo = 1 THEN ((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * Mvtrade.Descuento / 100) 
                      - (((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100) 
                      + ((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * Mvtrade.Descuento / 100) - (((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100)) * MvTrade.IVA / 100) 
                      * - 1 ELSE (MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) * Mvtrade.Descuento / 100) - (((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      - ((MvTrade.Cantidad * MvTrade.ValorUnit) * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100) + ((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      - ((MvTrade.Cantidad * MvTrade.ValorUnit) * Mvtrade.Descuento / 100) - (((MvTrade.Cantidad * MvTrade.ValorUnit) - ((MvTrade.Cantidad * MvTrade.ValorUnit) 
                      * MvTrade.Descuento / 100)) * Trade.DSCTOCOM / 100)) * MvTrade.IVA / 100 END AS Total_Neto, TRADE.NOTA AS Nota_Encabezado, MVTRADE.NOTA AS Nota_Detalle,
                       MVTRADE.PLANPED, MVTRADE.IDMVTRADE, MVTRADE.COSTO, GS_UsrBodega.CodUsuario AS Usuario, CIUDAD.NOMBRE AS CIUDADCLI, 
                      MTPROCLI.DIRECCION AS DIR, 
                      CASE WHEN (MTMERCIA.DESCRIPCIO LIKE 'ACEITE%' OR MTMERCIA.DESCRIPCIO LIKE '%RUBIA %') THEN 'ACEITE' WHEN MTMERCIA.DESCRIPCIO LIKE '%BAT%' THEN 'BATERIA' WHEN MTMERCIA.CODUBICA
                       = 'A' THEN 'A' WHEN MTMERCIA.CODUBICA = 'B' THEN 'B' WHEN (MTMERCIA.CODUBICA = 'C' OR MTMERCIA.DESCRIPCIO LIKE '%COMPASAL%') THEN 'C' WHEN MTMERCIA.CODUBICA = 'OTR' THEN 'OTR' WHEN MTMERCIA.DESCRIPCIO
                       LIKE '%PLUMILLA%' THEN 'PLUMILLA' WHEN MTMERCIA.DESCRIPCIO LIKE '%TAPETE%' THEN 'TAPETES' ELSE 'OTROS' END AS TIPO, 
                      MTMERCIA.DESCRIPCIO
FROM         INTERLLANTAS.dbo.TIPODCTO INNER JOIN
                      INTERLLANTAS.dbo.MTMERCIA INNER JOIN
                      INTERLLANTAS.dbo.MVTRADE INNER JOIN
                      INTERLLANTAS.dbo.TRADE ON INTERLLANTAS.dbo.MVTRADE.ORIGEN = INTERLLANTAS.dbo.TRADE.ORIGEN AND INTERLLANTAS.dbo.MVTRADE.TIPODCTO = INTERLLANTAS.dbo.TRADE.TIPODCTO AND INTERLLANTAS.dbo.MVTRADE.NRODCTO = INTERLLANTAS.dbo.TRADE.NRODCTO ON 
                      INTERLLANTAS.dbo.MTMERCIA.CODIGO = INTERLLANTAS.dbo.MVTRADE.PRODUCTO INNER JOIN
                      INTERLLANTAS.dbo.TIPOMVTO ON INTERLLANTAS.dbo.TRADE.TIPOMVTO = INTERLLANTAS.dbo.TIPOMVTO.TIPOMVTO INNER JOIN
                      INTERLLANTAS.dbo.CIUDAD INNER JOIN
                      INTERLLANTAS.dbo.MTPROCLI ON INTERLLANTAS.dbo.CIUDAD.CODCIUDAD = INTERLLANTAS.dbo.MTPROCLI.CIUDAD ON INTERLLANTAS.dbo.MTPROCLI.NIT = INTERLLANTAS.dbo.TRADE.NIT INNER JOIN
                      INTERLLANTAS.dbo.GS_UsrBodega ON INTERLLANTAS.dbo.MVTRADE.BODEGA = INTERLLANTAS.dbo.GS_UsrBodega.Bodega ON INTERLLANTAS.dbo.TIPODCTO.TIPODCTO = INTERLLANTAS.dbo.MVTRADE.TIPODCTO AND 
                      INTERLLANTAS.dbo.TIPODCTO.ORIGEN = INTERLLANTAS.dbo.MVTRADE.ORIGEN
WHERE     (TRADE.ORIGEN = 'FAC') AND (TIPODCTO.DCTOMAE IN ('FA', 'RE')) AND (TRADE.TIPODCTO IN ('fa', 're', 'vl')) AND (YEAR(TRADE.FECHA) >= 2019) AND (MVTRADE.PLANPED = 0)
                       AND (GS_UsrBodega.CodUsuario = 'JGONZALEZC') AND (MVTRADE.BODEGA like '%BCALIPUERTO' OR
                      MVTRADE.BODEGA like '%BOD6' OR
                      MVTRADE.BODEGA like '%BMANDATO' OR
                      MVTRADE.BODEGA like '%BINVTERCEROS' OR
                      MVTRADE.BODEGA like '%RESBOD6') OR
                      (TRADE.ORIGEN = 'INV') AND (TRADE.TIPODCTO IN ('SO', 'IL', 'GH')) AND (YEAR(TRADE.FECHA) >= 2019) AND (MVTRADE.PLANPED = 0) AND 
                      (GS_UsrBodega.CodUsuario = 'JGONZALEZC') AND (MVTRADE.BODEGA like '%BCALIPUERTO' OR
                      MVTRADE.BODEGA like '%BOD6' OR
                      MVTRADE.BODEGA like '%BMANDATO' OR
                      MVTRADE.BODEGA like '%BINVTERCEROS' OR
                      MVTRADE.BODEGA like '%RESBOD6') AND (TRADE.NIT <> '111')";

$statement = $pdo->prepare($sql);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

$json = array();            
foreach ($results as $rs) {
                        //Capturamos Variables
	$id = $rs['IDMVTRADE'];
	$fecha = explode(" ", $rs['Fecha_Dcto']);
	$fecha = $fecha[0];
	$empresa = $rs['EMPRESA'];
	$fecha_dcto = $fecha;
	$hora = $rs['HORA'];
	$documento = $rs['NumeroDocumento'];
	$nit = $rs['NIT'];
	$cliente = $rs['Nombre_Cliente'];
	$bodega = $rs['BODEGA'];
	$producto = $rs['Nombre_Producto_Mvto'];
	$cantidad = number_format($rs['Cantidad']);
	$vlrUnitario = number_format($rs['Vlr_Unitario'], 2,  ".", "");
	$total = number_format($rs['Total_Prod'], 2,  ".", "");
	$encabezado = $rs['Nota_Encabezado'];
	$detalle = $rs['Nota_Detalle'];
	$destino = $rs['CIUDADCLI'];
	$dir = $rs['DIR'];
	$tipo = $rs['TIPO'];


	$json["data"][] = array(
		'id' => $rs['IDMVTRADE'],
		 'EMPRESA' => $rs['EMPRESA'],		 
		 'Fecha_Dcto' => $fecha,
		 'HORA' => $rs['HORA'],
		 'NumeroDocumento' => $rs['NumeroDocumento'],
		 'NIT' => $rs['NIT'],
		 'Nombre_Cliente' => $rs['Nombre_Cliente'],
		 'BODEGA' => $rs['BODEGA'],
		 'Nombre_Producto_Mvto' => $rs['Nombre_Producto_Mvto'],
		 'Cantidad' => $cantidad,
		 'Vlr_Unitario' => $vlrUnitario,
		 'Total_Prod' => $total,
		 'Nota_Encabezado' => $rs['Nota_Encabezado'],
		 'Nota_Detalle' => $rs['Nota_Detalle'],
		 'CIUDADCLI' => $rs['CIUDADCLI'],
		 'DIR' => $rs['DIR'],
		 'TIPO' => $rs['TIPO']


	);
}

$jsonstring = json_encode($json);
echo $jsonstring;


?>
                  