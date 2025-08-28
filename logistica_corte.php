<?php
//** jccampoh - 09-04-2019: Se agrega el botón de exportación a excel. **/

include 'inc/conn.php';
include 'inc/eas.php';
//include 'inc/logistica_corte_list.php';
$eas = new eas();

//$total_conductores = $eas->consultaSQLValor($pdo, 'PruebaWilfred.dbo.interAppCIL_Conductor', 'count(*)', ');
//$conductor = $eas->consultaSQL($pdo, 'PruebaWilfred.dbo.interAppCIL_Conductor', 'id, Nombre, Apellidos, CedulaConductor', 'where id=1');
//echo '<script>alert('Total Conductores: '.$total_conductores.' ');</script>';

?>

<!DOCTYPE html>
<!--[if lt IE 7]>
	<html class='no-js lt-ie9 lt-ie8 lt-ie7' lang='> <![endif]-->
<!--[if IE 7]>
	<html class='no-js lt-ie9 lt-ie8' lang='> <![endif]-->
<!--[if IE 8]>
	<html class='no-js lt-ie9' lang='> <![endif]-->
	<!--[if gt IE 8]><!-->
	<html> <!--<![endif]-->
	<head>
		<meta http-equiv='Expires' content='0'>
		<meta http-equiv='Last-Modified' content='0'>
		<meta http-equiv='Cache-Control' content='no-cache, mustrevalidate'>
		<meta http-equiv='Pragma' content='no-cache'>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<title>Grupo Interllantas</title>
		<meta name='description' content='Interllantas'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<link rel='apple-touch-icon' href='apple-icon.png'>
		<link rel='icon' type='image/png' sizes='16x16' href='images/favicon.png'>

		<link rel='stylesheet' href='assets/css/normalize.css'>
		<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
		<link rel='stylesheet' href='assets/css/font-awesome.min.css'>
		<link rel='stylesheet' href='assets/css/themify-icons.css'>
		<link rel='stylesheet' href='assets/css/flag-icon.min.css'>
		<link rel='stylesheet' href='assets/css/cs-skin-elastic.css'>
		<!-- <link rel='stylesheet' href='assets/css/bootstrap-select.less'> -->
		<link rel='stylesheet' href='assets/scss/style.css'>

		 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script> <!--importante ajax-->

		<script src='https://code.jquery.com/jquery-3.3.1.min.js'
		integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=' crossorigin='anonymous'></script>
		<!--<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>-->
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'
		integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49'
		crossorigin='anonymous'></script>
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'
		integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy'
		crossorigin='anonymous'></script>

		<!--<script src='assets/js/plugins.js'></script>-->

		<script src='assets/js/main.js'></script>

		<link rel='stylesheet' href='assets/css/loader.css'>
		<script src='assets/js/loader.js'></script>

		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


		<link rel='stylesheet' type='text/css'
		href='https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/datatables.min.css'/>

	</head>

	<div id='preloader'>
		<div id='status'>&nbsp;</div>
	</div>
	<!-- Left Panel -->

	<aside id='left-panel' class='left-panel'>
		<?php include 'inc/navbar.php'; ?>
	</aside><!-- /#left-panel -->

	<!-- Left Panel -->

	<!-- Right Panel -->
	<body id="cuerpo">

	<div id='right-panel' class='right-panel'>

		<?php
		include 'inc/header.php';
		?>

		<div class='container-fluid mt-1'>

			<div align='center'><h3>Corte de Documentos</h3></div>
			<div align='right' style='padding-bottom: 20px;'>
				<!--<button id='btnConsultar' class='btn btn-warning' class='fa fa-user'>Consultar</button>-->
				<button id='btnProcesar' class='btn btn-danger' class='fa fa-user'>Procesar</button>

			</div>
			
			<div class='col-lg-12 col-md-12 col-xs-12'>
				<table id='bootstrap-data-table' class='table table-striped table table-hover table-bordered'>
					<thead>
						<tr>  
							<td style="display:none;">id</td>                  	
							<td>Empresa</td>
							<td>Fecha Documento</td>
							<td>Hora Documento</td>
							<td>Documento</td>
							<td>Nit</td>
							<td>Cliente</td>
							<td>Bodega</td>
							<td>Producto</td>
							<td>Cantidad</td>
							<td>Vlr_Unitario</td>
							<td>Total Producto</td>
							<td>Nota Encabezado</td>
							<td>Nota Detalle</td>                    	
							<td>Destino</td>
							<td>Direccion</td>
							<td>Tipo Flete</td>

						</tr>
					</thead>
					<tbody id="datos"></tbody>
				
				</table>
				
			</div>

		</div> <!-- .content -->

	</div><!-- /#right-panel -->           

	<!-- FIN -->


	<script src='assets/js/sweetalert2.all.min.js'></script>
	<script src='https://unpkg.com/promise-polyfill'></script>

	<script type='text/javascript'
	src='https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/datatables.min.js'></script>
	<script>
		var nombreListado = '<?=date('YmdHis') . '_Corte_Documentos'?>'
	</script>
	<script src='assets/js/lib/data-table/datatables-init.js'></script>


	<script src='assets/js/logistica_corte.js'></script>

</body>
</html>
