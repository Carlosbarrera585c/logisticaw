<?php
//** jccampoh - 09-04-2019: Se agrega el botón de exportación a excel. **/

include 'inc/conn.php';
include 'inc/eas.php';
$eas = new eas();

$total_conductores = $eas->consultaSQLValor($pdo, "PruebaWilfred.dbo.interAppCIL_Conductor", 'count(*)', "");
//$conductor = $eas->consultaSQL($pdo, "PruebaWilfred.dbo.interAppCIL_Conductor", 'id, Nombre, Apellidos, CedulaConductor', "where id=1");
//echo '<script>alert("Total Conductores: '.$total_conductores.' ");</script>';

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

          <style>
    .ocultar {
        display: none;
    }
</style>

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
        	<div align="center"><h3>Listado de Vehiculos</h3></div>
			<div align="right" style="padding-bottom: 20px;">
				<button class="btn btn-danger" class="fa fa-user" data-toggle="modal" data-target="#modalVehiculo">Agregar</button>
				<!--<p>Total Conductores Registrados: <?php /*echo*/ $total_conductores;?> </p>-->
				<!--<p><?php// echo print_r($conductor);?></p>-->
			</div>
            <div class="col-md-12">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td style="display:none;"><strong>Id</strong></td>
                        <td><strong>Placa</strong></td>
                        <td  style="display:none;"><strong>idTipo</strong></td>
                        <td><strong>Tipo Vehiculo</strong></td>
                        <td><strong>Cedula Propietario</strong></td>
                        <td><strong>Nombre Propietario</strong></td>
                        <td><strong>Vencimiento SOAT</strong></td>
                        <td><strong>Vencimiento TECNO</strong></td>
                        <td><strong>Capacidad Tons</strong></td>
                        <td><strong>Capacidad Vol</strong></td>
                        <td>Acciones</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

					$sql = "SELECT         interAppCIL_Vehiculo.id, interAppCIL_Vehiculo.Placa,interAppCIL_TipoVehiculo.idTipoVehiculo, interAppCIL_TipoVehiculo.TipoVehiculo, interAppCIL_Vehiculo.cedulaPropietario, interAppCIL_Vehiculo.nombrePropietario, interAppCIL_Vehiculo.FechaVencSOAT, 
                         interAppCIL_Vehiculo.FechaVencTECNO, interAppCIL_Vehiculo.CapacidadCargaTn, interAppCIL_Vehiculo.CapacidadVolumen
						FROM           PruebaWilfred.dbo.interAppCIL_Vehiculo INNER JOIN
                         PruebaWilfred.dbo.interAppCIL_TipoVehiculo ON interAppCIL_Vehiculo.idTipoVehiculo = interAppCIL_TipoVehiculo.idTipoVehiculo";
                    $statement = $pdo->prepare($sql);
                    $statement->execute(array());
                    $result = $statement->fetchAll();
                    foreach ($result as $rs) {
                        //Capturamos Variables
                        $id = $rs['id'];
                        $placa = $rs['Placa'];
                        $idtipo = $rs['idTipoVehiculo'];
                        $tipo = $rs['TipoVehiculo'];
                        $cedula = $rs['cedulaPropietario'];
                        //$nombre_completo = $nombre.' '.$apellidos;
                        $propietario = $rs['nombrePropietario'];
                        $fechaSoat = $rs['FechaVencSOAT'];
                        $fechaTecno = $rs['FechaVencTECNO'];
                        $capacidadTn = $rs['CapacidadCargaTn'];
                        $capacidadVl = $rs['CapacidadVolumen'];

                        echo '
                        <tr>
                            <td style="display:none;">'.$id.'</td>
                            <td>'.$placa.'</td>
                            <td style="display:none;">'.$idtipo.'</td>
                            <td>'.$tipo.'</td>
                            <td>'.$cedula.'</td>
                            <td>'.$propietario.'</td>
                            <td>'.$fechaSoat.'</td>
                            <td>'.$fechaTecno.'</td>
                            <td>'.$capacidadTn.'</td>
                            <td>'.$capacidadVl.'</td>
                            <td>
                            	<a href="#" onclick="ActualizarDatos(\''.$id.'\', \''.$placa.'\', \''.$idtipo.'\', \''.$cedula.'\', \''.$propietario.'\', \''.$fechaSoat.'\', \''.$fechaTecno.'\', \''.$capacidadTn.'\', \''.$capacidadVl.'\');"></i><i class="fa fa-edit"</i> Editar</a>
                            	<a href="#" onclick="EliminarRegistro(\''.$placa.'\');"><i class="fa fa-trash"></i> ELiminar</a>
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
<div class="modal" id="modalVehiculo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                  <h4 class="modal-title"><center>Agregar Vehiculo</center></h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="frmVehiculos" name="frmVehiculos" autocomplete="off" method="post" action="inc/logistica_vehiculos_insert.php">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtPlaca">Placa Vehículo</label>
                        <input type="text"  name="txtPlaca" id="txtPlaca" title="Placa Vehículo" onblur="aMayusculas(this.value,this.id)" placeholder="Placa Vehículo" required class="form-control">
                    </div>

                     <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTipoVehiculo">Tipo de Vehiculo</label>
                        <select name="txtTipoVehiculo" id="txtTipoVehiculo" required class="form-control">
                            <?php
                        		$tipo_vehiculo = $eas->consultaSQL($pdo, "PruebaWilfred.dbo.interAppCIL_TipoVehiculo", "idTipoVehiculo, TipoVehiculo", "order by TipoVehiculo");
                        		foreach ($tipo_vehiculo as $rs) {
                        			echo '<option value="'.$rs['idTipoVehiculo'].'">'.$rs['TipoVehiculo'].'</option>';
                        		}
                        	?>
                        </select>
                    </div>                              
                </div>


                <div class="row">
                     <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtCedulaPropietario">Cedula del Propietario</label>
                        <input type="text" name="txtCedulaPropietario" id="txtCedulaPropietario" title="Cedula del Propietario" placeholder="Cedula del Propietario" required class="form-control">
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtPropietario">Nombre del Propietario</label>
                        <input type="text" name="txtPropietario" id="txtPropietario" title="Nombre del Propietario" onblur="aMayusculas(this.value,this.id)" placeholder="Nombre del Propietario" required class="form-control">
                    </div>
                </div>

                 <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtSoat">Vencimiento Soat</label>
                        <input type="date" name="txtSoat" id="txtSoat" title="Vencimiento Soat" placeholder="Vencimiento Soat" required class="form-control">
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTecno">Vencimiento de Tecnomécanica</label>
                        <input type="date" name="txtTecno" id="txtTecno" title="Vencimiento de Tecnomécanica" placeholder="Vencimiento de Tecnomécanica" required class="form-control">
                    </div>
                </div>



                <div class="row">
                     <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtPeso">Capacidad en peso</label>
                        <input type="text" name="txtPeso" id="txtPeso" title="Capacidad en peso" placeholder="Capacidad en peso" required class="form-control">
                    </div>

                   <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtVolumen">Capacidad en volumen</label>
                        <input type="text" name="txtVolumen" id="txtVolumen" title="Capacidad en volumen" placeholder="Capacidad en volumen" required class="form-control">
                    </div>
                </div>

              <!--
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                        <br>
                        <input type="submit" name="btnProcesar" class="btn btn-danger btn-large" value="Registrar Vehiculo">
                    <div>
                </div>
                
            </form> -->

              
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
                 <input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="Registrar Vehiculo" />
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
               </div>
              </form>
            </div>
            

        </div>
    </div>
</div>

<!-- MODAL DE ACTUALIZACION-->
<!-- Modal Mensajes -->
<div class="modal" id="modalUpdateVehiculo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                  <h4 class="modal-title"><center>Actualizar Vehiculo</center></h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="frmVehiculos" name="frmVehiculos" autocomplete="off" method="post" action="inc/logistica_vehiculos_update.php">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtPlaca">Placa Vehículo</label>
                        <input type="text"  name="updatePlaca" id="updatePlaca" title="Placa Vehículo" placeholder="Placa Vehículo" required class="form-control">
                    </div>

                     <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="updateTipoVehiculo">Tipo de Vehiculo</label>
                       <select name="updateTipoVehiculo" id="updateTipoVehiculo" required class="form-control">
                            <?php
                        		$tipo_vehiculo = $eas->consultaSQL($pdo, "PruebaWilfred.dbo.interAppCIL_TipoVehiculo", "idTipoVehiculo, TipoVehiculo", "order by TipoVehiculo");
                        		foreach ($tipo_vehiculo as $rs) {
                        			echo '<option value="'.$rs['idTipoVehiculo'].'">'.$rs['TipoVehiculo'].'</option>';
                        		}
                        	?>
                        </select>
                    </div>                              
                </div>


                <div class="row">
                     <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="CedulaPropietario">Cedula del Propietario</label>
                        <input type="text" name="updateCedulaPropietario" id="updateCedulaPropietario" title="Cedula del Propietario" placeholder="Cedula del Propietario" required class="form-control">
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtPropietario">Nombre del Propietario</label>
                        <input type="text" name="updatePropietario" id="updatePropietario" title="Nombre del Propietario" onblur="aMayusculas(this.value,this.id)" placeholder="Nombre del Propietario" required class="form-control">
                    </div>
                </div>

                 <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtSoat">Vencimiento Soat</label>
                        <input type="date" name="updateSoat" id="updateSoat" title="Vencimiento Soat" placeholder="Vencimiento Soat" required class="form-control">
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTecno">Vencimiento de Tecnomécanica</label>
                        <input type="date" name="updateTecno" id="updateTecno" title="Vencimiento de Tecnomécanica" placeholder="Vencimiento de Tecnomécanica" required class="form-control">
                    </div>
                </div>



                <div class="row">
                     <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtPeso">Capacidad en peso</label>
                        <input type="text" name="updatePeso" id="updatePeso" title="Capacidad en peso" placeholder="Capacidad en peso" required class="form-control">
                    </div>

                   <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtVolumen">Capacidad en volumen</label>
                        <input type="text" name="updateVolumen" id="updateVolumen" title="Capacidad en volumen" placeholder="Capacidad en volumen" required class="form-control">
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
                 <input type="submit" name="update" id="update" class="btn btn-success" value="Actualizar Datos" />
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
               </div>
              </form>
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
    function EliminarRegistro(placa) {
        swal({
            title: 'Eliminar Registro',
            text: "Esta seguro de eliminar el Vehiculo " + placa + "?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#b21f2d',
            cancelButtonColor: '#343a40',
            cancelButtonText: 'No',
            confirmButtonText: 'Si, Eliminar'
        }).then((result) => {
            if (result.value) {
               
                window.location = "inc/logistica_vehiculos_delete.php?placa=" + placa;
            }
        })
    }

</script>
<script>
	function ActualizarDatos(id, placa, idtipo, cedula, propietario, fechaSoat, fechaTecno, peso, volumen) {
		$('#modalUpdateVehiculo').modal('show');
		$('#updatePlaca').val(placa);
		$('#updateTipoVehiculo').val(idtipo);
		$('#updateCedulaPropietario').val(cedula);
		$('#updatePropietario').val(propietario);
		$('#updateSoat').val(fechaSoat);
		$('#updateTecno').val(fechaTecno);
		$('#updatePeso').val(peso);
		$('#updateVolumen').val(volumen)
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
<script>
$(document).ready(function() {
	$('.oculta').toggle();
  $('td:nth-child(3)').toggle();
}
</script>

<!--<script src="assets/js/logistica_conductores.js"></script>-->

</body>
</html>
