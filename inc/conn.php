<?php

session_start();
//$empresa = $_SESSION['empresa'];
//$empresa = 'CONTROL_OFIMAEnterprise';
$empresa = 'PruebaWilfred'; // pruebas
$largo = strlen($empresa);
if($largo==0){
    //$empresa='CONTROL_OFIMAEnterprise';
    $empresa = 'PruebaWilfred'; // pruebas
}

    $dsn = 'sqlsrv:Server=SISTEMAS\SQL;Database='.$empresa;
    $user = 'sa';
    $password = 'inter';

try{
    $pdo = new PDO($dsn,$user, $password);
    //echo 'Conexion Correcta';
  
}catch (PDOException $e){
    echo 'Error de conexión: <br>'.$e->getMessage();
}
?>