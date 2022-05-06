<?php

require_once("connection.php");

function getClienteById($idCliente)
{
    $pdo = openConnection();

    $sql = "select * from clientes where idCliente = :idCliente";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idCliente' => $idCliente));

    $clientesArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $clienteDetalle['idCliente'] = $row['idCliente'];
        $clienteDetalle['nombreCliente'] = $row['nombreCliente'];
        $clienteDetalle['emailCliente'] = $row['emailCliente'];
        $clienteDetalle['telefonoCliente'] = $row['telefonoCliente'];
        $clientesArray[] = $clienteDetalle;
    }
    echo json_encode($clienteDetalle, true);
}

function getClienteId($nombreCliente) {
    $pdo = openConnection();
    $sql = "SELECT idCliente FROM clientes WHERE nombreCliente = :nombreCliente AND flagActivo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCliente' => $nombreCliente));

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    $id = $row['idCliente'];
    }
    return $id;
}

function getClienteAll($nombreCliente){

    $pdo = openConnection();

    $sql = "SELECT * FROM clientes WHERE flagActivo = 1 AND nombreCliente like :nombreCliente ORDER BY idCliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCliente' => '%'.$nombreCliente.'%'));

        $clientesArray =  array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clienteDetalle['idCliente'] = $row['idCliente'];
            $clienteDetalle['nombreCliente'] = $row['nombreCliente'];
            $clienteDetalle['emailCliente'] = $row['emailCliente'];
            $clienteDetalle['telefonoCliente'] = $row['telefonoCliente'];
            $clientesArray[] = $clienteDetalle;
        }
        echo json_encode($clientesArray, true);
}

function getClienteAllPagina($nombreCliente, $paginaActual){

    $paginaActual = ($paginaActual - 1) * 10;
    $pdo = openConnection();

    $sql = "SELECT * FROM clientes WHERE flagActivo = 1 AND nombreCliente like :nombreCliente 
            ORDER BY idCliente LIMIT ".$paginaActual." , 10";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCliente' => '%'.$nombreCliente.'%'));

        $clientesArray =  array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clienteDetalle['idCliente'] = $row['idCliente'];
            $clienteDetalle['nombreCliente'] = $row['nombreCliente'];
            $clienteDetalle['emailCliente'] = $row['emailCliente'];
            $clienteDetalle['telefonoCliente'] = $row['telefonoCliente'];
            $clientesArray[] = $clienteDetalle;
        }
        echo json_encode($clientesArray, true);
}

function getClienteByNombre($nombreCliente){

    $pdo = openConnection();

    $sql = "SELECT * from clientes WHERE nombreCliente like :nombreCliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCliente' => '%'.$nombreCliente.'%'));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $clienteDetalle['idCliente'] = $row['idCliente'];
        $clienteDetalle['nombreCliente'] = $row['nombreCliente'];
        $clienteDetalle['emailCliente'] = $row['emailCliente'];
        $clienteDetalle['telefonoCliente'] = $row['telefonoCliente'];
        $clientesArray[] = $clienteDetalle;
    }
    echo json_encode($clienteDetalle, true);

}

function getClienteByNombreAutocomplete($nombreCliente){

    $pdo = openConnection();

    $sql = "SELECT nombreCliente as value, idCliente as id from clientes WHERE nombreCliente like :nombreCliente 
            AND flagActivo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCliente' => '%'.$nombreCliente.'%'));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $row['value']=htmlentities(stripslashes($row['value']));
            $row['id']=(int)$row['id'];
            $clientesArray[] = $row;//build an array
    }
    echo json_encode($clientesArray);//format the array into json data

}


function createCliente($nombreCliente, $emailCliente, $telefonoCliente){

    $pdo = openConnection();
    $sql = "INSERT INTO clientes (nombreCliente, emailCliente, telefonoCliente, flagActivo) 
            VALUES (:nombreCliente, :emailCliente, :telefonoCliente, :flagActivo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCliente' => $nombreCliente,
                            ':emailCliente' => $emailCliente,
                            ':telefonoCliente' => $telefonoCliente,
                            ':flagActivo' => '1'));
    echo $stmt->rowCount();
}

function updateCliente($idCliente, $nombreCliente, $emailCliente, $telefonoCliente){

    $pdo = openConnection();
    $sql = "UPDATE clientes SET nombreCliente = :nombreCliente, emailCliente= :emailCliente, 
            telefonoCliente= :telefonoCliente where idCliente = :idCliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCliente' => $nombreCliente,
                            ':emailCliente' => $emailCliente,
                            ':telefonoCliente' => $telefonoCliente,
                            ':idCliente' => $idCliente));
    echo $stmt->rowCount();
}

function deleteCliente($idCliente){

    $pdo = openConnection();
    $sql = "UPDATE clientes SET flagActivo = 0 WHERE idCliente= :idCliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idCliente' => $idCliente));
    echo $stmt->rowCount();
}

function getClienteAllCount($nombreCliente){

    $pdo = openConnection();

    $sql = "SELECT COUNT(idCliente)/10 as pagesNumber FROM clientes WHERE flagActivo = 1 AND nombreCliente like :nombreCliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCliente' => '%'.$nombreCliente.'%'));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clienteCount['pagesNumber'] = ceil($row['pagesNumber']);
        }
        echo json_encode($clienteCount, true);
}
?>