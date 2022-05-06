<?php

require_once("connection.php");

function getServicioByEvento($idEvento)
{
    $pdo = openConnection();

    $sql = "SELECT idServicioProveedorEvento, descripcionServicio, (cantidadServicio * servicio_proveedor_evento.precioUnitarioServicio) AS precioServicio, cantidadServicio FROM servicio_proveedor_evento, proveedores, servicios
        WHERE servicio_proveedor_evento.idProveedor = proveedores.idProveedor 
        AND servicio_proveedor_evento.idServicio = servicios.idServicio
        AND idEvento = :idEvento
        ORDER BY descripcionServicio";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idEvento' => $idEvento));

    $serviciosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $servicioDetalle['idServicioProveedorEvento'] = $row['idServicioProveedorEvento'];
        $servicioDetalle['descripcionServicio'] = $row['descripcionServicio']; 
        $servicioDetalle['precioServicio'] = $row['precioServicio'];
        $servicioDetalle['cantidadServicio'] = $row['cantidadServicio'];
        $serviciosArray[] = $servicioDetalle;
    }
    echo json_encode($serviciosArray, true);
}

function getTotalServicioByEvento($idEvento) {
    $pdo = openConnection();
    $sql = "SELECT SUM(cantidadServicio * precioUnitarioServicio) AS totalEvento FROM servicio_proveedor_evento
        WHERE idEvento = :idEvento";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idEvento' => $idEvento));


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $servicioDetalle['totalEvento'] = $row['totalEvento'];
    }
    return $servicioDetalle['totalEvento'];
}

function createServicioProveedorEvento($idEvento, $idServicio, $idProveedor, $cantidadServicio, $precioUnitarioServicio){
    $pdo = openConnection();
    $sql = "INSERT INTO servicio_proveedor_evento (idEvento, idServicio, idProveedor, cantidadServicio, precioUnitarioServicio, insertDate)
            VALUES (:idEvento, :idServicio, :idProveedor, :cantidadServicio, :precioUnitarioServicio, now())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idEvento' => $idEvento,
                            ':idServicio' => $idServicio,
                            ':idProveedor' => $idProveedor,
                            ':cantidadServicio' => $cantidadServicio,
                            ':precioUnitarioServicio' => $precioUnitarioServicio));
    echo $stmt->rowCount();    
}

function updateServicioProveedorEvento ($idServicioProveedorEvento, $idProveedor, $cantidadServicio, $costoUnitarioServicio , $comentariosServicioProveedorEvento){
    $pdo = openConnection();
    $sql = "UPDATE servicio_proveedor_evento SET idProveedor = :idProveedor, cantidadServicio = :cantidadServicio,
            costoUnitarioServicio = :costoUnitarioServicio, comentariosServicioProveedorEvento = :comentariosServicioProveedorEvento WHERE idServicioProveedorEvento = :idServicioProveedorEvento;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicioProveedorEvento' => $idServicioProveedorEvento,
                            ':idProveedor' => $idProveedor,
                            ':cantidadServicio' => $cantidadServicio,
                            ':costoUnitarioServicio' => $costoUnitarioServicio,
                            ':comentariosServicioProveedorEvento' => $comentariosServicioProveedorEvento));
    echo $stmt->rowCount();    
}

function deleteServicioProveedorEvento($idServicioProveedorEvento){
    $pdo = openConnection();
    $sql = "DELETE FROM servicio_proveedor_evento WHERE idServicioProveedorEvento = :idServicioProveedorEvento";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicioProveedorEvento' => $idServicioProveedorEvento));
    echo $stmt->rowCount();
}

function getServicioAutocomplete($descripcionServicio){

    $pdo = openConnection();

    $sql = "SELECT descripcionServicio as value, idServicio as id from servicios WHERE descripcionServicio like :descripcionServicio 
            AND flagActivo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':descripcionServicio' => '%'.$descripcionServicio.'%'));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $row['value']=htmlentities(stripslashes($row['value']));
            $row['id']=(int)$row['id'];
            $serviciosArray[] = $row;//build an array
    }
    echo json_encode($serviciosArray);//format the array into json data

} 

function getServicioAll(){

    $pdo = openConnection();

    $sql = "SELECT idServicio, descripcionServicio, precioUnitarioServicio from servicios WHERE flagActivo = 1 order by descripcionServicio";
    $stmt = $pdo->query($sql);

    $registrosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['descripcionServicio']= $row['descripcionServicio'];
            $registroDetalle['idServicio']= $row['idServicio'];
            $registroDetalle['precioUnitarioServicio']= $row['precioUnitarioServicio'];
            $registrosArray[] = $registroDetalle;//build an array
    }
    
    echo json_encode($registrosArray);//format the array into json data

}

function getServicioByDescripcion($descripcionServicio){

    $pdo = openConnection();

    $sql = "SELECT idServicio, descripcionServicio, precioUnitarioServicio from servicios WHERE flagActivo = 1 AND descripcionServicio LIKE :descripcionServicio
            order by descripcionServicio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':descripcionServicio' => '%'.$descripcionServicio.'%'));

    $registrosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['descripcionServicio']= $row['descripcionServicio'];
            $registroDetalle['idServicio']= $row['idServicio'];
            $registroDetalle['precioUnitarioServicio']= $row['precioUnitarioServicio'];
            $registrosArray[] = $registroDetalle;//build an array
    }
    
    echo json_encode($registrosArray);//format the array into json data

}

function getServicioById($idServicio){

    $pdo = openConnection();

    $sql = "SELECT * from servicios WHERE idServicio = :idServicio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicio' => $idServicio));

    $serviciosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['idServicio']= $row['idServicio'];
            $registroDetalle['descripcionServicio']= $row['descripcionServicio'];
            $registroDetalle['comentariosServicio']= $row['comentariosServicio'];
            $registroDetalle['precioUnitarioServicio']= $row['precioUnitarioServicio'];
            $registroDetalle['unidadMedidaServicio']= $row['unidadMedidaServicio'];            
    }
    
    echo json_encode($registroDetalle);//format the array into json data

}  

function getServicioPrecioUnitarioById($idServicio){

    $pdo = openConnection();

    $sql = "SELECT * from servicios WHERE idServicio = :idServicio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicio' => $idServicio));

    $serviciosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['precioUnitarioServicio']= $row['precioUnitarioServicio'];        
    }
    
    return $registroDetalle['precioUnitarioServicio']; 

}  

function createServicio($descripcionServicio, $comentariosServicio, $precioUnitarioServicio, $unidadMedidaServicio){
    $pdo = openConnection();
    $sql = "INSERT INTO servicios (descripcionServicio, comentariosServicio, precioUnitarioServicio, unidadMedidaServicio, insertDate, flagActivo)
            VALUES (:descripcionServicio, :comentariosServicio, :precioUnitarioServicio, :unidadMedidaServicio, now(), 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':descripcionServicio' => $descripcionServicio,
                            ':comentariosServicio' => $comentariosServicio,
                            ':precioUnitarioServicio' => $precioUnitarioServicio,
                            ':unidadMedidaServicio' => $unidadMedidaServicio));
    echo $stmt->rowCount();    
}

function updateServicio($idServicio, $descripcionServicio, $comentariosServicio, $precioUnitarioServicio, $unidadMedidaServicio){
    $pdo = openConnection();
    $sql = "UPDATE servicios SET descripcionServicio = :descripcionServicio, comentariosServicio = :comentariosServicio, 
            precioUnitarioServicio = :precioUnitarioServicio, unidadMedidaServicio = :unidadMedidaServicio
            WHERE idServicio = :idServicio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicio' => $idServicio,
                            ':descripcionServicio' => $descripcionServicio,
                            ':comentariosServicio' => $comentariosServicio,
                            ':precioUnitarioServicio' => $precioUnitarioServicio,
                            ':unidadMedidaServicio' => $unidadMedidaServicio));
    echo $stmt->rowCount();    
}

function deleteServicio($idServicio){
    $pdo = openConnection();
    $sql = "UPDATE servicios SET flagActivo = 0
            WHERE idServicio = :idServicio";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicio' => $idServicio));
    echo $stmt->rowCount();    
}

function getServicioProveedorEventoById($idServicioProveedorEvento) {
    $pdo = openConnection();

    $sql = "SELECT idServicioProveedorEvento, comentariosServicioProveedorEvento, servicios.idServicio, proveedores.idProveedor, idEvento, descripcionServicio, empresaProveedor, cantidadServicio, costoUnitarioServicio 
            FROM servicio_proveedor_evento INNER JOIN servicios ON servicio_proveedor_evento.idServicio = servicios.idServicio 
            INNER JOIN proveedores ON servicio_proveedor_evento.idProveedor = proveedores.idProveedor 
            WHERE idServicioProveedorEvento = :idServicioProveedorEvento";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicioProveedorEvento' => $idServicioProveedorEvento));

    $serviciosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['idEvento'] = $row['idEvento']; 
            $registroDetalle['idServicio'] = $row['idServicio'];
            $registroDetalle['idProveedor'] = $row['idProveedor'];
            $registroDetalle['descripcionServicio'] = $row['descripcionServicio']; 
            $registroDetalle['empresaProveedor'] = $row['empresaProveedor'];
            $registroDetalle['cantidadServicio'] = $row['cantidadServicio'];
            $registroDetalle['costoUnitarioServicio'] = $row['costoUnitarioServicio'];
            $registroDetalle['comentariosServicioProveedorEvento'] = $row['comentariosServicioProveedorEvento'];
            $registroDetalle['costoTotalServicio'] = $registroDetalle['cantidadServicio'] * $registroDetalle['costoUnitarioServicio'];
    }
    
    echo json_encode($registroDetalle);//format the array into json data
}


?>