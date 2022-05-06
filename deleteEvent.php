<?php
require "connection.php";

//$sql = "INSERT INTO eventos (fechaEvento, cliente, tipoEvento, invitados, horarioInicio, horarioFin, status, comentarios)
//VALUES ('".$_POST["fechaEvento"]."', '".$_POST["cliente"]."', '".$_POST["tipoEvento"]."','".$_POST["invitados"]."'".$_POST["horarioInicio"].
//	"'".$_POST["horarioFin"]."'1','".$_POST["comentarios"]."')";
$sql = "DELETE FROM eventos WHERE idEvento = ".$_POST["idEvento"];
$conn->query($sql);
$conn->close();
?>