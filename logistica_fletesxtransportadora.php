<?php
//** jccampoh - 09-04-2019: Se agrega el botón de exportación a excel. **/

include 'inc/conn.php';
include 'inc/eas.php';
$eas = new eas();

//$total_conductores = $eas->consultaSQLValor($pdo, "PruebaWilfred.dbo.interAppCIL_Conductor", 'count(*)', "");
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
        	<div align="center"><h3>Listado de Fletes por Transportadoras</h3></div>
			<div align="right" style="padding-bottom: 20px;">
				<button class="btn btn-danger" class="fa fa-user" data-toggle="modal" data-target="#modalUsuario">Agregar</button>
				<!--<p>Total Conductores Registrados: <?php /*echo*/ $total_conductores;?> </p>-->
				<!--<p><?php// echo print_r($conductor);?></p>-->
			</div>
            <div class="col-md-12">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                    	<td  style="display:none;"><strong>idFlete</strong></td>
                        <td><strong>Nit</strong></td>
                        <td><strong>Transportadora</strong></td>
                        <td style="display:none;"><strong>idTipo</strong></td>
                        <td><strong>Tipo Envio</strong></td>
                        <td style="display:none;"><strong>idCiudadOrigen</strong></td>
                        <td><strong>Ciudad Origen</strong></td>
                        <td style="display:none;"><strong>idCiudadDestino</strong></td>
                        <td><strong>Ciudad Destino</strong></td>
                        <!--<td><strong>idRuta</strong></td>-->
                        <td><strong>Ruta</strong></td>
                        <td><strong>Tipo A</strong></td>
                        <td><strong>Tipo B</strong></td>
                        <td><strong>Tipo C</strong></td>
                        <td><strong>Tiempo Estimado</strong></td>                        
                        <td><strong>Vigente Hasta</strong></td>
                        <td>Acciones</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

					$sql = "SELECT       *
FROM (SELECT interAppCIL_FleteXTransportadora.nitTransp AS nit, interAppCIL_Transportadora.Transportadora, interAppCIL_TipoEnvio.TipoEnvio, interAppCIL_FleteXTransportadora.idTipoEnvio, interAppCIL_FleteXTransportadora.CiudadOrigen AS idCiudadO, MTCDDAN.NOMCIUD AS CiudadO, 
                                                    interAppCIL_FleteXTransportadora.CiudadDestino AS idCiudadD, MTCDDAN_1.NOMCIUD AS CiudadD, interAppCIL_FleteXTransportadora.Ruta, interAppCIL_FleteXTransportadora.idClasificacionProd, 
                                                    interAppCIL_FleteXTransportadora.Precio, interAppCIL_FleteXTransportadora.TiempoEstimado, interAppCIL_FleteXTransportadora.Vigencia
                          FROM interAppCIL_Transportadora RIGHT OUTER JOIN
                                                    interAppCIL_FleteXTransportadora ON interAppCIL_Transportadora.NitTransportadora = interAppCIL_FleteXTransportadora.nitTransp LEFT OUTER JOIN
                                                    interAppCIL_TipoEnvio ON interAppCIL_FleteXTransportadora.idTipoEnvio = interAppCIL_TipoEnvio.idTipoEnvio LEFT OUTER JOIN
                                                    MTCDDAN ON interAppCIL_FleteXTransportadora.CiudadOrigen = MTCDDAN.CODIGO LEFT OUTER JOIN
                                                    MTCDDAN AS MTCDDAN_1 ON interAppCIL_FleteXTransportadora.CiudadDestino = MTCDDAN_1.CODIGO) S
PIVOT(
 MAX(Precio)
for[idClasificacionProd] in ([1],[2],[3])
) P";
                    $statement = $pdo->prepare($sql);
                    $statement->execute(array());
                    $result = $statement->fetchAll();
                    foreach ($result as $rs) {
                        //Capturamos Variables
                       
                        $nit = $rs['nit'];
                        $Transportadora = $rs['Transportadora'];
                        $idTipoEnvio = $rs['idTipoEnvio'];
                        $TipoEnvio = $rs['TipoEnvio'];
                        $idCiudadO = $rs['idCiudadO'];
                        $CiudadO = $rs['CiudadO'];
                        $idCiudadD = $rs['idCiudadD'];
                        $CiudadD = $rs['CiudadD'];
                        $CiudadFlete = $CiudadO.'-'.$CiudadD.' '.$TipoEnvio.' de '.$Transportadora;
                        $Ruta = $rs['Ruta'];
                        $TiempoEstimado = $rs['TiempoEstimado'];
                        $Vigencia = $rs['Vigencia'];
                        $TipoA = $rs['1'];
                        $TipoB = $rs['2'];
                        $TipoC = $rs['3'];

                        echo '
                        <tr>
                        	
                            <td>'.$nit.'</td>
                            <td>'.$Transportadora.'</td>
                            <td style="display:none;">'.$idTipoEnvio.'</td>
                            <td>'.$TipoEnvio.'</td>
                            <td style="display:none;">'.$idCiudadO.'</td>
                            <td>'.$CiudadO.'</td>
                            <td style="display:none;">'.$idCiudadD.'</td>
                            <td>'.$CiudadD.'</td>
                            <td>'.$Ruta.'</td>
                            <td>'.$TipoA.'</td>
                            <td>'.$TipoB.'</td>
                            <td>'.$TipoC.'</td>
                            <td>'.$TiempoEstimado.'</td>
                            <td>'.$Vigencia.'</td>
                            
                            <td>
                            	<a href="#" onclick="ActualizarDatos
                            	(\''.$nit.'\', \''.$idTipoEnvio.'\', \''.$idCiudadO.'\', \''.$idCiudadD.'\', \''.$Ruta.'\', \''.$TiempoEstimado.'\', \''.$Vigencia.'\', \''.$TipoA.'\', \''.$TipoB.'\', \''.$TipoC.'\');"></i><i class="fa fa-edit"</i> Editar</a>
                            	<a href="#" onclick="EliminarRegistro(\''.$nit.'\',\''.$idTipoEnvio.'\',\''.$idCiudadO.'\',\''.$idCiudadD.'\', \''.$CiudadFlete.'\');"><i class="fa fa-trash"></i> ELiminar</a>
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
<div class="modal" id="modalUsuario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                  <h4 class="modal-title"><center>Agregar Flete x Transportadora</center></h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
    <div class="modal-body">
                
        <div class="content mt-3">
            <!-- Contenido -->
            <form id="frmFletes" name="frmFletes" autocomplete="off" method="post" action="inc/logistica_fletes_insert.php">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTransportadora">Transportadora</label>
                        <select name="txtTransportadora" id="txtTransportadora" required class="form-control">
                            <option  value="">Seleccione</option>
                             <?php
                             $sql = "SELECT        NitTransportadora, Transportadora
									FROM            interAppCIL_Transportadora
									ORDER BY Transportadora";
                        	$result = $pdo->prepare($sql);
                        	$result->execute();
                        		foreach ($result as $rs) {
                        			
                        			echo '<option value="'.$rs['NitTransportadora'].'">'.$rs['Transportadora'].'</option>';
                        		}
                        	?>
                        </select>                       
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTipoEnvio">Tipo de Envio</label>
                        <select name="txtTipoEnvio" id="txtTipoEnvio" required class="form-control">
                           <option  value="">Seleccione</option>
                        	
                             <?php
                        		$tipo_envio = $eas->consultaSQL($pdo, "PruebaWilfred.dbo.interAppCIL_TipoEnvio", "idTipoEnvio, TipoEnvio", "order by TipoEnvio");
                        		foreach ($tipo_envio as $rs) {
                        			echo '<option value="'.$rs['idTipoEnvio'].'">'.$rs['TipoEnvio'].'</option>';
                        		}
                        	?>
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtOrigen">Ciudad Origen</label>
                        <select name="txtOrigen" id="txtOrigen" required class="form-control">
                        	<option  value="">Seleccione</option>
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

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtDestino">Ciudad Destino</label>
                        <select name="txtDestino" id="txtDestino" required class="form-control">
                        	<option  value="">Seleccione</option>
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

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtRuta">Ruta</label>
                        <input type="text" name="txtRuta" id="txtRuta" title="Ruta" placeholder="Ruta" required class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtValorFeteA">Valor Flete A</label>
                         <input type="number" name="txtValorFeteA" id="txtValorFeteA" title="Valor Flete A" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete A" required class="form-control">
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtValorFeteB">Valor Flete B</label>
                         <input type="number" name="txtValorFeteB" id="txtValorFeteB" title="Valor Flete B" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete B" required class="form-control">
                    </div>
                   
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtValorFeteC">Valor Flete C</label>
                         <input type="number" name="txtValorFeteC" id="txtValorFeteC" title="Valor Flete C" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete C" required class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTiempoEstimado">Tiempo Estimado</label>
                         <input type="number" name="txtTiempoEstimado" id="txtTiempoEstimado" title="Tiempo Estimado"  placeholder="Tiempo Estimado" required class="form-control">
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtVigenciaHasta">Vigencia hasta</label>
                         <input type="date" name="txtVigenciaHasta" id="txtVigenciaHasta" title="Vigencia hasta"  placeholder="Vigencia hasta" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                <!-- <input type="hidden" name="user_id" id="user_id" />
                 <input type="hidden" name="operation" id="operation" />-->
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                        <br>
                        <input type="submit" name="btnProcesar" class="btn btn-danger btn-large" value="Registrar Fletes">
                    <div>
                </div>
                
            </form>
        </div>
            

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
                  <h4 class="modal-title"><center>Actualizar Flete x Transportadora</center></h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                
        <div class="content mt-3">
            <!-- Contenido -->
            <form id="frmFletes" name="frmFletes" autocomplete="off" method="post" action="inc/logistica_fletes_update.php">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="updateTransportadora">Transportadora</label>
                        <select name="updateTransportadora" id="updateTransportadora" required class="form-control">
                            <option  value="">Seleccione</option>
                             <?php
                             $sql = "SELECT        NitTransportadora, Transportadora
									FROM            interAppCIL_Transportadora
									ORDER BY Transportadora";
                        	$result = $pdo->prepare($sql);
                        	$result->execute();
                        		foreach ($result as $rs) {
                        			
                        			echo '<option value="'.$rs['NitTransportadora'].'">'.$rs['Transportadora'].'</option>';
                        		}
                        	?>
                        </select>                       
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="updateTipoEnvio">Tipo de Envio</label>
                        <select name="updateTipoEnvio" id="updateTipoEnvio" required class="form-control">
                           <option  value="">Seleccione</option>
                        	
                             <?php
                        		$tipo_envio = $eas->consultaSQL($pdo, "PruebaWilfred.dbo.interAppCIL_TipoEnvio", "idTipoEnvio, TipoEnvio", "order by TipoEnvio");
                        		foreach ($tipo_envio as $rs) {
                        			echo '<option value="'.$rs['idTipoEnvio'].'">'.$rs['TipoEnvio'].'</option>';
                        		}
                        	?>
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="updateOrigen">Ciudad Origen</label>
                        <select name="updateOrigen" id="updateOrigen" required class="form-control">
                        	<option  value="">Seleccione</option>
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

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="updateDestino">Ciudad Destino</label>
                        <select name="updateDestino" id="updateDestino" required class="form-control">
                        	<option  value="">Seleccione</option>
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

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="updateRuta">Ruta</label>
                        <input type="text" name="updateRuta" id="updateRuta" title="Ruta" placeholder="Ruta" required class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="updateValorFeteA">Valor Flete A</label>
                         <input type="number" name="updateValorFeteA" id="updateValorFeteA" title="Valor Flete A" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete A" required class="form-control">
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="updateValorFeteB">Valor Flete B</label>
                         <input type="number" name="updateValorFeteB" id="updateValorFeteB" title="Valor Flete B" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete B" required class="form-control">
                    </div>
                   
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="updateValorFeteC">Valor Flete C</label>
                         <input type="number" name="updateValorFeteC" id="updateValorFeteC" title="Valor Flete C" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete C" required class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="updateTiempoEstimado">Tiempo Estimado</label>
                         <input type="number" name="updateTiempoEstimado" id="updateTiempoEstimado" title="Tiempo Estimado"  placeholder="Tiempo Estimado" required class="form-control">
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="updateVigenciaHasta">Vigencia hasta</label>
                         <input type="date" name="updateVigenciaHasta" id="updateVigenciaHasta" title="Vigencia hasta"  placeholder="Vigencia hasta" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                <!-- <input type="hidden" name="user_id" id="user_id" />
                 <input type="hidden" name="operation" id="operation" />-->
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                        <br>
                        <input type="submit" name="btnProcesar" class="btn btn-danger btn-large" value="Registrar Fletes">
                    <div>
                </div>
                
            </form>
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
    var nombreListado = "<?=date('YmdHis') . '_Listado_Conductores'?>"
</script>
<script src="assets/js/lib/data-table/datatables-init.js"></script>

<!--<script src="assets/js/logistica_conductores.js"></script>-->

</body>
</html>
