<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$nit = $_REQUEST['txtNit'];
$nombre = $_REQUEST['txtTransportadora'];
$direccion = $_REQUEST['txtDireccion'];
$ciudad = $_REQUEST['txtCiudad'];
$tel1 = $_REQUEST['txtTel1'];
$tel2 = $_REQUEST['txtTel2'];
$mail = $_REQUEST['txtemail'];
$contacto1 = $_REQUEST['txtContacto1'];
$contacto2 = $_REQUEST['txtContacto2'];
$idRestriccion = $_REQUEST['txtRestriccion'];
$tipo = $_REQUEST['txtTipoEnvio'];
$maxclientes = $_REQUEST['txtMaxClientes'];
$adicional = $_REQUEST['txtAdicional'];
$seguro = $_REQUEST['txtSeguro'];

echo '<br>'.$nit;
echo '<br>'.$nombre;
echo '<br>'.$direccion;
echo '<br>'.$ciudad;
echo '<br>'.$tel1;
echo '<br>'.$tel2;
echo '<br>'.$mail;
echo '<br>'.$contacto1;
echo '<br>'.$contacto2;
echo '<br>'.$idRestriccion;
echo '<br>'.$tipo;
echo '<br>'.$maxclientes;
echo '<br>'.$adicional;
echo '<br>'.$seguro;




$sql = "INSERT INTO PruebaWilfred.dbo.interAppCIL_Transportadora(NitTransportadora, Transportadora, Direccion, CodCiudad, Telefono1, Telefono2, [e-mail], Contacto1, Contacto2, idRestriccion, idTipoEnvio, ClientesPermitidos, ValCliAdicional, Seguro, activa)
			VALUES     (?,?,?,?,?,?,?,?,?,?,?,?,?,?,1)";
$insertar = $pdo->prepare($sql);
try
{
	$insertar->execute([$nit, $nombre, $direccion, $ciudad, $tel1, $tel2, $mail, $contacto1,$contacto2, $idRestriccion, $tipo, $maxclientes, $adicional, $seguro]);
	echo "TRANSPORTADORA CREADA CORRECTAMENTE";
	header('Location: http://localhost/logistica/logistica_transportadoras.php');
	
}
catch(Exception $e)
{
	echo "No se pudo crear la Transportadora. Error: ".$e;
	
}



//$sentencia = $pdo->prepare($sql);





?>