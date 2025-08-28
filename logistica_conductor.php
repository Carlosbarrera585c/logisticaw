<?php
    //session_start();
    //error_reporting(0);

    //include 'inc/conn.php';
    //include 'inc/eas.php';
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
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
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <?php include 'inc/navbar.php';?>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <?php include 'inc/header.php';?>
        <!--
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        -->

        <div class="content mt-3">
            <CENTER><p><h3> LISTADO DE CONDUCTORES</h3></p></CENTER>
        </div> <!-- .content -->

        <div class="content mt-3">
        	
            <!-- Contenido -->
             <div class="table-responsive">
                <br />
                <div align="right">
                 <button type="button" id="add_button" data-toggle="modal" data-target="#conductorModal" class="btn btn-info btn-lg">Agregar</button>
                </div>
                <table id="tconductores" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Telefono</th>
                            <th>Licencia</th>
                            <th>Fecha Vencimiento</th>
                            <th>Valor Multas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Telefono</th>
                            <th>Licencia</th>
                            <th>Fecha Vencimiento</th>
                            <th>Valor Multas</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!--  MODAL  -->
            <div id="conductorModal" class="modal fade">
             <div class="modal-dialog">
              <form method="post" id="user_form" enctype="multipart/form-data" action="inc/logistica_conductores_insert.php">
               <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><center>Agregar Conductor</center></h4>
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                 
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

            <!--  MODAL  -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>
    <script>
    function aMayusculas(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
    }
   </script> 
   <script type="text/javascript" class="init">
    $(document).ready(function() {
    $('#tconductores').DataTable();
} );</script>

</body>
</html>
