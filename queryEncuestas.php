<?php

require_once("connection.php");

function createPreguntaEncuesta($preguntaEncuesta, $tipoPregunta){

	$pdo = openConnection();
	$sql = "INSERT INTO encuesta_preguntas (preguntaEncuesta, tipoPregunta, flagActivo)
				VALUES (:preguntaEncuesta, :tipoPregunta, 1)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':preguntaEncuesta' => $preguntaEncuesta,
						':tipoPregunta' => $tipoPregunta));
	echo $stmt->rowCount();
}

function createOpcionPreguntaEncuesta($idPregunta, $opcionPregunta){
	$pdo = openConnection();
	$sql = "INSERT INTO encuesta_opciones (idPregunta, opcionPregunta)
			VALUES (:idPregunta, :opcionPregunta)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':idPregunta' => $idPregunta,
						':opcionPregunta' => $opcionPregunta));
	echo $stmt->rowCount();
}

function createRespuestaEncuesta($idEvento, $idPregunta, $respuestaPregunta){
	$pdo = openConnection();
	$sql = "INSERT INTO encuesta_respuestas (idEvento, idPregunta, respuestaPregunta)
			VALUES (:idEvento, :idPregunta, :respuestaPregunta)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':idEvento' => $idEvento,
						':idPregunta' => $idPregunta,
						':respuestaPregunta' => $respuestaPregunta));
	echo $stmt->rowCount();
}

function getPreguntaEncuestaAll() {
	$pdo = openConnection();
	$sql = "SELECT * FROM encuesta_preguntas WHERE flagActivo = 1 ";
	$stmt = $pdo->query($sql);
	$registrosArray = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    $registroDetalle['idPregunta'] = $row['idPregunta'];
	    $registroDetalle['preguntaEncuesta'] = $row['preguntaEncuesta'];
	    $registroDetalle['tipoPregunta'] = $row['tipoPregunta'];
	    $registrosArray[] = $registroDetalle;
	}
	echo json_encode($registrosArray, true);
}

function getOpcionByPregunta($idPregunta) {
	$pdo = openConnection();
	$sql = "SELECT * FROM encuesta_opciones WHERE idPregunta = :idPregunta ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':idPregunta' => $idPregunta));
	$registrosArray = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    $registroDetalle['idOpcion'] = $row['idOpcion'];
	    $registroDetalle['idPregunta'] = $row['idPregunta'];
	    $registroDetalle['opcionPregunta'] = $row['opcionPregunta'];
	    $registrosArray[] = $registroDetalle;
	}
	echo json_encode($registrosArray, true);
}

function getRespuestaByEvento($idEvento) {
	$pdo = openConnection();
	$sql = "SELECT idEvento, idPregunta, preguntaEncuesta, respuestaEncuesta FROM encuesta_respuestas 
			INNER JOIN encuesta_preguntas ON encuesta_respuestas.idPregunta = encuesta_respuestas.idPregunta
			WHERE idEvento = :idEvento ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':idEvento' => $idEvento));
	$registrosArray = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	    $registroDetalle['idOpcion'] = $row['idOpcion'];
	    $registroDetalle['idPregunta'] = $row['idPregunta'];
	    $registroDetalle['opcionPregunta'] = $row['opcionPregunta'];
	    $registrosArray[] = $registroDetalle;
	}
	echo json_encode($registrosArray, true);
}

function deletePreguntaEncuesta($idPregunta) {
	$pdo = openConnection();
	$sql = "UPDATE  encuesta_preguntas SET flagActivo = 0
			WHERE idPregunta = :idPregunta";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':idPregunta' => $idPregunta));
	echo $stmt->rowCount();
}



?>