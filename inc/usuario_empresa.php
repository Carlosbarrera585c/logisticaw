<?php
    include "eas.php";
    include "conn.php";
    $eas = new eas();
    $empresa = $_REQUEST['txtEmp'];
    //echo 'empresa: '.$empresa;
    $largo = strlen($empresa);
    if($largo>0){
        //Guardamos empresa en TMP
        //session_start();
        $_SESSION['empresa'] = $empresa;
        $codusuario = $_SESSION['codusuario'];
        //echo '$codusuario: '.$codusuario;
        //asignamos el CODCC del usuario
        //$_SESSION['codcc'] = $eas->consultaSQLValor($pdo, "interApp_UsuariosCodcc", "rtrim(CODCC)", "where CODUSUARIO='$codusuario'" );
        //$codccUsuario = $eas->consultaSQLValor($pdo, "interApp_UsuariosCodcc", "rtrim(CODCC)", "where CODUSUARIO='$codusuario'" );
        //echo 'CODCC: '.$codccUsuario;
        header('Location: ../main.php');
    }
?>