function generarPantallaCotizaciones(){
    $('#contenedorPrincipalEncabezado').hide(); 
    html =  "<div class='page-title'>" +
                        "<div class='title_left'>" +
                            "<h3>Cotizaciones </h3>" +
                        "</div>" +
                        "<div class='title_right'>" +
                            "<div class='col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search'>" +
                            "<select class='form-control' id='filtroStatusCotizacion' onchange='generarTablaCotizaciones(1)'>" +
                                        "<option>Abierta</option>" +
                                        "<option>En proceso</option>" +
                                        "<option>Cerrada</option>" +
                                        "<option>Fechas disponibles</option>" +
                                    "</select>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
            "</div>";
    $('#contenedorPrincipalEncabezado').html(html);
    $('#contenedorPrincipalEncabezado').fadeIn('slow');
    generarTablaCotizaciones(1);
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPrincipalDetalle').fadeIn('slow');
}



function generarTablaCotizaciones(paginaActual) {
    var statusCotizacion = $('#filtroStatusCotizacion').val();
    $('#contenedorPaginacion').html("");
    $('#contenedorPrincipalDetalle').hide();
    var action;
    if (statusCotizacion == 'Fechas disponibles')
        action = "getCotizacionByFechaDisponible";
    else
        action = "getCotizacionByStatus";
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=' + action + '&statusCotizacion=' + statusCotizacion,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            if (msg.length > 0) {
                contenidoTabla = "<table id='example' class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Nombre</th><th>Fecha</th><th>Asistentes</th><th>Evento</th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                    contenidoTabla = contenidoTabla + "<tr onclick = 'detalleCotizacion(" + msg[i]['idCotizacion'] +
                         ")'><td>" + msg[i]['nombreCotizacion'] + "</td><td>" + msg[i]['fechaEventoCotizacion'] + "</td>" +
                        "<td>" + msg[i]['asistentesCotizacion'] +
                        "</td><td>" + msg[i]['tipoEventoCotizacion'] + "</td></tr>";
                }

                contenidoTabla = contenidoTabla + "</tbody></table>";
            }
            contenidoTabla += "<div class='btn-toolbar text-center'>" +
                                "<button class='btn btn-primary btn-lg boton-fijo' onclick='detalleCotizacion(0)'>Agregar</button>" +
                                "</div>";
            $('#contenedorPrincipalDetalle').html(contenidoTabla);
            $('#contenedorPrincipalDetalle').fadeIn('slow');

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}

function detalleCotizacion(idCotizacion) {
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPaginacion').html("");
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=getCotizacionById&idCotizacion=' + idCotizacion,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            html = "<div class='form-horizontal text-center'>" +
                        "<div class = 'form-group'>" +
                            "<label>Nombre</label>" +
                                "<input type='text' class='form-control input-lg' id='nombreCotizacion'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Email</label>" +
                                "<input type='text' class='form-control input-lg' id='emailCotizacion'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Telefono</label>" +
                                "<input type='text' class='form-control input-lg' id='telefonoCotizacion'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Fecha</label>" +
                                "<input type='text' class='form-control input-lg' id='fechaEventoCotizacion'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Evento</label>" +
                                "<input type='text' class='form-control input-lg' id='tipoEventoCotizacion'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Asistentes</label>" +
                                "<input type='text' class='form-control input-lg' id='asistentesCotizacion'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Origen</label>" +
                                "<select class='form-control input-lg' id='origenCotizacion'>" +
                                    "<option>Teléfono</option>" +
                                    "<option>Página web</option>" +
                                    "<option>Visita</option>" +
                                    "<option>Facebook</option>" +
                                "</select>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Status</label>" +
                                "<select class='form-control input-lg' id='statusCotizacion'>" +
                                    "<option>Abierta</option>" +
                                    "<option>En proceso</option>" +
                                    "<option>Cerrada</option>" +
                                "</select>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Comentarios</label>" +
                                "<textarea rows='3' class='form-control input-lg' id='comentariosCotizacion'/>" +
                        "</div>" +
                        "<div class='btn-toolbar text-center'>" +
                            "<button class='btn btn-default' onclick='generarTablaCotizaciones(1)'>Volver</button>";
                            if(idCotizacion != 0)
                                html += "<button class='btn btn-danger' data-toggle='modal' data-target='#eliminarModalConfirm'>Eliminar</button>";
                            html += "<button class='btn btn-primary' onclick='updateCotizacion("+idCotizacion+")'>Guardar</button>" +
                        "</div>" +
                    "</div>"+
                    "<div id='eliminarModalConfirm' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>" +
                    "<div class='modal-dialog'>" +
                        "<div class='modal-content'>" +
                            "<div class='modal-header'>" +
                                "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
                                "<h4 class='modal-title' id='myModalLabel2'>¿Desea eliminar la cotización seleccionada?</h4>" +
                            "</div>" +
                            "<div class='modal-footer'>" +
                                "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>" +
                                "<button type='button' class='btn btn-danger' data-dismiss='modal' onclick='deleteCotizacion("+idCotizacion+")'>Eliminar</button>" +                                
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>";

            $('#contenedorPrincipalDetalle').html(html);
            $('#idCotizacion').val(response['idCotizacion']);
            $('#nombreCotizacion').val(response['nombreCotizacion']);
            $('#emailCotizacion').val(response['emailCotizacion']);
            $('#telefonoCotizacion').val(response['telefonoCotizacion']);
            $('#fechaEventoCotizacion').val(response['fechaEventoCotizacion']);
            $('#tipoEventoCotizacion').val(response['tipoEventoCotizacion']);
            $('#asistentesCotizacion').val(response['asistentesCotizacion']);
            $('#origenCotizacion').val(response['origenCotizacion']);
            $('#statusCotizacion').val(response['statusCotizacion']);
            $('#comentariosCotizacion').val(response['comentariosCotizacion']);

            $( "#fechaEventoCotizacion" ).datepicker({
            dateFormat: 'yy-mm-dd',
            inline: true,
            locale: 'es'
        });
        $("#tipoEventoCotizacion").autocomplete({
            source: "getCotizacionEventoAutocomplete.php",
            minLength: 2
        });


            $('#contenedorPrincipalDetalle').fadeIn('slow');
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
}

function updateCotizacion(idCotizacion) {
    //var idCotizacion = $('#idCotizacion').val();
    var nombreCotizacion = $('#nombreCotizacion').val();
    var emailCotizacion = $('#emailCotizacion').val();
    var telefonoCotizacion = $('#telefonoCotizacion').val();
    var fechaEventoCotizacion = $('#fechaEventoCotizacion').val();
    var tipoEventoCotizacion = $('#tipoEventoCotizacion').val();
    var asistentesCotizacion = $('#asistentesCotizacion').val();
    var origenCotizacion = $('#origenCotizacion').val();
    var comentariosCotizacion = $('#comentariosCotizacion').val();
    var statusCotizacion = $('#statusCotizacion').val();
    var action;
    var mensaje;
    if (verificarCampos()) {
        if (idCotizacion == 0) {
            action = "createCotizacion";
            mensaje = "La cotización se ha creado exitosamente!";
        } else {
            action = "updateCotizacion";
            mensaje = "La cotización ha sido actualizada exitosamente!";
        }
        $.ajax({
            url: 'handlerEventos.php',
            data: 'action=' + action + '&idCotizacion=' + idCotizacion + '&nombreCotizacion=' + nombreCotizacion +
                '&emailCotizacion=' + emailCotizacion + '&telefonoCotizacion=' + telefonoCotizacion +
                '&fechaEventoCotizacion=' + fechaEventoCotizacion + '&tipoEventoCotizacion=' + tipoEventoCotizacion +
                '&asistentesCotizacion=' + asistentesCotizacion + '&origenCotizacion=' + origenCotizacion +
                '&comentariosCotizacion=' + comentariosCotizacion + '&statusCotizacion=' + statusCotizacion,
            type: 'POST',
            dataType: 'text',
            success: function(response) {
                console.log(response);
                generarTablaCotizaciones(1);
                showAlert('mensajes', 'success', mensaje, 3000);
            },
            error: function(e) {
                console.log(e.responseText);

            }
        });
    } else
        showAlert('mensajesModal', 'warning', 'Debe ingresar un nombre!', 3000);
}

function deleteCotizacion(idCotizacion) {
    $('.antoclose').click();
    //var idCotizacion = $('#idCotizacion').val();
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=deleteCotizacion&idCotizacion=' + idCotizacion,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
            console.log(response);
            generarTablaCotizaciones();
            showAlert('mensajes', 'success', 'La cotización ha sido eliminada exitosamente!', 3000);

        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function verificarCampos() {
    return true;
}