<?php

require "queryClientes.php";
require "queryEventos.php";
require "queryCotizaciones.php";
require "queryAbonos.php";
require "queryServicios.php";
require "queryProveedores.php";
require "queryEncuestas.php";
require "queryReportes.php";


switch ($_POST['action']) {
    /*-----------------------
                Eventos
    ------------------------*/       
    case "createEvento":
        $nombreCliente = $_POST['nombreCliente'];
        $emailCliente = $_POST['emailCliente'];
        $telefonoCliente = $_POST['telefonoCliente'];
        $idCliente = getClienteId($nombreCliente);
         if (is_null($idCliente))
        {
            createCliente($nombreCliente, $emailCliente, $telefonoCliente);
            $idCliente = getClienteId($nombreCliente);
        }
        createEvento($_POST['fechaEvento'],$idCliente, $_POST['tipoEvento'], $_POST['invitadosEvento'],
            $_POST['horaInicioEvento'],$_POST['horaFinEvento'],$_POST['statusEvento'],$_POST['comentariosEvento']);
        break;
    case "updateEvento":
        $nombreCliente = $_POST['nombreCliente'];
        $emailCliente = $_POST['emailCliente'];
        $telefonoCliente = $_POST['telefonoCliente'];
        $idCliente = getClienteId($nombreCliente);
         if (is_null($idCliente))
        {
            createCliente($nombreCliente, $emailCliente, $telefonoCliente);
            $idCliente = getClienteId($nombreCliente);
        }
        updateEvento($_POST['idEvento'],$idCliente, $_POST['tipoEvento'], $_POST['invitadosEvento'],
            $_POST['horaInicioEvento'],$_POST['horaFinEvento'],$_POST['statusEvento'],$_POST['comentariosEvento']);
        break;
    case "getEventoAll":
    	getEventsAll();
    	break;
    case "getEventoById":
        getEventoById($_POST['idEvento']);
        break;
    case "deleteEvento":
    	deleteEvento($_POST['idEvento']);
    	break;
    case "getEventosByServicio":
        getEventosByServicio($_POST['idServicio']);
        break;
    case "getEventoByCliente":
        getEventoByCliente($_POST['idCliente']);
        break;
    /*-----------------------
                Cotizaciones
    ------------------------*/    
    case "getCotizacionAll":
        getCotizacionAll();
        break;
    case "getCotizacionByStatus":
        getCotizacionByStatus($_POST['statusCotizacion']);
        break;
    case "getCotizacionById":
        getCotizacionById($_POST['idCotizacion']);
        break;
    case "createCotizacion":
        createCotizacion($_POST['nombreCotizacion'], $_POST['emailCotizacion'], $_POST['fechaEventoCotizacion'],
            $_POST['comentariosCotizacion'], $_POST['asistentesCotizacion'], $_POST['tipoEventoCotizacion'], 
            $_POST['telefonoCotizacion'], $_POST['origenCotizacion'], $_POST['statusCotizacion']);
        break;
    case "updateCotizacion":
        updateCotizacion($_POST['idCotizacion'], $_POST['nombreCotizacion'], $_POST['emailCotizacion'], $_POST['fechaEventoCotizacion'],
            $_POST['comentariosCotizacion'], $_POST['asistentesCotizacion'], $_POST['tipoEventoCotizacion'], 
            $_POST['telefonoCotizacion'], $_POST['origenCotizacion'], $_POST['statusCotizacion']);
        break;
    case "deleteCotizacion":
        deleteCotizacion($_POST['idCotizacion']);
        break;
    case "getCotizacionByFechaDisponible":
        getCotizacionByFechaDisponible();
        break;
    /*-----------------------
                Clientes
    ------------------------*/  
        case "getClienteById":
        getClienteById($_POST['idCliente']);
        break;
    case "getClienteAll":
        getClienteAll($_POST['nombreCliente']);
        break;
    case "getClienteAllPagina":
        getClienteAllPagina($_POST['nombreCliente'], $_POST['paginaActual']);
        break;
    case "getClienteAllCount":
        getClienteAllCount($_POST['nombreCliente']);
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
    /*-----------------------
                Abonos
    ------------------------*/    
    case "getAbonoByEvento":
        getAbonoByEvento($_POST['idEvento']);
        break;
    case "createAbono":
        createAbono($_POST['idEvento'], $_POST['fechaAbono'], $_POST['nombreAbono'], $_POST['montoAbono'], $_POST['recibioAbono'], $_POST['formaPagoAbono'] , $_POST['comentariosAbono']);
        break;
    case "deleteAbono":
        deleteAbono($_POST['idAbono']);
        break;
    case "getAbonoByServicio":
        getAbonoByServicio($_POST['idServicioProveedorEvento']);
        break;
    case "createAbonoServicio":
        createAbonoServicio($_POST['idServicioProveedorEvento'], $_POST['fechaAbonoServicio'], $_POST['nombreAbonoServicio'], $_POST['montoAbonoServicio'], $_POST['recibioAbonoServicio']);
        break;
    case "deleteAbonoServicio":
        deleteAbonoServicio($_POST['idAbonoServicio']);
        break;
    /*-----------------------
                Servicios
    ------------------------*/
    case "getServicioByEvento":
        getServicioByEvento($_POST['idEvento']);
        break;
    case "createServicioProveedorEvento":
        $precioUnitarioServicio = getServicioPrecioUnitarioById($_POST['idServicio']);
        createServicioProveedorEvento($_POST['idEvento'], $_POST['idServicio'], $_POST['idProveedor'], $_POST['cantidadServicio'], $precioUnitarioServicio);
        $totalEvento = getTotalServicioByEvento($_POST['idEvento']);
        updateTotalEvento($_POST['idEvento'],$totalEvento);
        break;
    case "deleteServicioProveedorEvento":
        deleteServicioProveedorEvento($_POST['idServicioProveedorEvento']);
        $totalEvento = getTotalServicioByEvento($_POST['idEvento']);
        updateTotalEvento($_POST['idEvento'],$totalEvento);
        break;
    case "getServicioAll":
        getServicioAll();
        break;
    case "getServicioById":
        getServicioById($_POST['idServicio']);
        break;
    case "getServicioByDescripcion":
        getServicioByDescripcion($_POST['descripcionServicio']);
        break;
    case "createServicio":
        createServicio($_POST['descripcionServicio'], $_POST['comentariosServicio'], $_POST['precioUnitarioServicio'], $_POST['unidadMedidaServicio']);
        break;
    case "updateServicio":
        updateServicio($_POST['idServicio'], $_POST['descripcionServicio'], $_POST['comentariosServicio'], $_POST['precioUnitarioServicio'], $_POST['unidadMedidaServicio']);
        break;
    case "deleteServicio":
        deleteServicio($_POST['idServicio']);
        break;
    case "getServicioProveedorEventoById":
        getServicioProveedorEventoById($_POST['idServicioProveedorEvento']);
        break;
    case "updateServicioProveedorEvento":
        updateServicioProveedorEvento($_POST['idServicioProveedorEvento'], $_POST['idProveedor'], $_POST['cantidadServicio'], $_POST['costoUnitarioServicio'], $_POST['comentariosServicioProveedorEvento']);
        break;
    /*-----------------------
             Proveedores
    ------------------------*/ 
    case "getProveedorAll":
        getProveedorAll();
        break;
    case "getProveedorById":
        getProveedorById($_POST['idProveedor']);
        break;
    case "createProveedor":
        createProveedor($_POST['empresaProveedor'], $_POST['nombreProveedor'], $_POST['emailProveedor'], $_POST['telefono1Proveedor'], $_POST['telefono2Proveedor']);
        break;
    case "updateProveedor":
        updateProveedor($_POST['idProveedor'], $_POST['empresaProveedor'], $_POST['nombreProveedor'], $_POST['emailProveedor'], $_POST['telefono1Proveedor'], $_POST['telefono2Proveedor']);
        break;
    case "deleteProveedor":
        deleteProveedor($_POST['idProveedor']);
        break;
    case "getServicioByProveedor":
        getServicioByProveedor($_POST['idProveedor']);
        break;
    case "createServicioProveedor":
        createServicioProveedor($_POST['idProveedor'], $_POST['idServicio'], $_POST['costoUnitario']);
        break;
    case "deleteServicioProveedor":
        deleteServicioProveedor($_POST['idServicioProveedor']);
        break;
    case "getProveedorByServicio":
        getProveedorByServicio($_POST['idServicio']);
        break;


    /*-----------------------
             ENCUESTAS
    ------------------------*/ 
    case "createPreguntaEncuesta":
        createPreguntaEncuesta($_POST['preguntaEncuesta'], $_POST['tipoPregunta']);
        break;
    case "createOpcionPreguntaEncuesta":
        createOpcionPreguntaEncuesta($_POST['idPregunta'], $_POST['opcionPregunta']);
        break;
    case "createRespuestaEncuesta":
        createRespuestaEncuesta($_POST['idEvento'], $_POST['idPregunta'], $_POST['respuestaPregunta']);
        break;
    case "getPreguntaEncuestaAll":
        getPreguntaEncuestaAll();
        break;
    case "getOpcionByPregunta":
        getOpcionByPregunta($_POST['idPregunta']);
        break;
    case "getRespuestaByEvento":
        getRespuestaByEvento($_POST['idEvento']);
        break;

        /*-----------------------
             REPORTES
    ------------------------*/ 
    case "getReporteServicios":
        getReporteServicios();
        break;
    case "getReporteRentas":
        getReporteRentas($_POST['fechaInicial'], $_POST['fechaFinal'], $_POST['statusEvento']);
        break;
}
?>









