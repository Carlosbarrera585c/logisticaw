<?php


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
        <div class="col-lg-12 col-md-12 col-xs-12">
        	<div class="table-responsive">

			<div align="right" style="padding-bottom: 20px; padding-top: 20px;">
				<button class="btn btn-danger"><i class="fa fa-user" data-toggle="modal" data-target="#modalTransportadoras"></i>Agregar</button>
				
			</div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <td><strong>NitTransportadora</strong></td>                        
                        <td><strong>Transportadora</strong></td>
                        <td><strong>Direccion</strong></td>
                        <td style="display:none;"><strong>IdCiudad</strong></td>
                        <td><strong>Ciudad</strong></td>
                        <td><strong>Telefono 1</strong></td>
                        <td><strong>Telefono 2</strong></td>
                        <td><strong>e-mail</strong></td>
                        <td><strong>Contacto 1</strong></td>
                        <td><strong>Contacto 2</strong></td>
                        <td style="display:none;"><strong>idRestriccion</strong></td>
                        <td><strong>Restriccion</strong></td>
                        <td style="display:none;"><strong>idEnvio</strong></td>
                        <td><strong>Tipo Envio</strong></td>
                        <td><strong>Clientes Permitidos</strong></td>
                        <td><strong>Valor Cliente Adicional</strong></td>
                        <td><strong>% Seguro</strong></td>
                        <td>Acciones</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

					$sql = "SELECT interAppCIL_Transportadora.NitTransportadora, interAppCIL_Transportadora.Transportadora, interAppCIL_Transportadora.Direccion, interAppCIL_Transportadora.CodCiudad, MTCDDAN.NOMCIUD, interAppCIL_Transportadora.Telefono1, interAppCIL_Transportadora.Telefono2, interAppCIL_Transportadora.[e-mail], interAppCIL_Transportadora.Contacto1, interAppCIL_Transportadora.Contacto2, 
                         interAppCIL_Transportadora.idRestriccion, interAppCIL_RestriccionTransportadora.Restriccion, interAppCIL_Transportadora.idTipoEnvio, interAppCIL_TipoEnvio.TipoEnvio, interAppCIL_Transportadora.ClientesPermitidos, 
                         interAppCIL_Transportadora.ValCliAdicional, interAppCIL_Transportadora.Seguro, interAppCIL_Transportadora.activa
						FROM            interAppCIL_Transportadora LEFT OUTER JOIN
                         interAppCIL_TipoEnvio ON interAppCIL_Transportadora.idTipoEnvio = interAppCIL_TipoEnvio.idTipoEnvio LEFT OUTER JOIN
                         interAppCIL_RestriccionTransportadora ON interAppCIL_Transportadora.idRestriccion = interAppCIL_RestriccionTransportadora.idRestriccion LEFT OUTER JOIN
                         MTCDDAN ON interAppCIL_Transportadora.CodCiudad = MTCDDAN.CODIGO";

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
                        $Telefono1 = $rs['Telefono1'];
                        $Telefono2 = $rs['Telefono2'];
                        $email = $rs['e-mail'];
                        $idRestriccion = $rs['idRestriccion'];
                        $Restriccion = $rs['Restriccion'];
                        $idTipoEnvio = $rs['idTipoEnvio'];
                        $TipoEnvio = $rs['TipoEnvio'];
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
                            <td>'.$Telefono1.'</td>
                            <td>'.$Telefono2.'</td>
                            <td>'.$email.'</td>
                            <td>'.$Contacto1.'</td>
                            <td>'.$Contacto2.'</td>
                            <td style="display:none;">'.$idRestriccion.'</td>
                            <td>'.$Restriccion.'</td>
                             <td style="display:none;">'.$idTipoEnvio.'</td>
                             <td>'.$TipoEnvio.'</td>
                             <td>'.$ClientesPermitidos.'</td>
                             <td>'.$ValCliAdicional.'</td>
                             <td>'.$Seguro.'</td>
                            <td>
                            	<a href="#"><i class="fa fa-edit"></i> Editar</a>
                            	<a href="#" onclick="EliminarRegistro(\''.$Nit.'\', \''.$Transportadora.'\');"><i class="fa fa-trash"></i> ELiminar</a>
                            </td>
                        </tr>
                        ';
                    }
                    ?>


                    </tbody>
                </table>
            </div>
        </div>
        </div> <!-- .content -->
    </div>
</div><!-- /#right-panel -->


<!-- Modal Mensajes -->
<div class="modal" id="modalUsuario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                  <h4 class="modal-title"><center>Agregar Conductor</center></h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" id="user_form" enctype="multipart/form-data" action="inc/logistica_conductores_insert.php">
               <div class="modal-content">
                <div class="modal-header">
                  
                 
                </div>
                <div class="modal-body">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <label for="txtCedula">Cedula de Conductor</label>
                        <input type="text"  name="txtCedula" id="txtCedula" title="Cedula de Conductor" placeholder="Cedula de Conductor" required class="form-control">
                    </div>                   
                </div>


                <div class="row">
                     <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtNombreConductor">Nombre de Conductor</label>
                        <input type="text" name="txtNombre" id="txtNombre" title="Nombre de Conductor" onblur="aMayusculas(this.value,this.id)" placeholder="Nombre de Conductor" required class="form-control">
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtApellidos">Apellidos de Conductor</label>
                        <input type="text" name="txtApellidos" id="txtApellidos" title="Apellidos de Conductor" onblur="aMayusculas(this.value,this.id)" placeholder="Apellidos de Conductor" required class="form-control">
                    </div>
                </div>

                 <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTel">Teléfono</label>
                        <input type="tel" name="txtTel" id="txtTel" title="Teléfono" placeholder="Teléfono"  pattern="[0-9]{10}" required class="form-control">
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtNumLicencia">Numero de Licencia</label>
                        <input type="text" name="txtNumLicencia" id="txtNumLicencia" title="Numero de Licencia" placeholder="Numero de Licencia" required class="form-control">
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtFechaVencLicencia">Vencimiento de Licencia</label>
                        <input type ="date" name="txtFechaVencLicencia" id="txtFechaVencLicencia" title="Vencimiento de Licencia" placeholder="Vencimiento de Licencia" required class="form-control">
    
                    </div>

                   <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtValorMultas">Valor de Multas</label>
                        <input type="text" name="txtValorMultas" id="txtValorMultas" title="Valor de Multas" placeholder="Valor de Multas" required class="form-control">
                    </div>
                </div>

              
                <!-- <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                        <br>
                        <input type="submit" name="btnProcesar" class="btn btn-danger btn-large" value="Registrar Conductor">
                    <div> 
                </div> -->
                </div>
                <div class="modal-footer">
                <!-- <input type="hidden" name="user_id" id="user_id" />
                 <input type="hidden" name="operation" id="operation" />-->
                 <input type="submit" name="action" id="action" class="btn btn-success" value="Registrar Conductor" />
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
               </div>
              </form>
            </div>
            

        </div>
    </div>
</div>

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
    function EliminarRegistro(id, nombre) {
        swal({
            title: 'Eliminar Registro',
            text: "Esta seguro de eliminar el conductor " + nombre + "?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#b21f2d',
            cancelButtonColor: '#343a40',
            cancelButtonText: 'No',
            confirmButtonText: 'Si, Eliminar'
        }).then((result) => {
            if (result.value) {
                //window.location = "../compras_solicitud.php";
                window.location = "inc/logistica_conductores_eliminar.php?id=" + id;
            }
        })
    }

</script>
<script>$(document).ready(function() {
    $('#example').DataTable();
} );</script>

<script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/datatables.min.js"></script>
<script>
    var nombreListado = "<?=date('YmdHis') . '_cartera'?>"
</script>
<script src="assets/js/lib/data-table/datatables-init.js"></script>

</body>
</html>
