<?php
$txtUser = $_REQUEST['inputUser'];
$txtPwd = $_REQUEST['inputPwd'];
include 'conn.php';
include 'eas.php';
$eas = new eas();
//$valorLogin = $eas->usuarioLogin($pdo, $txtUser, $txtPwd); Original
$valorLogin = $eas->usuarioLogin($pdo, "sa", "inter"); //Prueba Wilfred


if($valorLogin==0){
    echo '<p align="center"><div class="alert alert-danger alert-dismissible" role="alert"><strong>Error:&nbsp;&nbsp;Datos no válidos</strong></div></p>';
}
else
{
    //El usuario existe
    session_start();
//    echo '<script>alert("'.$txtUser.'");</script>';
    //echo '<script>alert("Ingresa");</script>';
    //echo 'usernameEAS= '.$eas->consultaSQLValor($pdo, "CONTROL_OFIMAEnterprise.dbo.MTUSUARIO", "rtrim(CODUSUARIO)", "where CODUSUARIO='$txtUser'" );
    $_SESSION['codusuario'] = $eas->consultaSQLValor($pdo, "CONTROL_OFIMAEnterprise.dbo.MTUSUARIO", "rtrim(CODUSUARIO)", "where CODUSUARIO='$txtUser'" );
    $_SESSION['nombre'] = $eas->consultaSQLValor($pdo, "CONTROL_OFIMAEnterprise.dbo.MTUSUARIO", "rtrim(NOMBRE)", "where CODUSUARIO='$txtUser'" );
    $_SESSION['logueado']=1;
    $_SESSION['error']=0;
    echo '/redirect/';
}

?>