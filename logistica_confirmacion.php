<?php
//** jccampoh - 09-04-2019: Se agrega el botón de exportación a excel. **/

include 'inc/conn.php';
include 'inc/eas.php';
$eas = new eas();

//$total_conductores = $eas->consultaSQLValor($pdo, "PruebaWilfred.dbo.interAppCIL_Conductor", 'count(*)', "");
//$conductor = $eas->consultaSQL($pdo, "PruebaWilfred.dbo.interAppCIL_Conductor", 'id, Nombre, Apellidos, CedulaConductor', "where id=1");
//echo '<script>alert("Total Conductores: '.$total_conductores.' ");</script>';

?>
	
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html> <!--<![endif]-->
<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Grupo Interllantas</title>
    <meta name="description" content="Interllantas">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> <!--importante ajax-->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>

    <!--<script src="assets/js/plugins.js"></script>-->

    <script src="assets/js/main.js"></script>

    <link rel="stylesheet" href="assets/css/loader.css">
    <script src="assets/js/loader.js"></script>


    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/datatables.min.css"/>

</head>

<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <?php include 'inc/navbar.php'; ?>
</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <?php
    include 'inc/header.php';
    ?>

    <div class="container-fluid mt-1">
        
        	<div align="center"><h3>Confirmación de Vehículos</h3></div>
			<div align="right" style="padding-bottom: 20px;">
				<button id="btnAgregar" class="btn btn-danger" class="fa fa-user">Agregar</button>
				<!--<p>Total Conductores Registrados: <?php /*echo*/ $total_conductores;?> </p>-->
				<!--<p><?php// echo print_r($conductor);?></p>-->
			</div>
			
            <div class="col-lg-12 col-md-12 col-xs-12">
                <table id="bootstrap-data-table" class="table table-striped table table-hover table-bordered">
                    <thead>
                    <tr>
                    	<td style="display:none;">id</td>
                    	<td>Transportadora</td>
                    	<td>Tipo Envio</td>
                    	<td>Origen</td>
                    	<td>Destino</td>
                    	<td>Ruta</td>
                    	<td>Placa</td>
                    	<td>Tipo Vehiculo</td>
                    	<td>Conductor</td>
                    	<td>Hora Estimada</td>
                    	<td>Valor Flete</td>
                    	<td>Motivo</td>
                    	<td>Aprobacion Aseguradora</td>
                        
                    </tr>
                    </thead>

                    <tbody id="tabla"></tbody>
                </table>
            </div>
            
        </div> <!-- .content -->
   
</div><!-- /#right-panel -->


<!-- Modal Mensajes -->
<div class="modal" id="modalConfirmacion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                  <h4 class="modal-title" id="tituloModal"></h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
    <div class="modal-body">
                
        <div class="content mt-3">
            <!-- Contenido -->
            <form id="frmConfirmacion" name="frmConfirmacion" autocomplete="off">

                <div class="row">
                	<div class="form-group">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTransportadora">Transportadora</label>
                        <select id="cmbTransportadora" required class="form-control"></select>                       
                    </div>


                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTipoEnvio">Tipo de Envio</label>
                        <select name="cmbTipoEnvio" id="cmbTipoEnvio" required class="form-control">
                           
                        </select>
                    </div>
                </div>
                </div>


                <div class="row">
                	<div class="form-group">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtOrigen">Ciudad Origen</label>
                        <select name="cmbOrigen" id="cmbOrigen" required class="form-control"></select>
                    </div>

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtDestino">Ciudad Destino</label>
                        <select name="cmbDestino" id="cmbDestino" required class="form-control"></select>
                    </div>

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtRuta">Ruta</label>
                        <input type="text" name="txtRuta" id="txtRuta" title="Ruta" placeholder="Ruta" required class="form-control">
                    </div>
                </div>
            </div>


                <div class="row">
                	<div class="form-group">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <label for="txtPlaca">Vehiculo</label>
                         <select name="cmbPlaca" id="cmbPlaca" required class="form-control"></select>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <label for="txtTipoVehiculo">Tipo</label>
                         <input type="text" name="txtTipoVehiculo" id="txtTipoVehiculo" readonly="readonly" class="form-control">
                    </div> 

                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <label for="lblVencSoat">Vig. SOAT</label>
                         <input type="text" name="txtVencSoat" id="txtVencSoat" readonly="readonly" class="form-control">
                    </div> 

                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <label for="lblVencTecno">Vig. TECNO</label>
                         <input type="text" name="txtVencTecno" id="txtVencTecno" readonly="readonly" class="form-control">
                    </div> 
                    </div>                  
                    
                </div>

                <div class="row">
                	<div class="form-group">

                	 <div class="col-lg-3 col-md-3 col-xs-12">
                        <label for="txtConductor">Conductor</label>
                         <select name="cmbConductor" id="cmbConductor" required class="form-control"></select>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <label for="txtCedula">Cédula</label>
                         <input type="text" name="txtCedula" id="txtCedula" readonly="readonly" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <label for="txtVigLic">Vig. Licencia</label>
                         <input type="text" name="txtVigLic" id="txtVigLic" readonly="readonly" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <label for="txtValMulta">Valor Multas</label>
                         <input type="text" name="txtValMulta" id="txtValMulta" readonly="readonly" class="form-control">
                    </div>
                </div>
                </div>

                <div class="row">
                	

                		<div class="col-lg-3 col-md-3 col-xs-12">
                			<label for="txtValorFlete">Valor Flete</label>
                			<input type="number" name="txtValorFlete" id="txtValorFlete"  class="form-control">
                		</div>

                		<div class="col-lg-3 col-md-3 col-xs-12">
                			<label for="txtConductor">Motivo Cambio</label>
                			<select name="cmbMotivo" id="cmbMotivo"  class="form-control"></select>
                		</div>

                		<div class="col-lg-3 col-md-3 col-xs-12">
                			<label for="txtHoraLlegada">Hora LLegada</label>
                			<input type="time" name="txtHoraLlegada" id="txtHoraLlegada"  class="form-control">
                		</div>


                		<div class="col-lg-3 col-md-3 col-xs-12" vcenter>
                			<div class="form-group">
                			<label></label>
                			<div class="form-group form-check">

                				<input type="checkbox" class="form-check-input" id="chkAprobacion" style="transform: scale(1.5);">
                				<label class="form-check-label" for="chkAprobacion">Aprobado Aseguradora</label>
                			</div>        			
</div>

                		</div>
                    
                	
                </div><br>

                <div class="modal-footer">
                <!-- <input type="hidden" name="user_id" id="user_id" />
                 <input type="hidden" name="operation" id="operation" />-->
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">                        
                        <input type="submit" name="btnProcesar" class="btn btn-danger btn-large" value="Registrar Fletes">
                    <div>
                </div>
                
            </form>
        </div>
            

        </div>
    </div>
</div>
</div>


           
</div> 
</div>
</div>
<!-- FIN -->
<script>
    function msgCancelar(codusuario) {
        swal({
            title: 'Desea cancelar el pedido?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#bd2130',
            cancelButtonColor: '#212529',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result.value) {
                window.location.assign('inc/pedidos_cancelar.php?c=' + codusuario);
            }
        })
    }
</script>


<script src="assets/js/sweetalert2.all.min.js"></script>
<script src="https://unpkg.com/promise-polyfill"></script>
<script>
    function EliminarRegistro(nit, idTipoEnvio, idCiudadO, idCiudadD, CiudadFlete) {
        swal({
            title: 'Eliminar Registro',
            text: "Esta seguro de eliminar el Flete de " + CiudadFlete + "?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#b21f2d',
            cancelButtonColor: '#343a40',
            cancelButtonText: 'No',
            confirmButtonText: 'Si, Eliminar'
        }).then((result) => {
            if (result.value) {
               
                window.location = "inc/logistica_fletes_delete.php?nit=" + nit + "&tipo=" + idTipoEnvio + "&ciudadO=" + idCiudadO + "&ciudadD=" + idCiudadD;
            }
        })
    }

</script>
<script>
	function ActualizarDatos(id, cedula, nombre_completo,nombre, apellidos, telefono, licencia, fecha, valor_multas) {
		$('#modalUpdateUsuario').modal('show');
		$('#updateCedula').val(cedula);
		$('#updateApellidos').val(apellidos);
		$('#updateNombre').val(nombre);
		$('#updateTel').val(telefono);
		$('#updateNumLicencia').val(licencia);
		$('#updateFechaVencLicencia').val(fecha);
		$('#updateValorMultas').val(valor_multas)
	}
</script>

<script>
    function aMayusculas(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
    }
   </script> 


<script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/datatables.min.js"></script>
<script>
    var nombreListado = "<?=date('YmdHis') . '_Confirmacion_Vehiculos'?>"
</script>
<script src="assets/js/lib/data-table/datatables-init.js"></script>

<script src="assets/js/logistica_confirmacion.js"></script>

</body>
</html>
