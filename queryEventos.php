<?php

require_once("connection.php");

function createEvento($fechaEvento, $idCliente, $tipoEvento, $invitadosEvento, $horaInicioEvento, $horaFinEvento, $statusEvento, $comentariosEvento){

	$pdo = openConnection();
	$sql = "INSERT INTO eventos (fechaEvento, idCliente, tipoEvento, invitadosEvento, horaInicioEvento, horaFinEvento, 
									statusEvento, comentariosEvento, insertDate)
				VALUES (:fechaEvento, :idCliente, :tipoEvento, :invitadosEvento, :horaInicioEvento, :horaFinEvento,
						 :statusEvento, :comentariosEvento, now())";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':fechaEvento' => $fechaEvento,
							':idCliente' => $idCliente,
							':tipoEvento' => $tipoEvento,
							':invitadosEvento' => $invitadosEvento,
							':horaInicioEvento' => $horaInicioEvento,
							':horaFinEvento' => $horaFinEvento,
							':statusEvento' => $statusEvento,
							':comentariosEvento' => $comentariosEvento));
	echo $pdo->lastInsertId(); 
}

function updateEvento($idEvento, $idCliente, $tipoEvento, $invitadosEvento, $horaInicioEvento, $horaFinEvento, $statusEvento, $comentariosEvento) {

	$pdo = openConnection();
	$sql = "UPDATE eventos SET idCliente = :idCliente, tipoEvento = :tipoEvento, invitadosEvento = :invitadosEvento,
			horaInicioEvento = :horaInicioEvento, horaFinEvento = :horaFinEvento, statusEvento = :statusEvento,
			comentariosEvento = :comentariosEvento WHERE idEvento = :idEvento";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':idEvento' => $idEvento,
							':idCliente' => $idCliente,
							':tipoEvento' => $tipoEvento,
							':invitadosEvento' => $invitadosEvento,
							':horaInicioEvento' => $horaInicioEvento,
							':horaFinEvento' => $horaFinEvento,
							':statusEvento' => $statusEvento,
							':comentariosEvento' => $comentariosEvento));
	echo $stmt->rowCount();

}

function updateTotalEvento($idEvento, $totalEvento) {

	$pdo = openConnection();
	$sql = "UPDATE eventos SET totalEvento = :totalEvento WHERE idEvento = :idEvento";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':idEvento' => $idEvento,
							':totalEvento' => $totalEvento));
	echo $stmt->rowCount();

}

function getEventoAll(){

	$pdo = openConnection();

	$sql = "select idEvento, fechaEvento, statusEvento, nombreCliente from eventos inner join clientes on eventos.idCliente = clientes.idCliente";
	$stmt = $pdo->query($sql);

	$events = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    $start = $row['fechaEvento'];
	    //$end = $row['end'];
	    //$title = $row['statusEvento'];
	    $eventsArray['title'] = $row['nombreCliente'];
	    $eventsArray['start'] = $start;
	    $eventsArray['idEvento'] = $row['idEvento'];

	    switch ($row['statusEvento']) {
	    case "Ocupado":
	        $eventsArray['backgroundColor'] = '#BFF2CA';
	        break;
	    case "Apartado":
	        $eventsArray['backgroundColor'] = '#C7CED1';
	        break;
	    case "Cancelado":
	        $eventsArray['backgroundColor'] = '#FF8CA7';
	        break;
	    }
	    $events[] = $eventsArray;
	}
	echo json_encode($events);
}

function getEventoById($idEvento){
	$pdo = openConnection();
	$sql = "SELECT * FROM eventos inner join clientes on (eventos.idCliente = clientes.idCliente) WHERE idEvento = :idEvento";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array('idEvento' => $idEvento));

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $eventoDetalle['idEvento'] = $row['idEvento'];
            $eventoDetalle['nombreCliente'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['nombreCliente']);
            $eventoDetalle['idCliente'] = $row['idCliente'];
            $eventoDetalle['emailCliente'] = $row['emailCliente'];
            $eventoDetalle['telefonoCliente'] = $row['telefonoCliente'];        
            $eventoDetalle['statusEvento'] = $row['statusEvento'];
            $eventoDetalle['tipoEvento'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['tipoEvento']);
            //$date = new DateTime($row['fechaEventoCotizacion']);
            //$cotizacionDetalle['fechaEventoCotizacion'] = $date->format('Y-m-d');
            $date = new DateTime($row['fechaEvento']);
        	$eventoDetalle['fechaEvento'] = $date->format('d-M-Y');   
            $eventoDetalle['invitadosEvento'] = $row['invitadosEvento'];
            $eventoDetalle['horaInicioEvento'] = $row['horaInicioEvento'];
            $eventoDetalle['horaFinEvento'] = $row['horaFinEvento'];
            $eventoDetalle['factura'] = $row['factura'];               
            $eventoDetalle['comentariosEvento'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['comentariosEvento']);
        }    
echo json_encode($eventoDetalle, true);
}

function deleteEvento($idEvento) {
	$pdo = openConnection();
	$sql = "DELETE FROM eventos WHERE idEvento = :idEvento";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':idEvento' => $idEvento));
	echo $stmt->rowCount();
}

function getEventoByCliente($idCliente){
	$pdo = openConnection();
	$sql = "SELECT * FROM eventos inner join clientes on (eventos.idCliente = clientes.idCliente) WHERE clientes.idCliente = :idCliente";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array('idCliente' => $idCliente));

	$registrosArray = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $registroDetalle['idEvento'] = $row['idEvento'];
            $registroDetalle['nombreCliente'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['nombreCliente']);
            $registroDetalle['statusEvento'] = $row['statusEvento'];
            $registroDetalle['tipoEvento'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['tipoEvento']);
            //$date = new DateTime($row['fechaEventoCotizacion']);
            //$cotizacionDetalle['fechaEventoCotizacion'] = $date->format('Y-m-d');
        	$date = new DateTime($row['fechaEvento']);
        	$registroDetalle['fechaEvento'] = $date->format('d-M-Y');   
            $registroDetalle['invitadosEvento'] = $row['invitadosEvento'];
            $registroDetalle['horaInicioEvento'] = $row['horaInicioEvento'];
            $registroDetalle['horaFinEvento'] = $row['horaFinEvento'];
            $registroDetalle['factura'] = $row['factura'];               
            $registroDetalle['comentariosEvento'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['comentariosEvento']);
            $registrosArray[] = $registroDetalle;
        }    
echo json_encode($registrosArray, true);
}

function getEventosByServicio($idServicio) {
	$pdo = openConnection();
	$sql = "SELECT servicio_proveedor_evento.idEvento, fechaEvento, statusEvento from servicio_proveedor_evento 
			INNER JOIN eventos ON eventos.idEvento = servicio_proveedor_evento.idEvento  WHERE idServicio = :idServicio
			ORDER BY fechaEvento ASC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array('idServicio' => $idServicio));

	$registrosArray = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $registroDetalle['idEvento'] = $row['idEvento'];
        	$date = new DateTime($row['fechaEvento']);
        	$registroDetalle['fechaEvento'] = $date->format('d-M-Y');   
            $registroDetalle['statusEvento'] = $row['statusEvento'];
            $registrosArray[] = $registroDetalle;
        }    
echo json_encode($registrosArray, true);
}

?>