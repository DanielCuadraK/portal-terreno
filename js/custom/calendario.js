var totalAbonos;
var totalServicios;
var IVA;
var totalEvento;
//var idEvento;
var factura;
var fechaMYSQL;

function generarPantallaCalendario() {
    $('#contenedorPrincipalEncabezado').hide();
    $('#contenedorPaginacion').html(""); 
    html =  "<div class='page-title'>" +
                        "<div class='title_left'>" +
                            "<h3>Calendario de eventos </h3>" +
                        "</div>" +
                        "<div class='title_right'>" +
                        "</div>" +
            "</div>";
    $('#contenedorPrincipalEncabezado').html(html);
    $('#contenedorPrincipalEncabezado').fadeIn('slow');
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPrincipalDetalle').html("<div id='detalleEvento'></div>");
    $('#calendar').fadeIn('slow');
    $('#calendar').fullCalendar('destroy');
    $('#contenedorPrincipalDetalle').fadeIn('slow');
    generarCalendario();

}

function generarCalendario() {
    //$('#contenedorPrincipalDetalle').html("<div id='calendar'></div>");
    //$('#calendar').fullCalendar('destroy');
    //$('#detalleEvento').hide();
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var started;
    var categoryClass;

    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        lang: 'es',
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            fechaEvento = new Date(end);
            fechaMYSQL = fechaEvento.getFullYear() + "-" + (fechaEvento.getMonth() + 1) + "-" + fechaEvento.getDate();
            detalleEvento(0);
            calendar.fullCalendar('unselect');           
        },
        eventClick: function(calEvent, jsEvent, view) {
            detalleEvento(calEvent.idEvento);
            calendar.fullCalendar('unselect');
        },
        editable: true,
        eventSources: ['getEventosCalendario.php', 'calendario.php']
            //eventColor: '#BFF2CA'   
    });
}

function mostrarCalendario(){
    $('#contenedorPrincipalDetalle').hide();
    $('#calendar').fadeIn('slow');
    $('#calendar').fullCalendar('refetchEvents');
}


function guardarEvento(idEvento) {
    var nombreCliente = $('#clienteAutocomplete').val();
    var emailCliente = $('#emailCliente').val();
    var telefonoCliente = $('#telefonoCliente').val();
    var statusEvento = $('#statusEvento').val();
    var invitadosEvento = $('#invitadosEvento').val();
    var horaInicioEvento = $('#horaInicioEvento').val();
    var horaFinEvento = $('#horaFinEvento').val();
    var comentariosEvento = $('#comentariosEvento').val();
    var tipoEvento = $('#tipoEvento').val();
    var fechaEvento = $('#fechaEvento').val();
    if (idEvento == 0) {
        action = "createEvento";
        mensaje = "El evento se ha creado exitosamente!";
    } else {
        action = "updateEvento";
        mensaje = "El evento ha sido actualizado exitosamente!";
    }

    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idEvento=' + idEvento + '&nombreCliente=' + nombreCliente + '&fechaEvento=' + fechaEvento +
            '&statusEvento=' + statusEvento + '&invitadosEvento=' + invitadosEvento +
            '&horaInicioEvento=' + horaInicioEvento + '&horaFinEvento=' + horaFinEvento +
            '&comentariosEvento=' + comentariosEvento + '&tipoEvento=' + tipoEvento + '&emailCliente='+emailCliente +
            '&telefonoCliente='+telefonoCliente,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
            event.id = response.eventid;
            showAlert('msgDetalleEvento','success',mensaje,3000);
            if(action == "createEvento"){
                $('#calendar').fullCalendar('refetchEvents');
                detalleEvento(response);
            }
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
    $('#title').val('');
    return false;
}

function deleteEvento(idEvento) {
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=deleteEvento&idEvento=' + idEvento,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
            event.id = response.eventid;
            //$('#calendar').fullCalendar('updateEvent',event);
            console.log(response);
            mostrarCalendario();
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

/*function detalleEvento(idEvento) {
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=getEventoById&idEvento=' + idEvento,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            $('#idEvento').val(response['idEvento']);
            if(idEvento == 0)
                $('#fechaEvento').val(fechaMYSQL);  
            else
                $('#fechaEvento').val(response['fechaEvento']);
            $('#clienteAutocomplete').val(response['nombreCliente']);
            $('#emailCliente').val(response['emailCliente']);
            $('#telefonoCliente').val(response['telefonoCliente']);
            $('#statusEvento').val(response['statusEvento']);
            $('#tipoEvento').val(response['tipoEvento']);
            $('#invitadosEvento').val(response['invitadosEvento']);
            $('#horaInicioEvento').val(response['horaInicioEvento']);
            $('#horaFinEvento').val(response['horaFinEvento']);
            $('#comentariosEvento').val(response['comentariosEvento']);
            factura = response['factura'];
            generarTablaServiciosEvento(idEvento);
            generarTablaAbonos(idEvento);
            $('#contenedorPrincipalDetalle').fadeIn('slow');
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
}*/

$("#clienteAutocomplete").autocomplete({
    source: "getClientesAutocomplete.php",
    minLength: 2
});

/*function limpiarCampos(idFormulario) {
    var form = document.getElementById(idFormulario);
    for (var i = 0; i < form.elements.length; i++) {
        form.elements[i].value = "";
    }
}*/

function detalleEvento(idEvento) {
    var formulario = "<h5>Datos generales</h5>" +
        "<form id='antoform2' class='form-horizontal text-center'>" +
        "<div class='form-group'>" +
        "<label>Fecha</label>" +
        "<input type='text' class='form-control input-lg' id='fechaEvento' readonly>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Cliente</label>" +
        "<input type='text' class='form-control input-lg' id='clienteAutocomplete'>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Teléfono</label>" +
        "<input type='text' class='form-control input-lg' id='telefonoCliente'>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Email</label>" +
        "<input type='text' class='form-control input-lg' id='emailCliente'>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Status</label>" +
        "<select class='form-control input-lg' id='statusEvento'>" +
        "<option>Ocupado</option>" +
        "<option>Apartado</option>" +
        "<option>Cancelado</option>" +
        "</select>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Tipo de Evento</label>" +
        "<input type='text' class='form-control input-lg' id='tipoEvento' name='title'>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Invitados</label>" +
        "<input type='text' class='form-control input-lg' id='invitadosEvento' name='title'>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Hora Inicio</label>" +
        "<input type='text' class='form-control input-lg' id='horaInicioEvento' name='title'>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Hora Fin</label>" +
        "<input type='text' class='form-control input-lg' id='horaFinEvento' name='title'>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label>Comentarios</label>" +
        "<textarea class='form-control input-lg' rows='3' id='comentariosEvento' name='descr'></textarea>" +
        "<input type = 'hidden' id='idEvento'>" +
        "</div>" +
        "<div class='btn-toolbar text-center'>" +
        "<button type='button' class='btn btn-default' onclick='mostrarCalendario()'>Volver</button>";
        if(idEvento != 0)
            formulario += "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#eventoModalConfirm'>Eliminar</button>";
        formulario += "<button type='button' class='btn btn-primary antosubmit' onclick='guardarEvento("+idEvento+")'>Guardar</button>" +
         "</div>" +
        "<div id='msgDetalleEvento'></div>" +
        "</form>";
        if(idEvento != 0) {
        formulario += "<div class='x_title'></div>" +
        "<div id='tablaServicios'></div>" +
        "<div id='msgServicio'></div>" +
        "</div>" +
        "<div class='x_title'></div>" +
        "<div id='tablaAbonos'></div>" +
        "<div id='msgAbono'></div>" +
        "</div>";
    }
        formulario += "<div class='x_title'></div>" +
        "<div id='saldoEvento'></div>" +
                            "<div id='eventoModalConfirm' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>" +
                    "<div class='modal-dialog'>" +
                        "<div class='modal-content'>" +
                            "<div class='modal-header'>" +
                                "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
                                "<h4 class='modal-title' id='myModalLabel2'>¿Desea eliminar el evento seleccionado?</h4>" +
                            "</div>" +
                            "<div class='modal-footer'>" +
                                "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>" +     
                                "<button type='button' class='btn btn-danger' data-dismiss='modal' onclick='deleteEvento("+idEvento+")'>Eliminar</button>" +                                
                            "</div>" +
                        "</div>" +
                    "</div>";
    //$('#btnCerrarModal').click();
    $('#calendar').hide();
    $('#contenedorPrincipalDetalle').html(formulario);
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=getEventoById&idEvento=' + idEvento,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            $('#idEvento').val(response['idEvento']);
            if(idEvento == 0)
                $('#fechaEvento').val(fechaMYSQL);  
            else
                $('#fechaEvento').val(response['fechaEvento']);
            $('#clienteAutocomplete').val(response['nombreCliente']);
            $('#emailCliente').val(response['emailCliente']);
            $('#telefonoCliente').val(response['telefonoCliente']);
            $('#statusEvento').val(response['statusEvento']);
            $('#tipoEvento').val(response['tipoEvento']);
            $('#invitadosEvento').val(response['invitadosEvento']);
            $('#horaInicioEvento').val(response['horaInicioEvento']);
            $('#horaFinEvento').val(response['horaFinEvento']);
            $('#comentariosEvento').val(response['comentariosEvento']);
            factura = response['factura'];
            generarTablaServiciosEvento(idEvento);
            generarTablaAbonos(idEvento);
            //$('#contenedorPrincipalDetalle').fadeIn('slow');
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
    $('#contenedorPrincipalDetalle').fadeIn('slow');

    $('#descripcionServicioAutocomplete').autocomplete({
    source: "getServicioAutocomplete.php",
    select: function (event, ui) {
        $("#idServicio").val(ui.item.id); // save selected id to hidden input
    }
});
    $("#clienteAutocomplete").autocomplete({
        source: "getClientesAutocomplete.php",
        minLength: 2
});
    generarComboServicios();
}

function ocultarDetalle() {
    $('#calendar').hide();
    $('#calendar').html("");
    $('#calendar').show();
    $('#calendar').fullCalendar('refetchEvents');
}

function generarTablaServiciosEvento(idEvento) {
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=getServicioByEvento&idEvento=' + idEvento,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "<div class='btn-toolbar text-center btn-group-lg'><button class= 'btn btn-primary btn-lg' onclick='formularioAgregarServicioEvento("+idEvento+")' href='#'>Agregar servicio</button></div>";
            totalServicios = 0;
            if (msg.length > 0) {
                contenidoTabla = "<h3 class='text-center'>Servicios contratados</h3>" +
                    "<table class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Servicio</th><th>Cantidad</th><th>Costo</th>" +
                    "<th></th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                    contenidoTabla = contenidoTabla + "<tr><td onclick='detalleServicioByEvento("+msg[i]['idServicioProveedorEvento']+")'>" + msg[i]['descripcionServicio'] + "</td><td>"+msg[i]['cantidadServicio']+"</td><td>$" + msg[i]['precioServicio'] +
                        "</td><td><a data-toggle='tooltip' data-placement='top' title='Eliminar' onclick='eliminarServicioEvento("+msg[i]['idServicioProveedorEvento']+","+idEvento+")'href='#nuevoAbono'>"+
                        "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>"+
                        "</a></td>" +
                        "</tr>";
                    totalServicios = totalServicios + parseFloat(msg[i]['precioServicio']);
                }
                contenidoTabla = contenidoTabla + "<tr data-toggle='modal' data-id='totalServicios'>"+
                "<td>Total Servicios</td><td>$" + totalServicios + "</td><td></td><td></td></tr>";
                if(factura == "1") {
                    IVA = totalServicios * .16;
                    totalServiciosIVA = totalServicios + IVA;
                    contenidoTabla = contenidoTabla + "<tr data-toggle='modal' data-id='totalIVA'>"+
                    "<td>IVA</td><td>$" + IVA + "</td><td></td><td></td></tr>";
                    contenidoTabla = contenidoTabla + "<tr data-toggle='modal' data-id='totalServiciosIVA'>"+
                    "<td>Total + IVA</td><td>$" + totalServiciosIVA + "</td><td></td><td></td></tr>";
                }
                contenidoTabla = contenidoTabla + "</tbody></table>" +
                        "<div class='btn-toolbar text-center btn-group-lg'><button class= 'btn btn-primary btn-lg' onclick='formularioAgregarServicioEvento("+idEvento+")' href='#'>Agregar servicio</button></div>";
            }
            $('#tablaServicios').html(contenidoTabla);
            calcularTotalEvento();
            $('#saldoEvento').html("<h3 class='text-center'>Pendiente por abonar: $" + totalEvento + "</h3>");

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}

function generarTablaAbonos(idEvento) {
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=getAbonoByEvento&idEvento=' + idEvento,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "<div class='btn-toolbar text-center btn-group-lg'><button class= 'btn btn-primary btn-lg' onclick='formularioAgregarAbono("+idEvento+")' id='btnAgregarAbono' href='#nuevoAbono'>Agregar abono</button></div>";
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

                    contenidoTabla = contenidoTabla + "<tr id='abono-" + msg[i]['idAbono'] +
                        "'><td>" + msg[i]['fechaAbono'] + "</td><td>" + msg[i]['nombreAbono'] + "</td>" +
                        "<td>$" + msg[i]['montoAbono'] + "</td><td>" + msg[i]['recibioAbono'] +
                        "</td><td><a data-toggle='tooltip' data-placement='top' title='Eliminar' onclick='eliminarAbono("+msg[i]['idAbono']+","+idEvento+")'href='#nuevoAbono'>"+
                        "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>"+
                        "</a></td></tr>";
                    totalAbonos = totalAbonos + parseFloat(msg[i]['montoAbono']);
                }
                
                contenidoTabla = contenidoTabla + "<tr data-toggle='modal' data-id='totalAbonos'>"+
                "<td>Total Abonos</td><td></td><td>$" + totalAbonos + "</td><td></td><td></td></tr>";

                contenidoTabla = contenidoTabla + "</tbody></table>"+
                        "<div class='btn-toolbar text-center btn-group-lg'><button class= 'btn btn-primary btn-lg' onclick='formularioAgregarAbono("+idEvento+")' id='btnAgregarAbono' href='#nuevoAbono'>Agregar abono</button></div>";

            }
            $('#tablaAbonos').html(contenidoTabla);
            calcularTotalEvento();
            $('#saldoEvento').html("<h3 class='text-center'>Pendiente por abonar: $" + totalEvento + "</h3>");

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}

function guardarServicioEvento(idEvento){
 var idServicio = $('#idServicio').val();
 var cantidadServicio = $('#cantidadServicio').val();
 var idProveedor = 0;
 var action = "createServicioProveedorEvento";
if ( validarCampo(idServicio) && validarCampo(cantidadServicio)){
     $('#tablaServicios').html('Cargando...');
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idEvento=' + idEvento + '&idServicio=' + idServicio + '&idProveedor=' + idProveedor +
            '&cantidadServicio=' + cantidadServicio,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
            generarTablaServiciosEvento(idEvento);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
 }
 else
    showAlert('msgServicio','danger','Faltan Campos',3000);
}

function eliminarServicioEvento(idServicioProveedorEvento, idEvento) {
    var action = "deleteServicioProveedorEvento";
    $('#tablaServicios').html('Cargando...');
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idServicioProveedorEvento=' + idServicioProveedorEvento + '&idEvento=' + idEvento,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
          generarTablaServiciosEvento(idEvento);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function cerrarAbono(){
  $('#btnAgregarAbono').click();
}

function guardarAbono(idEvento){
 var fechaAbono = $('#fechaAbono').val();
 var nombreAbono = $('#nombreAbono').val();
 var montoAbono = $('#montoAbono').val();
 var recibioAbono = $('#recibioAbono').val();
 var formaPagoAbono = $('#formaPagoAbono').val();
 var comentariosAbono = $('#comentariosAbono').val();
 var action = "createAbono";
 if(validarCampo(fechaAbono) && validarCampo(nombreAbono) && validarCampo(montoAbono) && validarCampo(recibioAbono)) {
    $('#tablaAbonos').html('Cargando...');
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idEvento=' + idEvento + '&fechaAbono=' + fechaAbono + '&nombreAbono=' + nombreAbono +
            '&montoAbono=' + montoAbono + '&recibioAbono=' + recibioAbono + "&formaPagoAbono=" + formaPagoAbono + "&comentariosAbono=" + comentariosAbono,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
          generarTablaAbonos(idEvento);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}
else
    showAlert('msgAbono','danger','Faltan Campos',3000);
}

function eliminarAbono(idAbono, idEvento) {
    var action = "deleteAbono";
    $('#tablaAbonos').html('Cargando...');
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idAbono=' + idAbono,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
          generarTablaAbonos(idEvento);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function generarComboServicios(){
 var action = "getServicioAll";
 var html = "";
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
        html = html + "<label class='control-label'>Servicio:</label>"+
                        "<select class='form-control input-lg' id='idServicio'>";
            if (response.length > 0) {

                for (i in response) {
                    html = html + "<option value ='"+response[i]['idServicio']+"'>"+
                    response[i]['descripcionServicio']+"</option>";
                }
            }
            html = html + "</select>";
            $('#comboServicios').html(html);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function formularioAgregarAbono(idEvento)
{
    var html = "<h3 class='text-center'>Agregar abono</h3>" +
                "<form class='form-horizontal text-center' role='form' id='formAbonos'>"+
                "<div class='form-group'>"+
                  "<label>Fecha:</label>"+
                  "<input type='text' class='form-control input-lg' id='fechaAbono' autocomplete='off'>"+
                "</div>"+
                "<div class='form-group'>"+
                  "<label>Nombre:</label>"+
                  "<input type='text' class='form-control input-lg' id='nombreAbono'>"+
                "</div>"+
                "<div class='form-group'>"+
                  "<label>Monto:</label>"+
                  "<input type='number' class='form-control input-lg' id='montoAbono'>"+
                "</div>"+
                "<div class='form-group'>"+
                  "<label>Forma de pago:</label>"+
                  "<select type='number' class='form-control input-lg' id='formaPagoAbono'>"+
                  "<option selected value='EFECTIVO'>EFECTIVO</option>" +
                  "<option value='TRANSFERENCIA'>TRANSFERENCIA</option>" +
                  "<option value='CHEQUE'>CHEQUE</option>" +
                  "<option value='TARJETA DE CRÉDITO'>TARJETA DE CRÉDITO</option>" +
                  "</select>" +
                "</div>"+
                "<div class='form-group'>"+
                  "<label>Recibió:</label>"+
                  "<input type='text' class='form-control input-lg' id='recibioAbono'>"+
                "</div>"+
                "<div class='form-group'>"+
                  "<label>Comentarios:</label>"+
                  "<input type='text' class='form-control input-lg' id='comentariosAbono'>"+
                "</div>"+
                "<div class='btn-toolbar text-center btn-group-lg'>" +
                    "<button type='button' class='btn btn-primary' onclick='generarTablaAbonos("+idEvento+")'>Cancelar</button>"+                    
                    "<button type='button' class='btn btn-primary' onclick='guardarAbono("+idEvento+")'>Guardar</button>"+
                "</div>"+
        "</form>";
     $('#tablaAbonos').html(html);
     $("#fechaAbono").datepicker({
     dateFormat: 'yy-mm-dd',
     inline: true,
     locale: 'es'
});   
}

function formularioAgregarServicioEvento(idEvento){
    $('#tablaServicios').html("");
     var action = "getServicioAll";
     var html; 
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
        html =  "<h3 class='text-center'>Agregar servicio</h3>" +
                "<form class='form-horizontal text-center' role='form' id='formServicios'>"+
                "<div class='form-group' id='comboServicios'>"+
                    "<label>Servicio:</label>"+
                    "<select class='form-control input-lg' id='idServicio'>";
                if (response.length > 0) {
                for (i in response) {
                    html = html + "<option value ='"+response[i]['idServicio']+"'>"+
                    response[i]['descripcionServicio']+"</option>";
                }
            }
            html = html + "</select>" +
                "</div>"+
                "<div class='form-group text-center'>"+
                  "<label>Cantidad:</label>"+
                  "<input type='number' class='form-control input-lg' id='cantidadServicio'>"+
                "</div>"+
                "<div class='btn-toolbar text-center btn-group-lg'>" +
                    "<button type='button' class='btn btn-primary' onclick='generarTablaServiciosEvento("+idEvento+")'>Cancelar</button>"+                    
                    "<button type='button' class='btn btn-primary' onclick='guardarServicioEvento("+idEvento+")'>Guardar</button>"+
                "</div>"+
        "</form>";
            $('#tablaServicios').html(html);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function calcularTotalEvento()
{
    if(factura == "1")
        totalEvento = totalServicios + IVA - totalAbonos;
    else
        totalEvento = totalServicios - totalAbonos;
}

