<?
require "queryClientes.php";

switch ($_POST['action']) {
    case "getClienteById":
        getClienteById($_POST['idCliente']);
        break;
    case "getClienteAll":
        getClienteAll($_POST['nombreCliente']);
        break;
    case "getClienteByNombre":
        getClienteByNombre($_POST['nombreCliente']);
        break;
    case "createCliente":
        createCliente($_POST['nombreCliente'],$_POST['emailCliente'],$_POST['telefonoCliente']);
        break;
    case "updateCliente":
        updateCliente($_POST['idCliente'],$_POST['nombreCliente'],$_POST['emailCliente'],$_POST['telefonoCliente']);
        break;
    case "deleteCliente":
        deleteCliente($_POST['idCliente']);
        break;
}
?>