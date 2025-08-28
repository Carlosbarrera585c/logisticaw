<?php

include 'conn.php';
include 'eas.php';
$eas = new eas();
	//Capturamos Variables

$nit = $_POST['updateNit'];
$direccion = $_POST['updateDireccion'];
$ciudad = $_POST['updateCiudad'];
$tel1 = $_POST['updateTelPrinc'];
$tel2 = $_POST['updateTel2'];
$email = $_POST['updateemail'];
$contacto1 = $_POST['updateContacto1'];
$contacto2 = $_POST['updateContacto2'];
$restriccion = $_POST['updateRestriccion'];
$tipo = $_POST['updateTipoEnvio'];
$permitidos = $_POST['updateMaxClientes'];
$adicional = $_POST['updateAdicional'];
$seguro = $_POST['updateSeguro'];

echo '<br>'.$nit;
echo '<br>'.$direccion;
echo '<br>'.$ciudad;
echo '<br>'.$tel1;
echo '<br>'.$tel2;
echo '<br>'.$email;
echo '<br>'.$contacto1;
echo '<br>'.$contacto2;
echo '<br>'.$restriccion;
echo '<br>'.$tipo;
echo '<br>'.$permitidos;
echo '<br>'.$adicional;
echo '<br>'.$seguro;

$sql = "UPDATE PruebaWilfred.dbo.interAppCIL_Transportadora
SET                Direccion =?, CodCiudad =?, Telefono1 =?, Telefono2 =?, [e-mail] =?, Contacto1 =?, Contacto2 =?, idRestriccion =?, idTipoEnvio =?, ClientesPermitidos =?, ValCliAdicional =?, Seguro =?, activa = 1
WHERE        (NitTransportadora = ?)";

$actualizar = $pdo->prepare($sql);
try
{
	$actualizar->execute([$direccion, $ciudad, $tel1, $tel2, $email, $contacto1, $contacto2, $restriccion, $tipo, $permitidos, $adicional, $seguro, $nit]);

	echo "TRANSPORTADORA ACTUALIZADA CORRECTAMENTE";
	//header('Location: http://localhost/logistica/logistica_transportadoras.php');
	
}
catch(Exception $e)
{
	echo "No se pudo Actualizar el Vehiculo. Error: ".$e;
	
}



?>