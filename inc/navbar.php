<?php
    //session_start();

//EAS (25-05-2019):  Se comentan estas líneas para poder realizar desarrollo Interfaz.  Se debe habilitar para producción.
/*
    error_reporting(0);
    if($_SESSION['logueado']==0){
        $_SESSION['error']=1;
        //session_destroy();
        header('Location: index.php');
    }
*/
?>
<nav class="navbar navbar-expand-sm navbar-default">
<script src="assets/js/logistica_menu.js"></script>
    <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="main.php"><img src="images/logow.png" alt="Logo"></a></div>
        <a class="navbar-brand hidden" href="main.php"><img src="images/logo2.png" alt="Logo"></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <!--
            <li class="active">
                <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
            </li>
            -->
            <h3 class="menu-title">Menú Principal</h3><!-- /.menu-title -->

            <!--
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-pencil-square-o"></i>Compras</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-pencil-square-o"></i><a href="compras_solicitud.php">Requisición</a></li>
                </ul>
            </li>
            -->
<!--
            <li class="menu-item">
                <a href="gerencial.php"> <i class="menu-icon fa fa-pencil-square-o"></i>Gerencial</a>
            </li>
-->

            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-pencil-square-o"></i>Logistica</a>
                <ul class="sub-menu children dropdown-menu">
                	<li><i class="fa fa-cogs"></i><a href="logistica_corte.php" title="Corte Documental">Corte Documental</a></li>
                    <li id="programacion"><i class="fa fa-cogs"></i><a href="#">Programación</a></li>
                    <li><i class="fa  fa-check-square-o"></i><a href="logistica_confirmacion.php" title="Confirmacion de Vehiculos">Confirmacion</a></li>
                    <li><i class="fa fa-users"></i><a href="logistica_conductores.php">Conductores</a></li>
                    <li><i class="fa fa-truck"></i><a href="logistica_vehiculos.php">Vehiculos</a></li>
                    <li><i class="fa fa-university"></i><a href="logistica_transportadoras.php">Transportadoras</a></li>
                    <li><i class="fa fa-money"></i><a href="logistica_fletesxtransportadora.php" title="Fletes por transportadora">Fletes</a></li>
                </ul>
            </li>


<?php
/*
    $codusuario = $_SESSION['codusuario'];
    $sqlPermisos = "select ID_APP from interApp_UsuariosAplicaciones where CODUSUARIO = '$codusuario'";
//    /echo $sqlPermisos;
    $statement = $pdo->prepare($sqlPermisos);
    $statement->execute(array());
    $result = $statement->fetchAll();
    $valor='';
    foreach ($result as $rs){
        $valor = $rs['ID_APP'];

        if($valor==5){
            //LOGISTICA
            ?>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-pencil-square-o"></i>Logistica</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-pencil-square-o"></i><a href="remisiones.php">Facturar Remisión</a></li>
                </ul>
            </li>
            <?php
        }
    }
*/
?>
            <h3 class="menu-title"></h3>
            <li class="menu-item-has-children">
                <a href="#" onclick="MensajeSalir();" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-close"></i>Salir</a>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>



<script src="assets/js/sweetalert2.all.min.js"></script>
<script src="https://unpkg.com/promise-polyfill"></script>
<script>
    function MensajeSalir() {
        swal({
            title: 'SALIR',
            text: "Desea salir de la aplicación",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#b21f2d',
            cancelButtonColor: '#343a40',
            cancelButtonText: 'No',
            confirmButtonText: 'Si, Salir de la aplicación'
        }).then((result) => {
            if (result.value) {
                window.location = "logout.php";
            }
        })
    }
</script>