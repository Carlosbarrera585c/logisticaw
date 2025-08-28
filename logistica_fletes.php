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
            <p><h3>Fletes por Transportadoras</h3></p>
        </div> <!-- .content -->

        <div class="content mt-3">
            <!-- Contenido -->
            <form id="frmFletes" name="frmFletes" autocomplete="off" method="post" action="inc/logistica_fletes_insert.php">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTransportadora">Transportadora</label>
                        <select name="txtTransportadora" id="txtTransportadora" required class="form-control">
                            <option>TIMON S.A.</option>
                            <option>FRACOR S.A.S.</option>
                            <option>COMPAÑIA DE DISTRIBUCION Y TRANSPORTE S.A  DITRANSA</option>
                            <option>TRANSPORTE Y COMERCIO INTERNACIONAL LIMITADA.</option>
                            <option>OMEGA LTDA</option>
                            <option>EDUARDO BOTERO SOTO Y CIA  LTDA.</option>
                        </select>                       
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtTipoEnvio">Tipo de Envio</label>
                        <select name="txtTipoEnvio" id="txtTipoEnvio" required class="form-control">
                            <option>Paqueteo</option>
                            <option>Masivo</option>
                            <option>Redespacho</option>
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtOrigen">Ciudad Origen</label>
                        <select name="txtOrigen" id="txtOrigen" required class="form-control">
                            <option>Cali</option>
                            <option>Medellin</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtDestino">Ciudad Destino</label>
                        <select name="txtDestino" id="txtDestino" required class="form-control">
                            <option>Cali</option>
                            <option>Medellin</option>
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
                         <input type="text" name="txtValorFeteA" id="txtValorFeteA" title="Valor Flete A" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete A" required class="form-control">
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtValorFeteB">Valor Flete B</label>
                         <input type="text" name="txtValorFeteB" id="txtValorFeteB" title="Valor Flete B" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete B" required class="form-control">
                    </div>
                   
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <label for="txtValorFeteC">Valor Flete C</label>
                         <input type="text" name="txtValorFeteC" id="txtValorFeteC" title="Valor Flete C" onkeyup="format(this)" onchange="format(this)" placeholder="Valor Flete C" required class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtVigenciaDesde">Vigencia desde</label>
                         <input type="date" name="txtVigenciaDesde" id="txtVigenciaDesde" title="Vigencia desde"  placeholder="Vigencia desde" required class="form-control">
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <label for="txtVigenciaHasta">Vigencia hasta</label>
                         <input type="date" name="txtVigenciaHasta" id="txtVigenciaHasta" title="Vigencia hasta"  placeholder="Vigencia hasta" required class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                        <br>
                        <input type="submit" name="btnProcesar" class="btn btn-danger btn-large" value="Registrar Fletes">
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
    <script>
        function aMayusculas(obj,id){
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
        }
   </script> 

</body>
</html>
