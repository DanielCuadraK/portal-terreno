<?php
require "connection.php";


function getClienteId($nombre) {
    require "connection.php";
    $queryClientes = "SELECT idCliente FROM clientes WHERE nombreCliente = '".$nombre."'";
	$conn->real_query($queryClientes);
	$res = $conn->use_result();
	while ($row = $res->fetch_assoc()) {
	    $id = $row['idCliente'];
    }
    return $id;
}

function creaNuevoCliente($nombre) {

	require "connection.php";
	$sql = "INSERT INTO clientes (nombreCliente, flagActivoCliente) VALUES ('".$nombre."')";
	$conn->query($sql);
	$conn->close();
	return getClienteId($nombre);
}

$nombreCliente = $_POST["nombreCliente"];

$idCliente = getClienteId($nombreCliente);

 if (is_null($idCliente))
{
 	$idCliente = creaNuevoCliente($nombreCliente);
}

$fecha = $_POST["fechaEvento"];
$sql = "INSERT INTO eventos (fechaEvento, idCliente, statusEvento)
VALUES ('".$fecha."', ".$idCliente.",'".$_POST["statusEvento"]."')";
$conn->query($sql);
$conn->close();

?>