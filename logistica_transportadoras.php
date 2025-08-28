<?php
//** jccampoh - 09-04-2019: Se agrega el botón de exportación a excel. **/

include 'inc/conn.php';
include 'inc/eas.php';
$eas = new eas();

?>
<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
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
        <div class="col-md-12">
        	<div align="center"><h3>Listado de Transportadoras</h3></div>
			<div align="right" style="padding-bottom: 20px;">
				<button class="btn btn-danger" class="fa fa-user" data-toggle="modal" data-target="#modalTransportadoras">Agregar</button>
				
			</div>
            <div class="col-md-12">
                <table id="bootstrap-data-table" class="table table-sm table-bordered" >
                    <thead>
                    <tr>
                        
                        <td><strong>Nit Trnasportadora</strong></td>                        
                        <td><strong>Transportadora</strong></td>
                        <td><strong>Direccion</strong></td>
                        <td style="display:none;"><strong>IdCiudad</strong></td>
                        <td><strong>Ciudad</strong></td>
                        <td  style="display:none;"><strong>idEnvio</strong></td>
                        <td><strong>Tipo Envio</strong></td>
                        <td><strong>Telefono Principal</strong></td>
                        <td><strong>Telefono Alterno</strong></td>
                        <td><strong>e-mail</strong></td>
                        <td><strong>Contacto1</strong></td>
                        <td><strong>Contacto2</strong></td>
                        <td  style="display:none;"><strong>idRestriccion</strong></td>
                        <td><strong>Restriccion</strong></td>
                        
                        
                        <td><strong>Clientes Permitidos</strong></td>
                        <td><strong>Cliente Adicional</strong></td>
                        <td><strong>% Seguro</strong></td>
                        <td>Acciones</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

					$sql = "SELECT        interAppCIL_Transportadora.NitTransportadora, interAppCIL_Transportadora.Transportadora, interAppCIL_Transportadora.Direccion, interAppCIL_Transportadora.CodCiudad, MTCDDAN.NOMCIUD, 
                         interAppCIL_Transportadora.Telefono1, interAppCIL_Transportadora.Telefono2, interAppCIL_Transportadora.[e-mail], interAppCIL_Transportadora.Contacto1, interAppCIL_Transportadora.Contacto2, 
                         interAppCIL_Transportadora.idRestriccion, interAppCIL_RestriccionTransportadora.Restriccion, interAppCIL_Transportadora.idTipoEnvio, interAppCIL_TipoEnvio.TipoEnvio, interAppCIL_Transportadora.ClientesPermitidos, 
                         interAppCIL_Transportadora.ValCliAdicional, interAppCIL_Transportadora.Seguro, interAppCIL_Transportadora.activa
FROM            PruebaWilfred.dbo.interAppCIL_Transportadora LEFT OUTER JOIN
                         interAppCIL_TipoEnvio ON PruebaWilfred.dbo.interAppCIL_Transportadora.idTipoEnvio = PruebaWilfred.dbo.interAppCIL_TipoEnvio.idTipoEnvio LEFT OUTER JOIN
                         PruebaWilfred.dbo.interAppCIL_RestriccionTransportadora ON PruebaWilfred.dbo.interAppCIL_Transportadora.idRestriccion = PruebaWilfred.dbo.interAppCIL_RestriccionTransportadora.idRestriccion LEFT OUTER JOIN
                         MTCDDAN ON PruebaWilfred.dbo.interAppCIL_Transportadora.CodCiudad = PruebaWilfred.dbo.MTCDDAN.CODIGO";
                    $statement = $pdo->prepare($sql);
                    $statement->execute(array());
                    $result = $statement->fetchAll();
                    foreach ($result as $rs) {
                        //Capturamos Variables
                        $Nit = $rs['NitTransportadora'];
                        $Transportadora = $rs['Transportadora'];
                        $Direccion = $rs['Direccion'];
                        $IdCiudad = $rs['CodCiudad'];
                        $Ciudad = $rs['NOMCIUD'];  
                        $idTipoEnvio = $rs['idTipoEnvio'];
                        $TipoEnvio = $rs['TipoEnvio'];                     
                        $TelefonoPrin = $rs['Telefono1'];
                        $Telefono2 = $rs['Telefono2'];
                        $email = $rs['e-mail'];
                        $Contacto1 = $rs['Contacto1'];
                        $Contacto2 = $rs['Contacto2'];
                        $idRestriccion = $rs['idRestriccion'];
                        $Restriccion = $rs['Restriccion'];
                        
                        $ClientesPermitidos = $rs['ClientesPermitidos'];
                        $ValCliAdicional = $rs['ValCliAdicional'];
                        $Seguro = $rs['Seguro'];

                        echo '
                        <tr>
                            
                             <td>'.$Nit.'</td>                           
                            <td>'.$Transportadora.'</td>
                            <td>'.$Direccion.'</td>
                            <td style="display:none;">'.$IdCiudad.'</td>
                            <td>'.$Ciudad.'</td>
                                <td style="display:none;">'.$idTipoEnvio.'</td>
                             <td>'.$TipoEnvio.'</td>
                            <td>'.$TelefonoPrin.'</td>
                            <td>'.$Telefono2.'</td>
                            <td>'.$email.'</td>
                            <td>'.$Contacto1.'</td>
                            <td>'.$Contacto2.'</td>
                            <td style="display:none;">'.$idRestriccion.'</td>
                            <td>'.$Restriccion.'</td>
                         
                             <td>'.$ClientesPermitidos.'</td>
                             <td>'.$ValCliAdicional.'</td>
                             <td>'.$Seguro.'</td>
                            <td>
                            <a href="#" onclick="ActualizarDatos
                            	(\''.$Nit.'\', \''.$Transportadora.'\', \''.$Direccion.'\', \''.$IdCiudad.'\', \''.$idTipoEnvio.'\', \''.$TelefonoPrin.'\', \''.$Telefono2.'\', \''.$email.'\', \''.$Contacto1.'\', \''.$Contacto2.'\', \''.$idRestriccion.'\', \''.$ClientesPermitidos.'\', \''.$ValCliAdicional.'\', \''.$Seguro.'\');"></i><i class="fa fa-edit"</i> Editar</a>
                           
                            	<a href="#" onclick="EliminarRegistro(\''.$Nit.'\', \''.$Transportadora.'\');"><i class="fa fa-trash"></i> ELiminar</a>
                            </td>
                        </tr>
                        ';
                    }
                    ?>


                    </tbody>
                </table>
            </div>
        </div> <!-- .content -->
    </div>
</div><!-- /#right-panel -->


<!-- Modal Mensajes -->
<div class="modal" id="modalTransportadoras">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	
            <!-- Modal Header -->
            <div class="modal-header">
                  <h4 class="modal-title" id="titulo">Agregar Transportadora</h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">            	
                <form id="frmTransportadoras" name="frmTransportadoras" autocomplete="off" method="post" action="inc/logistica_transportadoras_insert.php">
                <div class="form-row">
                    <div class="form group col-lg-6 col-md-6 col-xs-12">
                        <label for="txtNit">Nit</label>
                        <input type="text" name="txtNit" id="txtNit" title="Nit de la transportadora" placeholder="Nit de la transportadora" required class="form-control">
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTransportadora">Transportadora</label>
                        <input type="text" name="txtTransportadora" id="txtTransportadora" title="Transportadora" placeholder="Transportadora" required class="form-control">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-lg-5 col-md-5 col-xs-12">
                        <label for="txtDireccion">Dirección</label>
                        <input type="text" name="txtDireccion" id="txtDireccion" title="Direccion" placeholder="Direccion de la transportadora" required class="form-control">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtCiudad">Ciudad</label>
                        <select name="txtCiudad" id="txtCiudad" required class="form-control">
                        	                       	
                             <?php
                             $sql = "SELECT CODIGO, NOMCIUD, NOMDPTO
								FROM            MTCDDAN
								WHERE        (NOMDPTO <> '')
								ORDER BY NOMCIUD";
                        	$result = $pdo->prepare($sql);
                        	$result->execute();
                        		foreach ($result as $rs) {
                        			$codigo = $rs['CODIGO'];
                        			$ciudad = $rs['NOMCIUD'];
                        			$dpto = $rs['NOMDPTO'];
                        			$ciudpto = $ciudad.' - '.$dpto;
                        			echo '<option value="'.$codigo.'">'.$ciudpto.'</option>';
                        		}
                        	?>
                        </select>
                    </div> 

                    <div class="form-group col-lg-3 col-md-3 col-xs-12">
                        <label for="envio">Tipo Envio</label>
                        <select name="txtTipoEnvio" id="txtTipoEnvio" required class="form-control">
                        	<option>Seleccione</option>
                        	
                             <?php
                        		$tipo_envio = $eas->consultaSQL($pdo, "PruebaWilfred.dbo.interAppCIL_TipoEnvio", "idTipoEnvio, TipoEnvio", "order by TipoEnvio");
                        		foreach ($tipo_envio as $rs) {
                        			echo '<option value="'.$rs['idTipoEnvio'].'">'.$rs['TipoEnvio'].'</option>';
                        		}
                        	?>
                        </select>
                    </div>                                   
                    
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtContacto1">Contácto1</label>
                        <input type="text" name="txtContacto1" id="txtContacto1" title="Contácto" placeholder="Contácto1" required class="form-control">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtContacto2">Contácto2</label>
                        <input type="text" name="txtContacto2" id="txtContacto2" title="Contácto" placeholder="Contácto2"  class="form-control">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtemail">E-Mail</label>
                        <input type="email" name="txtemail" id="txtemail" title="e-mail" placeholder="e-mail" required class="form-control">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="Tel1">Teléfono1</label>
                        <input type="text" name="txtTel1" id="txtTel1" title="Teléfono 1" placeholder="Teléfono 1" required class="form-control">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="Tel2">Teléfono2</label>
                        <input type="text" name="txtTel2" id="txtTel2" title="Teléfono 2" placeholder="Teléfono 2" class="form-control">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtTel2">Restriccion</label>
                        <select name="txtRestriccion" id="txtRestriccion" class="form-control">
                            <option>Seleccione</option>
                        	
                             <?php
                             $sql = "SELECT      idRestriccion, Restriccion
								FROM            interAppCIL_RestriccionTransportadora";
                        	$result = $pdo->prepare($sql);
                        	$result->execute();
                        		foreach ($result as $rs) {
                        			echo '<option value="'.$rs['idRestriccion'].'">'.$rs['Restriccion'].'</option>';
                        		}
                        	?>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtMaxClientes">Nro. Clientes</label>
                        <input type="number" name="txtMaxClientes" id="txtMaxClientes" title="Clientes Permitidos" placeholder="Clientes Permitidos" required class="form-control">
                    </div>

                     <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtAdicional">Prec Adicional</label>
                        <input type="text" name="txtAdicional" id="txtAdicional" title="Precio Cliente Adicional" onkeyup="format(this)" onchange="format(this)" placeholder="Precio Cliente Adicional" required class="form-control">
                    </div>

                     <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtSeguro">(%)Seguro</label>
                        <input type="text" name="txtSeguro" id="txtSeguro" title="(%)Seguro" placeholder="(%)Seguro" required class="form-control">
                    </div>
                </div>
             
             
                <div class="modal-footer">
                <!-- <input type="hidden" name="user_id" id="user_id" />
                 <input type="hidden" name="operation" id="operation" />-->
                 <input type="submit" name="action" id="action" class="btn btn-success" value="Registrar Transportadora" />
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
           		</form>
            </div>                 
            </div>
            </div>
    </div>



<!-- MODAL DE ACTUALIZACION-->
<!-- Modal Mensajes -->
<!-- Modal Mensajes -->
<div class="modal" id="modalUpdateTransportadoras">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	
            <!-- Modal Header -->
            <div class="modal-header">
                  <h4 class="modal-title" id="titulo">Actualizar Transportadora</h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            	
                <form id="frmTransportadoras" name="frmTransportadoras" autocomplete="off" method="post" action="inc/logistica_transportadoras_update.php">
                <div class="form-row">
                    <div class="form group col-lg-6 col-md-6 col-xs-12">
                        <label for="txtNit">Nit</label>
                        <input type="text" name="updateNit" id="updateNit" title="Nit de la transportadora" placeholder="Nit de la transportadora" required class="form-control">
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <label for="updateTransportadora">Transportadora</label>
                        <input type="text" name="updateTransportadora" id="updateTransportadora" title="Transportadora" placeholder="Transportadora" required class="form-control">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-lg-5 col-md-5 col-xs-12">
                        <label for="txtDireccion">Dirección</label>
                        <input type="text" name="updateDireccion" id="updateDireccion" title="Direccion" placeholder="Direccion de la transportadora" required class="form-control">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="updateCiudad">Ciudad</label>
                        <select name="updateCiudad" id="updateCiudad" class="form-control">
                        	                       	
                             <?php
                             $sql = "SELECT CODIGO, NOMCIUD, NOMDPTO
								FROM            MTCDDAN
								WHERE        (NOMDPTO <> '')
								ORDER BY NOMCIUD";
                        	$result = $pdo->prepare($sql);
                        	$result->execute();
                        		foreach ($result as $rs) {
                        			$codigo = $rs['CODIGO'];
                        			$ciudad = $rs['NOMCIUD'];
                        			$dpto = $rs['NOMDPTO'];
                        			$ciudpto = $ciudad.' - '.$dpto;
                        			echo '<option value="'.$codigo.'">'.$ciudpto.'</option>';
                        		}
                        	?>
                        </select>
                    </div> 

                    <div class="form-group col-lg-3 col-md-3 col-xs-12">
                        <label for="envio">Tipo Envio</label>
                        <select name="updateTipoEnvio" id="updateTipoEnvio" class="form-control">
                        	<option>Seleccione</option>
                        	
                             <?php
                        		$tipo_envio = $eas->consultaSQL($pdo, "PruebaWilfred.dbo.interAppCIL_TipoEnvio", "idTipoEnvio, TipoEnvio", "order by TipoEnvio");
                        		foreach ($tipo_envio as $rs) {
                        			echo '<option value="'.$rs['idTipoEnvio'].'">'.$rs['TipoEnvio'].'</option>';
                        		}
                        	?>
                        </select>
                    </div>                                   
                    
                </div>

                <div class="form-row">
                	 <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="updateTelPrinc">Teléfono1</label>
                        <input type="text" name="updateTelPrinc" id="updateTelPrinc" title="Teléfono 1" placeholder="Teléfono 1" required class="form-control">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="updateTel2">Teléfono2</label>
                        <input type="text" name="updateTel2" id="updateTel2" title="Teléfono 2" placeholder="Teléfono 2" class="form-control">
                    </div>
                    
                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="updateemail">E-Mail</label>
                        <input type="email" name="updateemail" id="updateemail" title="e-mail" placeholder="e-mail" required class="form-control">
                    </div>
                </div>


                <div class="form-row">
                	<div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="updateContacto1">Contácto1</label>
                        <input type="text" name="updateContacto1" id="updateContacto1" title="Contácto" placeholder="Contácto1" required class="form-control">
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="updateContacto2">Contácto2</label>
                        <input type="text" name="updateContacto2" id="updateContacto2" title="Contácto" placeholder="Contácto2"  class="form-control">
                    </div>
                   

                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="updateTel2">Restriccion</label>
                        <select name="updateRestriccion" id="updateRestriccion" class="form-control">
                            <option>Seleccione</option>
                        	
                             <?php
                             $sql = "SELECT      idRestriccion, Restriccion
								FROM            interAppCIL_RestriccionTransportadora";
                        	$result = $pdo->prepare($sql);
                        	$result->execute();
                        		foreach ($result as $rs) {
                        			echo '<option value="'.$rs['idRestriccion'].'">'.$rs['Restriccion'].'</option>';
                        		}
                        	?>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="updateMaxClientes">Nro. Clientes</label>
                        <input type="number" name="updateMaxClientes" id="updateMaxClientes" title="Clientes Permitidos" placeholder="Clientes Permitidos" required class="form-control">
                    </div>

                     <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtAdicional">Prec Adicional</label>
                        <input type="text" name="updateAdicional" id="updateAdicional" title="Precio Cliente Adicional" onkeyup="format(this)" onchange="format(this)" placeholder="Precio Cliente Adicional" required class="form-control">
                    </div>

                     <div class="form-group col-lg-4 col-md-4 col-xs-12">
                        <label for="txtSeguro">(%)Seguro</label>
                        <input type="text" name="updateSeguro" id="updateSeguro" title="(%)Seguro" placeholder="(%)Seguro" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                <!-- <input type="hidden" name="user_id" id="user_id" />
                 <input type="hidden" name="operation" id="operation" />-->
                 <input type="submit" name="action" id="action" class="btn btn-success" value="Actualizar Datos" />
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
    function EliminarRegistro(Nit, Transportadora) {
        swal({
            title: 'Eliminar Registro',
            text: "Esta seguro de eliminar la Transportadora " + Transportadora + "?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#b21f2d',
            cancelButtonColor: '#343a40',
            cancelButtonText: 'No',
            confirmButtonText: 'Si, Eliminar'
        }).then((result) => {
            if (result.value) {
               
                window.location = "inc/logistica_transportadoras_delete.php?Nit=" + Nit;
            }
        })
    }

</script>


<script>
	function ActualizarDatos(Nit, Transportadora, Direccion, IdCiudad, idTipoEnvio,TelefonoPrin, Telefono2, email,Contacto1, Contacto2, idRestriccion, ClientesPermitidos, Adicional, Seguro) {
		$('#modalUpdateTransportadoras').modal('show');		
		$('#updateNit').val(Nit);
		$('#updateTransportadora').val(Transportadora);
		$('#updateDireccion').val(Direccion);
		$('#updateCiudad').val(IdCiudad);
		$('#updateTipoEnvio').val(idTipoEnvio);
		$('#updateTelPrinc').val(TelefonoPrin);
		$('#updateTel2').val(Telefono2);
		$('#updateemail').val(email);
		$('#updateContacto1').val(Contacto1);
		$('#updateContacto2').val(Contacto2);		
		$('#updateRestriccion').val(idRestriccion);		
		$('#updateMaxClientes').val(ClientesPermitidos)
		$('#updateAdicional').val(Adicional);
		$('#updateSeguro').val(Seguro);
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
    var nombreListado = "<?=date('YmdHis') . '_Listado_Conductores'?>"
</script>
<script src="assets/js/lib/data-table/datatables-init.js"></script>

<!--<script src="assets/js/logistica_conductores.js"></script>-->

</body>
</html>
