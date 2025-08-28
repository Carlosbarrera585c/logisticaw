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
            <p><h3>Transportadoras</h3></p>
        </div> <!-- .content -->

        <div class="content mt-3">
            <!-- Contenido -->
            <form id="frmTransportadoras" name="frmTransportadoras" autocomplete="off" method="post" action="inc/logistica_transportadoras_insert.php">

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtNit">Nit de la transportadora</label>
                        <input type="text" name="txtNit" id="txtNit" title="Nit de la transportadora" placeholder="Nit de la transportadora" required class="form-control">
                    </div>

                    <div class="col-lg-8 col-md-8 col-xs-12">
                        <label for="txtNombre">Nombre de la transportadora</label>
                        <input type="text" name="txtNombre" id="txtNombre" title="Nombre de la transportadora" placeholder="Nombre de la transportadora" required class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <label for="txtDireccion">Dirección</label>
                        <input type="text" name="txtDireccion" id="txtDireccion" title="Direccion de la transportadora" placeholder="Direccion de la transportadora" required class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtCiudad">Ciudad</label>
                        <select name="txtCiudad" id="txtCiudad" class="form-control">
                            <option>Cali</option>
                            <option>Medellin</option>
                        </select>
                    </div>

                    <div class="col-lg-8 col-md-8 col-xs-12">
                        <label for="txtContacto">Contácto</label>
                        <input type="text" name="txtContacto" id="txtContacto" title="Contácto" placeholder="Contácto" required class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTel1">Teléfono1</label>
                        <input type="text" name="txtTel1" id="txtTel1" title="Teléfono 1" placeholder="Teléfono 1" required class="form-control">
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTel2">Teléfono2</label>
                        <input type="text" name="txtTel2" id="txtTel2" title="Teléfono 2" placeholder="Teléfono 2" required class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtMaxClientes">Clientes Permitidos</label>
                        <input type="number" name="txtMaxClientes" id="txtMaxClientes" title="Clientes Permitidos" placeholder="Clientes Permitidos" required class="form-control">
                    </div>

                     <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtAdicional">Precio Cliente Adicional</label>
                        <input type="text" name="txtAdicional" id="txtAdicional" title="Precio Cliente Adicional" onkeyup="format(this)" onchange="format(this)" placeholder="Precio Cliente Adicional" required class="form-control">
                    </div>

                     <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtSeguro">(%)Seguro</label>
                        <input type="text" name="txtSeguro" id="txtSeguro" title="(%)Seguro" placeholder="(%)Seguro" required class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                        <br>
                        <input type="submit" name="btnProcesar" class="btn btn-danger btn-large" value="Registrar Transportadora">
                    <div>
                </div>
                
            </form>
        </div>

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
         function format(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
  
else{ alert('Solo se permiten numeros');
input.value = input.value.replace(/[^\d\.]*/g,'');
}
}

    </script>

   
</body>
</html>
