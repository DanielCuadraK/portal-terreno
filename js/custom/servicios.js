var arrayProveedores = new Array();

function generarPantallaServicios() {
    $('#contenedorPrincipalEncabezado').hide();
    $('#contenedorPaginacion').html(""); 
    html =  "<div class='page-title'>" +
                        "<div class='title_left'>" +
                            "<h3>Servicios </h3>" +
                        "</div>" +
                        "<div class='title_right'>" +
                            "<div class='col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search'>" +
                                "<div class='input-group'>" +
                                    "<input type='text' id='buscadorServicio' class='form-control' placeholder='Filtrar...' onkeyup='generarTablaServicios(1)'>" +
                                    "<span class='input-group-btn'>" +
                            "<button class='btn btn-default' type='button'>Go!</button>" +
                        "</span>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
            "</div>";
    $('#contenedorPrincipalEncabezado').html(html);
    $('#contenedorPrincipalEncabezado').fadeIn('slow');
    generarTablaServicios(1);
    $('#calendar').hide();
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPrincipalDetalle').fadeIn('slow');

}

function generarTablaServicios(paginaActual) {
	$('#contenedorPrincipalDetalle').hide();
    var descripcionServicio = $('#buscadorServicio').val();
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=getServicioByDescripcion&descripcionServicio=' + descripcionServicio,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            totalServicios = 0;
            if (msg.length > 0) {
                contenidoTabla = "<table class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Servicio</th>" +
                    "<th>Precio</th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                    contenidoTabla = contenidoTabla + "<tr onclick='detalleServicio("+ msg[i]['idServicio'] +
                        ")'><td>" + msg[i]['descripcionServicio'] + "</td>" +
                        "<td>" + msg[i]['precioUnitarioServicio'] + "</td>" +
                        "</td>" +
                        "</tr>";
                }

            }
                contenidoTabla = contenidoTabla + "</tbody></table>" +
                "<div class='btn-toolbar text-center'>" +
                "<button class='btn btn-primary btn-lg boton-fijo' onclick='detalleServicio(0)'>Agregar</button>" +
                "</div>";
            $('#contenedorPrincipalDetalle').html(contenidoTabla);
            $('#contenedorPrincipalDetalle').fadeIn('slow');

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}

function detalleServicio(idServicio) {
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPaginacion').html("");
    var html = "";
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=getServicioById&idServicio=' + idServicio,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            html = "<div class='form-horizontal text-center'>" +
                        "<div class = 'form-group'>" +
                            "<label>Servicio</label>" +
                                "<input type='text' class='form-control input-lg' id='descripcionServicio'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Comentarios</label>" +
                                "<input type='text' class='form-control input-lg' id='comentariosServicio'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Precio Unitario</label>" +
                                "<input type='text' class='form-control input-lg' id='precioUnitarioServicio'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Unidad de medida</label>" +
                                "<input type='text' class='form-control input-lg' id='unidadMedidaServicio'>" +
                        "</div>" +
                        "<div class='btn-toolbar text-center'>" +
                            "<button class='btn btn-default' onclick='generarTablaServicios("+paginaActualGlobal+")'>Volver</button>";
                            if(idServicio != 0)
                                html += "<button class='btn btn-danger' data-toggle='modal' data-target='#servicioModalConfirm'>Eliminar</button>";
                            html += "<button class='btn btn-primary' onclick='updateServicio("+idServicio+")'>Guardar</button>" +
                        "</div>" +
                    "</div>"+
                    "<div id='servicioModalConfirm' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>" +
                    "<div class='modal-dialog'>" +
                        "<div class='modal-content'>" +
                            "<div class='modal-header'>" +
                                "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
                                "<h4 class='modal-title' id='myModalLabel2'>¿Desea eliminar el servicio seleccionado?</h4>" +
                            "</div>" +
                            "<div class='modal-footer'>" +
                                "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>" +
                                "<button type='button' class='btn btn-danger' data-dismiss='modal' onclick='deleteServicio("+idServicio+")'>Eliminar</button>" +                                
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
                "<br><div id='contenedorTablaEventosByServicio'></div>";
            $('#contenedorPrincipalDetalle').html(html);
            $('#idServicio').val(response['idServicio']);
            $('#descripcionServicio').val(response['descripcionServicio']);
            $('#comentariosServicio').val(response['comentariosServicio']);
            $('#precioUnitarioServicio').val(response['precioUnitarioServicio']);
            $('#unidadMedidaServicio').val(response['unidadMedidaServicio']);            
            $('#contenedorPrincipalDetalle').fadeIn('slow');
            generarTablaEventosByServicio(idServicio);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });

}

function deleteServicio(idServicio) {
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=deleteServicio&idServicio=' + idServicio,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
            generarTablaClientes(paginaActualGlobal);
            showAlert('contenedorMensajes', 'success', '¡El servicio ha sido eliminado exitosamente!', 3000);

        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function updateServicio(idServicio) {
    var descripcionServicio = $('#descripcionServicio').val();
    var comentariosServicio = $('#comentariosServicio').val();
    var precioUnitarioServicio = $('#precioUnitarioServicio').val();
    var unidadMedidaServicio = $('#unidadMedidaServicio').val();  
    var action;
    var mensaje;
    if (validarCampo(descripcionServicio) && validarCampo(precioUnitarioServicio) && validarCampo(unidadMedidaServicio)) {
        if (idServicio == 0) {
            action = "createServicio";
            mensaje = "¡El servicio ha sido agregado exitosamente!";
        } else {
            action = "updateServicio";
            mensaje = "¡El servicio ha sido actualizado exitosamente!";
        }
        $.ajax({
            url: 'handlerEventos.php',
            data: 'action=' + action + '&idServicio=' + idServicio + '&descripcionServicio=' + descripcionServicio +
                '&comentariosServicio=' + comentariosServicio + '&precioUnitarioServicio=' + precioUnitarioServicio +
                '&unidadMedidaServicio=' + unidadMedidaServicio,
            type: 'POST',
            dataType: 'text',
            success: function(response) {
                generarTablaServicios(1);
                showAlert('contenedorMensajes', 'success', mensaje, 3000);
            },
            error: function(e) {
                console.log(e.responseText);

            }
        });
    } else
        showAlert('contenedorMensajes', 'warning', '¡Faltan campos!', 3000);
}

function generarTablaEventosByServicio(idServicio) {
    $('#contenedorTablaEventosByServicio').hide();
    var action = "getEventosByServicio";
    var fecha;
    var dateString;
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action='+action +'&idServicio=' + idServicio,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            totalServicios = 0;
            if (msg.length > 0) {
                contenidoTabla = "<table class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Fecha</th>" +
                    "<th>Status</th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                   fecha = new Date(msg[i]['fechaEvento']);
                   //$.format.date(fecha, 'dd/MMM/yyyy')
                   contenidoTabla = contenidoTabla + "<tr onclick='detalleEvento("+ msg[i]['idEvento'] +
                        ")'><td>" + msg[i]['fechaEvento']  + "</td>" +
                        "<td>" + msg[i]['statusEvento'] + "</td>" +
                        "</td>" +
                        "</tr>";
                }

            }
                contenidoTabla = contenidoTabla + "</tbody></table>";
            $('#contenedorTablaEventosByServicio').html(contenidoTabla);
            $('#contenedorTablaEventosByServicio').fadeIn('slow');

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}

function detalleServicioByEvento (idServicioProveedorEvento) {
    $('#contenedorPrincipalDetalle').hide();
    var html = "";
    var action = "getServicioProveedorEventoById";
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action='+action+'&idServicioProveedorEvento=' + idServicioProveedorEvento,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            html = "<div class='form-horizontal text-center'>" +
                        "<div class = 'form-group'>" +
                            "<label>Servicio</label>" +
                                "<input readonly type='text' class='form-control input-lg' id='descripcionServicio'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Empresa</label>" +
                                "<select class='form-control input-lg' id='idProveedor' onchange='actualizarCosto()'>" +
                                    "<option value='0'></>" +
                                "</select>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Cantidad</label>" +
                                "<input type='text' class='form-control input-lg' id='cantidadServicio' onchange='actualizarCosto()'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Precio Unitario</label>" +
                                "<input readonly type='text' class='form-control input-lg' id='costoUnitarioServicio'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Precio Total</label>" +
                                "<input readonly type='text' class='form-control input-lg' id='costoTotalServicio'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Comentarios</label>" +
                                "<textarea class='form-control input-lg' rows='3' id='comentariosServicioProveedorEvento'></textarea>" +
                        "</div>" +
                        "<div class='btn-toolbar text-center'>" +
                            "<button class='btn btn-default' onclick='detalleEvento("+response['idEvento']+")'>Volver</button>" +
                            "<button class='btn btn-primary' onclick='updateServicioProveedorEvento("+idServicioProveedorEvento+")'>Guardar</button>" +
                        "</div>" +
                "</div>" +
                "<br><div id='contenedorAbonosServicios'></div>";
            $('#contenedorPrincipalDetalle').html(html);
            $('#descripcionServicio').val(response['descripcionServicio']);
            $('#cantidadServicio').val(response['cantidadServicio']);
            $('#costoUnitarioServicio').val(response['costoUnitarioServicio']);
            $('#costoTotalServicio').val(response['costoTotalServicio']);   
            $('#comentariosServicioProveedorEvento').val(response['comentariosServicioProveedorEvento']);                 
            generarComboProveedoresByServicio(response['idServicio'],response['idProveedor']);       
            $('#contenedorPrincipalDetalle').fadeIn('slow');
            generarTablaAbonosServicio(idServicioProveedorEvento);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

/*function generarComboProveedoresByServicio(idServicio, proveedorSeleccionado){
 var action = "getProveedorByServicio";
 var html = "";
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idServicio=' + idServicio,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
        html = html + "<select class='form-control' id='idProveedor' onchange='actualizarCosto()'>";
            if (response.length > 0) {
                for (i in response) {
                    if(proveedorSeleccionado == response[i]['idProveedor']) {
                        html = html + "<option selected value ='"+response[i]['idProveedor']+"'>"+
                        response[i]['empresaProveedor']+"</option>";
                    }
                    else {
                        html = html + "<option value ='"+response[i]['idProveedor']+"'>"+
                        response[i]['empresaProveedor']+"</option>";
                    }
                    arrayProveedores[response[i]['idProveedor']] = response[i]['costoUnitario'];
                }
            }
            html = html + "</select>";
            $('#comboProveedores').html(html);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}*/

function generarComboProveedoresByServicio(idServicio, proveedorSeleccionado){
 var action = "getProveedorByServicio";
 var html = "";
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idServicio=' + idServicio,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.length > 0) {
                for (i in response) {
                    if(proveedorSeleccionado == response[i]['idProveedor']) {
                            $('#idProveedor').append($('<option/>', { 
                                value: response[i]['idProveedor'],
                                text : response[i]['empresaProveedor'],
                                selected: true 
                            }));
                        }
                    else {
                                $('#idProveedor').append($('<option/>', { 
                                value: response[i]['idProveedor'],
                                text : response[i]['empresaProveedor'] 
                            }));
                    }
                    arrayProveedores[response[i]['idProveedor']] = response[i]['costoUnitario'];
                }
            }
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function actualizarCosto() {
    var idProveedor = $('#idProveedor').val();
    var cantidadServicio = $('#cantidadServicio').val();
    var costoUnitario = arrayProveedores[idProveedor];
    var costoTotalServicio = cantidadServicio * costoUnitario;
    $('#costoUnitarioServicio').val(costoUnitario);
    $('#costoTotalServicio').val(costoTotalServicio);
}

function updateServicioProveedorEvento(idServicioProveedorEvento) {
    var idProveedor = $('#idProveedor').val();
    var costoUnitarioServicio = $('#costoUnitarioServicio').val();
    var cantidadServicio = $('#cantidadServicio').val(); 
    var comentariosServicioProveedorEvento = $('#comentariosServicioProveedorEvento').val();
    var action = "updateServicioProveedorEvento";
    var mensaje = "Se ha actualizado con éxito";
        $.ajax({
            url: 'handlerEventos.php',
            data: 'action=' + action + '&idServicioProveedorEvento=' + idServicioProveedorEvento + '&idProveedor=' + idProveedor +
            '&costoUnitarioServicio=' + costoUnitarioServicio + '&cantidadServicio=' + cantidadServicio + 
            '&comentariosServicioProveedorEvento=' + comentariosServicioProveedorEvento,
            type: 'POST',
            dataType: 'text',
            success: function(response) {
                showAlert('contenedorMensajes', 'success', mensaje, 3000);
            },
            error: function(e) {
                console.log(e.responseText);

            }
        });
}

function generarTablaAbonosServicio(idServicioProveedorEvento) {
    var action = "getAbonoByServicio";
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=' + action + '&idServicioProveedorEvento=' + idServicioProveedorEvento,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "<div class='btn-toolbar text-center btn-group-lg'><button class= 'btn btn-primary btn-lg' onclick='formularioAgregarAbonoServicio("+idServicioProveedorEvento+")' href='#'>Agregar abono</button></div>";
            totalAbonos = 0;
            if (msg.length > 0) {
                contenidoTabla = "<h3 class='text-center'>Abonos realizados</h3>" +
                    "<table id='example' class='table table-striped responsive-utilities jambo_table'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Fecha</th><th>Nombre</th><th>Monto</th><th>Recibió</th><th></th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                    contenidoTabla = contenidoTabla + "<tr><td>" + msg[i]['fechaAbonoServicio'] + "</td><td>" + msg[i]['nombreAbonoServicio'] + "</td>" +
                        "<td>$" + msg[i]['montoAbonoServicio'] + "</td><td>" + msg[i]['recibioAbonoServicio'] +
                        "</td><td><a data-toggle='tooltip' data-placement='top' title='Eliminar' onclick='eliminarAbonoServicio("+msg[i]['idAbonoServicio']+","+idServicioProveedorEvento+")'href='#'>"+
                        "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>"+
                        "</a></td></tr>";
                    totalAbonos = totalAbonos + parseFloat(msg[i]['montoAbonoServicio']);
                }
                
                contenidoTabla = contenidoTabla + "<tr data-toggle='modal' data-id='totalAbonos'>"+
                "<td>Total Abonos</td><td></td><td>$" + totalAbonos + "</td><td></td><td></td></tr>";

                contenidoTabla = contenidoTabla + "</tbody></table>"+
                        "<div class='btn-toolbar text-center btn-group-lg'><button class= 'btn btn-primary btn-lg' onclick='formularioAgregarAbonoServicio("+idServicioProveedorEvento+")' href='#'>Agregar abono</button></div>";

            }
            $('#contenedorAbonosServicios').html(contenidoTabla);
        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}

function formularioAgregarAbonoServicio(idServicioProveedorEvento)
{
    var html = "<h3 class='text-center'>Agregar abono</h3>" +
                "<form class='form-horizontal' role='form' id='formAbonos'>"+
                "<div class='form-group'>"+
                  "<label class='control-label'>Fecha:</label>"+
                  "<input type='text' class='form-control input-lg' id='fechaAbonoServicio'>"+
                "</div>"+
                "<div class='form-group'>"+
                  "<label class='control-label'>Nombre:</label>"+
                  "<input type='text' class='form-control input-lg' id='nombreAbonoServicio'>"+
                "</div>"+
                "<div class='form-group'>"+
                  "<label class='control-label'>Monto:</label>"+
                  "<input type='number' class='form-control input-lg' id='montoAbonoServicio'>"+
                "</div>"+
                "<div class='form-group'>"+
                  "<label class='control-label'>Recibió:</label>"+
                  "<input type='text' class='form-control input-lg' id='recibioAbonoServicio'>"+
                "</div>"+

                "<div class='btn-toolbar text-center btn-group-lg'>" +
                    "<button type='button' class='btn btn-primary' onclick='generarTablaAbonosServicio("+idServicioProveedorEvento+")'>Cancelar</button>"+                    
                    "<button type='button' class='btn btn-primary' onclick='guardarAbonoServicio("+idServicioProveedorEvento+")'>Guardar</button>"+
                "</div>"+
        "</form>";
     $('#contenedorAbonosServicios').html(html);
     $("#fechaAbonoServicio").datepicker({
     dateFormat: 'yy-mm-dd',
     inline: true,
     locale: 'es'
});   
}

function guardarAbonoServicio(idServicioProveedorEvento){
 var fechaAbonoServicio = $('#fechaAbonoServicio').val();
 var nombreAbonoServicio = $('#nombreAbonoServicio').val();
 var montoAbonoServicio = $('#montoAbonoServicio').val();
 var recibioAbonoServicio = $('#recibioAbonoServicio').val();
 var action = "createAbonoServicio";
 if(validarCampo(fechaAbonoServicio) && validarCampo(nombreAbonoServicio) && validarCampo(montoAbonoServicio) && validarCampo(recibioAbonoServicio)) {
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idServicioProveedorEvento=' + idServicioProveedorEvento + '&fechaAbonoServicio=' + fechaAbonoServicio + '&nombreAbonoServicio=' + nombreAbonoServicio +
            '&montoAbonoServicio=' + montoAbonoServicio + '&recibioAbonoServicio=' + recibioAbonoServicio,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
          generarTablaAbonosServicio(idServicioProveedorEvento);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}
else
    showAlert('msgAbono','danger','Faltan Campos',3000);
}

function eliminarAbonoServicio(idAbonoServicio, idServicioProveedorEvento) {
    var action = "deleteAbonoServicio";
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idAbonoServicio=' + idAbonoServicio,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
          generarTablaAbonosServicio(idServicioProveedorEvento);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}
