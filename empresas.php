<?php
    error_reporting(0);
    session_start();
    $error = $_SESSION['error'];
    $_SESSION['empresa']='';
    $codusuario = $_SESSION['codusuario'];
    //echo '<script>alert("Usuario: '.$codusuario.' ");</script>';

    if($error==1){
        echo '<script>error();</script>';
        unset($_SESSION["error"]);
        session_destroy();
    }

    include 'inc/conn.php';
    include 'inc/eas.php';
    //echo 'CodUsuario EAS: '.$codusuario;
    $eas = new eas();
    //Buscamos las respectivas empresas que tiene el usuario
    $empresas = $eas->usuarioEmpresas($pdo, $codusuario);
    //print_r($empresa);
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
    <link rel="stylesheet" href="assets/css/footer.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/promise-polyfill"></script>
</head>

<script>
    function error(){
        swal({
            type: 'error',
            title: 'ERROR',
            text: 'Ha intentado acceder a un sitio web con restrcciones.  Por favor ingrese con su usuario y contraseña',
            footer: 'Grupo Interllantas'
        })
    }

</script>

<body class="bg-white">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form id="frmEmpresa" name="frmEmpresa" method="post" action="inc/usuario_empresa.php" autocomplete="off">
                        <div class="form-group">
                            <label>Seleccione la empresa</label>
                            <select class="form-control" name="txtEmp" id="txtEmp">
                                <?php
                                    foreach ($empresas as $emp){
                                        //echo '<script>alert("'.$emp['Empresa'].'");</script>';
                                        $empresa = $emp['Empresa'];
                                        echo '<option value="'.$empresa.'">'.$empresa.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger btn-flat m-b-30 m-t-30" name="acceder" id="acceder">Seleccionar Empresa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <footer class="footer">
        <div class="container">
            <div align="center" style="color: #fff;"><span class="text-center"><strong>Departamento TI - Grupo Interllantas</strong></span></div>
        </div>
    </footer>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


</body>
</html>
