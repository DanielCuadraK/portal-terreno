<?php

require_once("connection.php");

function getProveedorAll(){

    $pdo = openConnection();

    $sql = "SELECT idProveedor, empresaProveedor from proveedores WHERE flagActivo = 1 order by empresaProveedor";
    $stmt = $pdo->query($sql);

    $registrosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['empresaProveedor']= $row['empresaProveedor'];
            $registroDetalle['idProveedor']= $row['idProveedor'];
            $registrosArray[] = $registroDetalle;//build an array
    }
    
    echo json_encode($registrosArray);//format the array into json data

}

function getProveedorById($idProveedor){

    $pdo = openConnection();

    $sql = "SELECT * from proveedores WHERE idProveedor = :idProveedor";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idProveedor' => $idProveedor));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['idProveedor']= $row['idProveedor'];
            $registroDetalle['empresaProveedor']= $row['empresaProveedor'];
            $registroDetalle['nombreProveedor']= $row['nombreProveedor'];
            $registroDetalle['telefono1Proveedor']= $row['telefono1Proveedor'];
            $registroDetalle['telefono2Proveedor']= $row['telefono2Proveedor'];  
            $registroDetalle['emailProveedor']= $row['emailProveedor'];      
    }
    
    echo json_encode($registroDetalle);//format the array into json data

}  

function createProveedor($empresaProveedor, $nombreProveedor, $emailProveedor, $telefono1Proveedor, $telefono2Proveedor){
    $pdo = openConnection();
    $sql = "INSERT INTO proveedores (empresaProveedor, nombreProveedor, emailProveedor, telefono1Proveedor, telefono2Proveedor, insertDate, flagActivo)
            VALUES (:empresaProveedor, :nombreProveedor, :emailProveedor, :telefono1Proveedor, :telefono2Proveedor, now(), 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':empresaProveedor' => $empresaProveedor,
                            ':nombreProveedor' => $nombreProveedor,
                            ':emailProveedor' => $emailProveedor,
                            ':telefono1Proveedor' => $telefono1Proveedor,
                            ':telefono2Proveedor' => $telefono2Proveedor));
    echo $stmt->rowCount();    
}

function updateProveedor($idProveedor, $empresaProveedor, $nombreProveedor, $emailProveedor, $telefono1Proveedor, $telefono2Proveedor){
    $pdo = openConnection();
    $sql = "UPDATE proveedores SET empresaProveedor = :empresaProveedor, nombreProveedor = :nombreProveedor, 
            emailProveedor = :emailProveedor, telefono1Proveedor = :telefono1Proveedor, telefono2Proveedor = :telefono2Proveedor
            WHERE idProveedor = :idProveedor";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idProveedor' => $idProveedor,
                            ':empresaProveedor' => $empresaProveedor,
                            ':nombreProveedor' => $nombreProveedor,
                            ':emailProveedor' => $emailProveedor,
                            ':telefono1Proveedor' => $telefono1Proveedor,
                            ':telefono2Proveedor' => $telefono2Proveedor));
    echo $stmt->rowCount();    
}

function deleteProveedor($idProveedor){
    $pdo = openConnection();
    $sql = "UPDATE proveedores SET flagActivo = 0
            WHERE idProveedor = :idProveedor";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idProveedor' => $idProveedor));
    echo $stmt->rowCount();    
}

function createServicioProveedor ($idProveedor, $idServicio, $costoUnitario) {
    $pdo = openConnection();
    $sql = "INSERT INTO servicio_proveedor (idProveedor, idServicio, costoUnitario, insertDate, flagActivo)
            VALUES (:idProveedor, :idServicio, :costoUnitario, now(), 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idProveedor' => $idProveedor,
                            ':idServicio' => $idServicio,
                            ':costoUnitario' => $costoUnitario));
    echo $stmt->rowCount();    
}

function getServicioByProveedor($idProveedor) {
    $pdo = openConnection();

    $sql = "SELECT idServicioProveedor, descripcionServicio, costoUnitario FROM servicio_proveedor INNER JOIN servicios ON servicio_proveedor.idServicio = servicios.idServicio WHERE idProveedor = :idProveedor AND servicio_proveedor.flagActivo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idProveedor' => $idProveedor));

    $registrosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['idServicioProveedor']= $row['idServicioProveedor'];
            $registroDetalle['descripcionServicio']= $row['descripcionServicio'];
            $registroDetalle['costoUnitario']= $row['costoUnitario'];
            $registrosArray[] = $registroDetalle;//build an array
    }
    
    echo json_encode($registrosArray);//format the array into json data
}

function deleteServicioProveedor ($idServicioProveedor) {
    $pdo = openConnection();
    $sql = "UPDATE servicio_proveedor SET flagActivo = 0
            WHERE idServicioProveedor = :idServicioProveedor";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicioProveedor' => $idServicioProveedor));
    echo $stmt->rowCount();    
}

function getProveedorByServicio ($idServicio) {

    $pdo = openConnection();
    $sql = "SELECT idServicioProveedor, proveedores.idProveedor, empresaProveedor, costoUnitario 
                FROM servicio_proveedor INNER JOIN proveedores ON servicio_proveedor.idProveedor = proveedores.idProveedor 
                WHERE idServicio = :idServicio AND servicio_proveedor.flagActivo = 1;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':idServicio' => $idServicio));

    $registrosArray = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//loop through the retrieved values
    {
            $registroDetalle['idServicioProveedor']= $row['idServicioProveedor'];
            $registroDetalle['idProveedor']= $row['idProveedor'];
            $registroDetalle['empresaProveedor']= $row['empresaProveedor'];
            $registroDetalle['costoUnitario'] = $row['costoUnitario'];
            $registrosArray[] = $registroDetalle;//build an array
    }
    
    echo json_encode($registrosArray);//format the array into json data

}




?>