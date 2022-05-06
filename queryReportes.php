<?php

require_once("connection.php");

function getReporteServicios()
{
    $pdo = openConnection();

    $sql = "SELECT fechaEvento, descripcionServicio, cantidadServicio 
            FROM eventos INNER JOIN servicio_proveedor_evento ON servicio_proveedor_evento.idEvento = eventos.idEvento 
            INNER JOIN servicios ON servicio_proveedor_evento.idServicio = servicios.idServicio
            WHERE servicios.idServicio NOT IN (1,2)
            ORDER BY fechaEvento DESC";

    $stmt = $pdo->query($sql);

    $registrosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $date = new DateTime($row['fechaEvento']);
        $registroDetalle['fechaEvento'] = $date->format('d-M-Y');   
        $registroDetalle['descripcionServicio'] = $row['descripcionServicio']; 
        $registroDetalle['cantidadServicio'] = $row['cantidadServicio'];
        $registrosArray[] = $registroDetalle;
    }
    echo json_encode($registrosArray, true);
}

function getReporteRentas($fechaInicial, $fechaFinal, $statusEvento)
{
    $pdo = openConnection();

    $sql = "SELECT month(fechaEvento) AS mes, count(idEvento) AS cantidad FROM eventos
            WHERE statusEvento = :statusEvento AND fechaEvento >= :fechaInicial AND fechaEvento <= :fechaFinal
            GROUP BY month(fechaEvento)";

    //$stmt = $pdo->query($sql);
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':statusEvento' => $statusEvento,
                          ':fechaInicial' => $fechaInicial,
                          ':fechaFinal' => $fechaFinal));

    $registrosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        //$date = new DateTime($row['fechaEvento']);
        switch($row['mes']){
            case "1":
            $registroDetalle['mes'] = "Enero";
            break;
            case "2":
            $registroDetalle['mes'] = "Febrero";
            break;
            case "3":
            $registroDetalle['mes'] = "Marzo";
            break;
            case "4":
            $registroDetalle['mes'] = "Abril";
            break;
            case "5":
            $registroDetalle['mes'] = "Mayo";
            break;
            case "6":
            $registroDetalle['mes'] = "Junio";
            break;
            case "7":
            $registroDetalle['mes'] = "Julio";
            break;
            case "8":
            $registroDetalle['mes'] = "Agosto";
            break;
            case "9":
            $registroDetalle['mes'] = "Septiembre";
            break;
            case "10":
            $registroDetalle['mes'] = "Octubre";
            break;
            case "11":
            $registroDetalle['mes'] = "Noviembre";
            break;
            case "12":
            $registroDetalle['mes'] = "Diciembre";
            break;
        }
        //$registroDetalle['mes'] = $row['mes'];   
        $registroDetalle['cantidad'] = $row['cantidad']; 
        $registrosArray[] = $registroDetalle;
    }
    echo json_encode($registrosArray, true);
}




?>