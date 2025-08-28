<?php
    error_reporting(0);
    session_destroy();
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

<script type="text/javascript">
    $(function (){
        $("#acceder").click(function(){
            var url = 'inc/login.php';
            $.ajax({
                type: "POST",
                url: url,
                data: $("#frmLogin").serialize(),
                success: function(response){
                    $("#respuesta").html(response);
                    if(response.match(/redirect/)){
                        window.location.href = "empresas.php";
                    }
                    else{
                        $("#respuesta").html(response);
                    }
                }
            });
            return false;
        });
    });
</script>

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
<?php
session_start();
$error = $_SESSION['error'];

if($error==1){
    echo '<script>error();</script>';
    unset($_SESSION["error"]);
    session_destroy();
}

?>
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form id="frmLogin" name="frmLogin" autocomplete="off">
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" class="form-control" placeholder="Usuario" name="inputUser" id="inputUser">
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" placeholder="Contraseña" name="inputPwd" id="inputPwd">
                        </div>
                        <button type="submit" class="btn btn-danger btn-flat m-b-30 m-t-30" name="acceder" id="acceder">Acceder</button>
                        <div class="register-link m-t-15 text-center">
                            <div id="respuesta" style="color: #FFFFFF"></div>
                        </div>
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
