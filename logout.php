<?php
    session_start();
    unset($_SESSION["codusuario"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["logueado"]);
    unset($_SESSION["empresa"]);
    session_destroy();
    header('location: index.php');
?>