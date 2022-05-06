<?php
require_once("connection.php");

function getCotizacionAll(){

$pdo = openConnection();

$sql = 'SELECT * FROM cotizaciones WHERE flagActivo = 1 ORDER BY idCotizacion DESC';
$stmt = $pdo->query($sql); 

$cotizacionesArray =  array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cotizacionDetalle['idCotizacion'] = $row['idCotizacion'];
            $cotizacionDetalle['nombreCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['nombreCotizacion']);
            $cotizacionDetalle['emailCotizacion'] = $row['emailCotizacion'];
            $cotizacionDetalle['telefonoCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['telefonoCotizacion']);
            $date = new DateTime($row['fechaEventoCotizacion']);
            $cotizacionDetalle['fechaEventoCotizacion'] = $date->format('d-M-Y');
            $cotizacionDetalle['comentariosCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['comentariosCotizacion']);
            $cotizacionDetalle['insertDate'] = $row['insertDate'];
            $cotizacionDetalle['asistentesCotizacion'] = $row['asistentesCotizacion'];
            $cotizacionDetalle['tipoEventoCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['tipoEventoCotizacion']);
            $cotizacionDetalle['origenCotizacion'] = $row['origenCotizacion'];
            $cotizacionDetalle['statusCotizacion'] = $row['statusCotizacion'];
            $cotizacionesArray[] = $cotizacionDetalle;
        }    
echo json_encode($cotizacionesArray, true);

}

function getCotizacionByStatus($statusCotizacion){

$pdo = openConnection();

$sql = 'SELECT * FROM cotizaciones WHERE flagActivo = 1 AND statusCotizacion = :statusCotizacion ORDER BY idCotizacion DESC';
$stmt = $pdo->prepare($sql); 
$stmt->execute(array(':statusCotizacion' => $statusCotizacion)); 

$cotizacionesArray =  array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cotizacionDetalle['idCotizacion'] = $row['idCotizacion'];
            $cotizacionDetalle['nombreCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['nombreCotizacion']);
            $cotizacionDetalle['emailCotizacion'] = $row['emailCotizacion'];
            $cotizacionDetalle['telefonoCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['telefonoCotizacion']);
            $date = new DateTime($row['fechaEventoCotizacion']);
            $cotizacionDetalle['fechaEventoCotizacion'] = $date->format('d-M-Y');
            $cotizacionDetalle['comentariosCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['comentariosCotizacion']);
            $cotizacionDetalle['insertDate'] = $row['insertDate'];
            $cotizacionDetalle['asistentesCotizacion'] = $row['asistentesCotizacion'];
            $cotizacionDetalle['tipoEventoCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['tipoEventoCotizacion']);
            $cotizacionDetalle['origenCotizacion'] = $row['origenCotizacion'];
            $cotizacionDetalle['statusCotizacion'] = $row['statusCotizacion'];
            $cotizacionesArray[] = $cotizacionDetalle;
        }    
echo json_encode($cotizacionesArray, true);

}

function getCotizacionById($idCotizacion){

$pdo = openConnection();

$sql = 'SELECT * FROM cotizaciones WHERE idCotizacion = :idCotizacion';
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':idCotizacion' => $idCotizacion)); 

$cotizacionesArray =  array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cotizacionDetalle['idCotizacion'] = $row['idCotizacion'];
            $cotizacionDetalle['nombreCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['nombreCotizacion']);
            $cotizacionDetalle['emailCotizacion'] = $row['emailCotizacion'];
            $cotizacionDetalle['telefonoCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['telefonoCotizacion']);
            $date = new DateTime($row['fechaEventoCotizacion']);
            $cotizacionDetalle['fechaEventoCotizacion'] = $date->format('Y-m-d');
            $cotizacionDetalle['comentariosCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['comentariosCotizacion']);
            $cotizacionDetalle['insertDate'] = $row['insertDate'];
            $cotizacionDetalle['asistentesCotizacion'] = $row['asistentesCotizacion'];
            $cotizacionDetalle['tipoEventoCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['tipoEventoCotizacion']);
            $cotizacionDetalle['origenCotizacion'] = $row['origenCotizacion'];
            $cotizacionDetalle['statusCotizacion'] = $row['statusCotizacion'];
        }    
echo json_encode($cotizacionDetalle, true);

}

function getCotizacionByFechaDisponible(){

$pdo = openConnection();

$sql = "SELECT * FROM cotizaciones WHERE fechaEventoCotizacion not IN (SELECT fechaEvento FROM eventos) 
        AND statusCotizacion = 'Abierta' AND flagActivo = 1 ORDER BY fechaEventoCotizacion ASC";
$stmt = $pdo->query($sql);

$registrosArray =  array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $registroDetalle['idCotizacion'] = $row['idCotizacion'];
            $registroDetalle['nombreCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['nombreCotizacion']);
            $registroDetalle['emailCotizacion'] = $row['emailCotizacion'];
            $registroDetalle['telefonoCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['telefonoCotizacion']);
            $date = new DateTime($row['fechaEventoCotizacion']);
            $registroDetalle['fechaEventoCotizacion'] = $date->format('d-M-Y');
            $registroDetalle['comentariosCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['comentariosCotizacion']);
            $registroDetalle['insertDate'] = $row['insertDate'];
            $registroDetalle['asistentesCotizacion'] = $row['asistentesCotizacion'];
            $registroDetalle['tipoEventoCotizacion'] = iconv('UTF-8', 'UTF-8//IGNORE', $row['tipoEventoCotizacion']);
            $registroDetalle['origenCotizacion'] = $row['origenCotizacion'];
            $registroDetalle['statusCotizacion'] = $row['statusCotizacion'];
            $registrosArray[] = $registroDetalle;
        }    
echo json_encode($registrosArray, true);

}

function createCotizacion($nombreCotizacion, $emailCotizacion, $fechaEventoCotizacion, 
    $comentariosCotizacion, $asistentesCotizacion, $tipoEventoCotizacion, 
    $telefonoCotizacion, $origenCotizacion, $statusCotizacion) {

    $pdo = openConnection();
    $sql = "INSERT INTO cotizaciones (nombreCotizacion, emailCotizacion, fechaEventoCotizacion, comentariosCotizacion, 
                            insertDate, asistentesCotizacion, tipoEventoCotizacion, telefonoCotizacion, 
                            origenCotizacion, statusCotizacion, flagActivo)
            VALUES (:nombreCotizacion, :emailCotizacion, :fechaEventoCotizacion,
            :comentariosCotizacion,now(),:asistentesCotizacion,
            :tipoEventoCotizacion,:telefonoCotizacion,:origenCotizacion,:statusCotizacion, :flagActivo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nombreCotizacion' => $nombreCotizacion,
                            ':emailCotizacion' => $emailCotizacion,
                            ':fechaEventoCotizacion' => $fechaEventoCotizacion,
                            ':comentariosCotizacion' => $comentariosCotizacion,
                            ':asistentesCotizacion' => $asistentesCotizacion,
                            ':tipoEventoCotizacion' => $tipoEventoCotizacion,
                            ':telefonoCotizacion' => $telefonoCotizacion,
                            ':origenCotizacion' => $origenCotizacion,
                            ':statusCotizacion' => $statusCotizacion,
                            ':flagActivo' => '1'));
    echo $stmt->rowCount();

}

function deleteCotizacion($idCotizacion) {
    $pdo = openConnection();
    $sql = "UPDATE cotizaciones SET flagActivo = 0 WHERE idCotizacion= :idCotizacion";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idCotizacion' => $idCotizacion));
    echo $stmt->rowCount();
}

function updateCotizacion($idCotizacion, $nombreCotizacion, $emailCotizacion, $fechaEventoCotizacion, 
    $comentariosCotizacion, $asistentesCotizacion, $tipoEventoCotizacion, 
    $telefonoCotizacion, $origenCotizacion, $statusCotizacion) {

    $pdo = openConnection();
    $sql = "UPDATE cotizaciones SET nombreCotizacion = :nombreCotizacion,".
            "emailCotizacion = :emailCotizacion,".
            "fechaEventoCotizacion = :fechaEventoCotizacion,".
            "comentariosCotizacion = :comentariosCotizacion,". 
            "asistentesCotizacion = :asistentesCotizacion,".
            "tipoEventoCotizacion = :tipoEventoCotizacion,".
            "telefonoCotizacion = :telefonoCotizacion,".
            "origenCotizacion = :origenCotizacion,".
            "statusCotizacion = :statusCotizacion ".
            " WHERE idCotizacion = :idCotizacion";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idCotizacion' => $idCotizacion,
                            ':nombreCotizacion' => $nombreCotizacion,
                            ':emailCotizacion' => $emailCotizacion,
                            ':fechaEventoCotizacion' => $fechaEventoCotizacion,
                            ':comentariosCotizacion' => $comentariosCotizacion,
                            ':asistentesCotizacion' => $asistentesCotizacion,
                            ':tipoEventoCotizacion' => $tipoEventoCotizacion,
                            ':telefonoCotizacion' => $telefonoCotizacion,
                            ':origenCotizacion' => $origenCotizacion,
                            ':statusCotizacion' => $statusCotizacion));
    echo $stmt->rowCount();
}

function updateCotizacionStatus($idCotizacion, $statusCotizacion) {
    $pdo = openConnection();
    $sql = "UPDATE cotizaciones SET statusCotizacion = :statusCotizacion WHERE idCotizacion= :idCotizacion";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':statusCotizacion' => $statusCotizacion,
                            ':idCotizacion' => $idCotizacion));
    echo $stmt->rowCount();
}

function getCotizacionEventoAutocomplete($tipoEventoCotizacion){

    $pdo = openConnection();

    $sql = "SELECT distinct tipoEventoCotizacion as value, tipoEventoCotizacion as id from cotizaciones WHERE tipoEventoCotizacion like :tipoEventoCotizacion";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':tipoEventoCotizacion' => '%'.$tipoEventoCotizacion.'%'));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $row['value']=html_entity_decode(iconv('UTF-8', 'UTF-8//IGNORE', htmlentities(stripslashes($row['value']))));
            $row['id']=(int)$row['id'];
            $cotizacionesArray[] = $row;//build an array
    }
   // $cotizacionesArray = array_unique($cotizacionesArray);

    echo json_encode($cotizacionesArray);//format the array into json data

}
?>