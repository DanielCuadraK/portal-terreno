<?php

require_once("connection.php");

function getAbonoByEvento($idEvento)
{
    $pdo = openConnection();

    $sql = "SELECT * FROM abonos WHERE idEvento = :idEvento AND flagActivo = 1 ORDER BY fechaAbono DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idEvento' => $idEvento));

    $abonosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $abonoDetalle['idAbono'] = $row['idAbono'];
        $date = new DateTime($row['fechaAbono']);
        $abonoDetalle['fechaAbono'] = $date->format('d-M-Y');   
        $abonoDetalle['nombreAbono'] = $row['nombreAbono'];
        $abonoDetalle['montoAbono'] = $row['montoAbono'];
        $abonoDetalle['recibioAbono'] = $row['recibioAbono'];
        $abonosArray[] = $abonoDetalle;
    }
    echo json_encode($abonosArray, true);
}

function createAbono($idEvento, $fechaAbono, $nombreAbono, $montoAbono, $recibioAbono, $formaPagoAbono, $comentariosAbono) {
    $pdo = openConnection();
    $sql = "INSERT INTO abonos (idEvento, fechaAbono, nombreAbono, montoAbono, recibioAbono, formaPagoAbono, comentariosAbono, insertDate, flagActivo) 
            VALUES (:idEvento, :fechaAbono, :nombreAbono, :montoAbono, :recibioAbono, :formaPagoAbono, :comentariosAbono, now(), 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idEvento' => $idEvento,
                            ':fechaAbono' => $fechaAbono,
                            ':nombreAbono' => $nombreAbono,
                            ':montoAbono' => $montoAbono,
                            ':recibioAbono' => $recibioAbono,
                            ':formaPagoAbono' => $formaPagoAbono,
                            ':comentariosAbono' => $comentariosAbono));
    echo $stmt->rowCount();

}

function deleteAbono($idAbono){
    $pdo = openConnection();
    $sql = "UPDATE abonos SET flagActivo = 0 WHERE idAbono = :idAbono";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idAbono' => $idAbono));
    echo $stmt->rowCount();
}

function getAbonoByServicio($idServicioProveedorEvento) {
    $pdo = openConnection();

    $sql = "SELECT * FROM abonos_servicios WHERE idServicioProveedorEvento = :idServicioProveedorEvento AND flagActivo = 1 ORDER BY fechaAbonoServicio DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicioProveedorEvento' => $idServicioProveedorEvento));

    $registrosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $registroDetalle['idAbonoServicio'] = $row['idAbonoServicio'];
        $date = new DateTime($row['fechaAbonoServicio']);
        $registroDetalle['fechaAbonoServicio'] = $date->format('d-M-Y');   
        $registroDetalle['nombreAbonoServicio'] = $row['nombreAbonoServicio'];
        $registroDetalle['montoAbonoServicio'] = $row['montoAbonoServicio'];
        $registroDetalle['recibioAbonoServicio'] = $row['recibioAbonoServicio'];
        $registrosArray[] = $registroDetalle;
    }
    echo json_encode($registrosArray, true);
}

function createAbonoServicio($idServicioProveedorEvento, $fechaAbonoServicio, $nombreAbonoServicio, $montoAbonoServicio, $recibioAbonoServicio) {
    $pdo = openConnection();
    $sql = "INSERT INTO abonos_servicios (idServicioProveedorEvento, fechaAbonoServicio, nombreAbonoServicio, montoAbonoServicio, recibioAbonoServicio, insertDate, flagActivo) 
            VALUES (:idServicioProveedorEvento, :fechaAbonoServicio, :nombreAbonoServicio, :montoAbonoServicio, :recibioAbonoServicio, now(), 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicioProveedorEvento' => $idServicioProveedorEvento,
                            ':fechaAbonoServicio' => $fechaAbonoServicio,
                            ':nombreAbonoServicio' => $nombreAbonoServicio,
                            ':montoAbonoServicio' => $montoAbonoServicio,
                            ':recibioAbonoServicio' => $recibioAbonoServicio));
    echo $stmt->rowCount();

}

function deleteAbonoServicio($idAbonoServicio){
    $pdo = openConnection();
    $sql = "UPDATE abonos_servicios SET flagActivo = 0 WHERE idAbonoServicio = :idAbonoServicio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idAbonoServicio' => $idAbonoServicio));
    echo $stmt->rowCount();
}


?>