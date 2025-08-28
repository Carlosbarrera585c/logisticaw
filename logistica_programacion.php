<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<link rel="stylesheet" href="assets/css/font-awesome.min.css">


	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">



	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


	
<style type="text/css">table.dataTable thead {background-color:gray}</style>



</head>
<body>

	
	
    <div class="row">
   <div class="content mt-1">
   	<div class="row">
   		<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
   			<div class="row" >
   				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
 
    <div style="background: red;"><h4><center>Pedidos Sin Programar</center></h4></div>
    
	<table class="table table-sm table-striped  table-hover" id="PsinProgramar" style="width: 95%">
		<thead> 
			<tr>
			
				<th>Destino</th>
				<th>CantDoc</th>
				<th>Valorizado</th> 
			</tr> 
		</thead> 


		</table>
	</div>
		</div>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
<div style="background: yellow;"><h4><center>Vehículos en Proceso</center></h4></div>

	<table class="table table-sm table-striped table-hover" id="PenProceso" > 
<thead><tr>
<th>Nro</th> 
<th>Placa</th>
<th>Ruta</th> 
<!--<th>CantDoc</th>--> 
<th>Valorizado</th></tr></thead>
	</table>

	</div>
	</div>
	</div>
	
	<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" >

			<div  style="background: green;"><h3><center>Programación de Transporte</center></h3></div>
				
		<form> 
			<div class="form-row">
				<div class="form-group col-md-2"> 
					<label for="Planilla">Nro Prog.</label>
					<input type="text" disabled id="txtNroProg" class="form-control form-control-sm">
				</div>

				<div class="form-group col-md-3">
					<label for="Trasportadora">Transportadora</label>
					<select id="cmbTransportadora" class="form-control form-control-sm">
						<option  value=0>Seleccione</option>
					</select>
				</div>

				<div class="form-group col-md-2">
					<label for="Placa">Placa</label>
					<select disabled id="cmbPlaca" class="form-control form-control-sm">
						<option  value=0>S/N</option>
					</select>
				</div>

				<div class="form-group col-md-3">
					<label for="TipoVehiculo">Tipo de Vehiculo</label>
					<select disabled id="cmbTipoVehiculo" class="form-control form-control-sm">
						<option  value=0>S/N</option>
					</select>
				</div> 

				<div class="form-group col-md-2">
					<label for="TipoEnvio">Tipo de Envio</label>
					<select disabled id="cmbTipoEnvio" class="form-control form-control-sm">
						<option  value=0>S/N</option>
					</select>
				</div> 
			</div>

			
			<div class="form-row">
				<div class="form-group col-md-3">
					<label for="Conductor">Conductor</label>
					<select disabled id="cmbConductor" class="form-control form-control-sm">
						<option  value=0>S/N</option>
					</select>
				</div>

				<div class="form-group col-md-3"> 
					<label for="Ruta">Ruta</label>
					<input type="text" readonly id="txtRuta" class="form-control form-control-sm">
				</div>

				
				<div class="form-group col-md-3">
					<label for="Destino">Destino</label>
					<select id="cmbDestino" class="form-control form-control-sm">
						<option  value=0>S/N</option>
					</select>
				</div>

				<div class="form-group col-md-1">
					<br>
					<button type='button' id="btnAgregar" class='btn btn-success btn-block'><i class='Agregar fa fa-check-circle'></i></button>		
				</div>

				<div class="form-group col-md-1">
					<br>					
					<button type='button' id="btnEditar" class='btn btn-info btn-block'><i class='editar fa fa-edit'></i></button>
				</div>

				<div class="form-group col-md-1">
					<br>					
					<button type='button' id="btnBuscar" class='btn btn-warning btn-block'><i class='buscar fa fa-search'></i></button>
				</div>

			</div> 
			
		</form>
	
		<!--aqui coloco tabla resumen planilla--> 
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 h-50">
 
    <div style="background: orange;"><h4><center>Resumen Documentos Vehículo</center></h4></div>
    
	<table class="table table-sm table-striped table-hover" id="PlanillaVehiculo" style="width: 100%">
		<thead> 
			<tr>
				<th>Documento</th>
				<th>Cliente</th>
				<th>Destino</th>
				<th>Direccion</th>
				<th>Observacion</th> 
				<th>Cantidad</th>  				
				<th>Valorizado</th>
				
			</tr> 
		</thead>
		
		</table>
		
	</div>
		</div>
		<div>
			<a class="btn btn-warning" href="#" role="button" id="btnEspera">En Proceso</a>
			<a class="btn btn-success" href="#" role="button" id="btnFinalizar">Finalizar</a>
		</div>
		
		</div>
	</div>
</div>
</div>






		
		

		

		<script type="text/javascript" src="assets/js/logistica_programacion.js"></script>


</body>
</html>