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
<body>
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
    	<div id="info"></div>
        <div class="col-md-12">
        	<div align="center"><h3>Listado de Conductores</h3></div>
			<div align="right" style="padding-bottom: 20px;">
				<button class="btn btn-danger" class="fa fa-user" data-toggle="modal" data-target="#modalUsuario">Agregar</button>
				<!--<p>Total Conductores Registrados: <?php /*echo*/ $total_conductores;?> </p>-->
				<!--<p><?php// echo print_r($conductor);?></p>-->
			</div>
            <div class="col-md-12">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td><strong>Id</strong></td>
                        <td><strong>Cédula</strong></td>
                        <td><strong>Nombre</strong></td>
                        <td><strong>Apellidos</strong></td>
                        <td><strong>Teléfono</strong></td>
                        <td><strong>LicenciaNro</strong></td>
                        <td><strong>Fecha Vencimiento</strong></td>
                        <td><strong>Valor Multas</strong></td>
                        <td>Acciones</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

					$sql = "select * from PruebaWilfred.dbo.interAppCIL_Conductor";
                    $statement = $pdo->prepare($sql);
                    $statement->execute(array());
                    $result = $statement->fetchAll();
                    foreach ($result as $rs) {
                        //Capturamos Variables
                        $id = $rs['id'];
                        $cedula = $rs['CedulaConductor'];
                        $nombre = $rs['Nombre'];
                        $apellidos = $rs['Apellidos'];
                        $nombre_completo = $nombre.' '.$apellidos;
                        $telefono = $rs['Telefono'];
                        $licencia = $rs['LicenciaNro'];
                        $fecha = $rs['FechaVencLicencia'];
                        $valor_multas = $rs['ValorMultas'];

                        echo '
                        <tr>
                            <td>'.$id.'</td>
                            <td>'.$cedula.'</td>
                            <td>'.$nombre.'</td>
                            <td>'.$apellidos.'</td>
                            <td>'.$telefono.'</td>
                            <td>'.$licencia.'</td>
                            <td>'.$fecha.'</td>
                            <td>'.$valor_multas.'</td>
                            <td>
                            	<a href="#" onclick="ActualizarDatos(\''.$id.'\', \''.$cedula.'\', \''.$nombre_completo.'\', \''.$nombre.'\', \''.$apellidos.'\', \''.$telefono.'\', \''.$licencia.'\', \''.$fecha.'\', \''.$valor_multas.'\');"></i><i class="fa fa-edit"</i> Editar</a>
                            	<a href="#" onclick="EliminarRegistro(\''.$id.'\', \''.$nombre_completo.'\');"><i class="fa fa-trash"></i> ELiminar</a>
                            </td>
                        </tr>
                        ';
                    
                    ?>


                    </tbody>
                </table>
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
                <form method="post" id="user_form" autocomplete="off" enctype="multipart/form-data" action="inc/logistica_conductores_insert.php">
               <div class="modal-content">
                <div class="modal-header">
                  
                 
                </div>
                <div class="modal-body">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <label for="txtCedula">Cedula de Conductor</label>
                        <input type="text"  name="txtCedula" id="txtCedula" title="Cedula de Conductor" enabled="disabled" placeholder="Cedula de Conductor" required class="form-control">
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

<!-- MODAL DE ACTUALIZACION-->
<!-- Modal Mensajes -->
<div class="modal" id="modalUpdateUsuario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                  <h4 class="modal-title"><center>Actualizar Conductor</center></h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" id="user_form" autocomplete="off" enctype="multipart/form-data" action="inc/logistica_conductores_update.php">
               <div class="modal-content">
                <div class="modal-header">
                  
                 
                </div>
                <div class="modal-body">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <label for="txtCedula">Cedula de Conductor</label>
                        <input type="text"  name="updateCedula" id="updateCedula"  readonly="readonly" required class="form-control">
                    </div>                   
                </div>


                <div class="row">
                     <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtNombreConductor">Nombre de Conductor</label>
                        <input type="text" name="updateNombre" id="updateNombre" title="Nombre de Conductor" onblur="aMayusculas(this.value,this.id)" placeholder="Nombre de Conductor" required class="form-control">
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtApellidos">Apellidos de Conductor</label>
                        <input type="text" name="updateApellidos" id="updateApellidos" title="Apellidos de Conductor" onblur="aMayusculas(this.value,this.id)" placeholder="Apellidos de Conductor" required class="form-control">
                    </div>
                </div>

                 <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTel">Teléfono</label>
                        <input type="tel" name="updateTel" id="updateTel" title="Teléfono" placeholder="Teléfono"  pattern="[0-9]{10}" required class="form-control">
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtNumLicencia">Numero de Licencia</label>
                        <input type="text" name="updateNumLicencia" id="updateNumLicencia" title="Numero de Licencia" placeholder="Numero de Licencia" required class="form-control">
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtFechaVencLicencia">Vencimiento de Licencia</label>
                        <input type ="date" name="updateFechaVencLicencia" id="updateFechaVencLicencia" title="Vencimiento de Licencia" placeholder="Vencimiento de Licencia" required class="form-control">
    
                    </div>

                   <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtValorMultas">Valor de Multas</label>
                        <input type="text" name="updateValorMultas" id="updateValorMultas" title="Valor de Multas" placeholder="Valor de Multas" required class="form-control">
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
                 <input type="submit" name="action" id="update" class="btn btn-success" value="Actualizar Datos" />
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
               
                window.location = "inc/logistica_conductores_delete.php?id=" + id;
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
    var nombreListado = "<?=date('YmdHis') . '_Listado_Conductores'?>"
</script>
<script src="assets/js/lib/data-table/datatables-init.js"></script>

<script src="assets/js/logistica_conductores.js"></script>

</body>

</html>