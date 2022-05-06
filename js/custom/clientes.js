//SE NECESITA CREAR AL CLIENTE 0 CON DATOS EN BLANCO
var pagesNumber = 1;
var paginaActualGlobal = 0;

function generarPantallaClientes(){
    $('#contenedorPrincipalEncabezado').hide(); 
    html =  "<div class='page-title'>" +
                        "<div class='title_left'>" +
                            "<h3>Clientes </h3>" +
                        "</div>" +
                        "<div class='title_right'>" +
                            "<div class='col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search'>" +
                                "<div class='input-group'>" +
                                    "<input type='text' id='buscadorCliente' class='form-control' placeholder='Filtrar...' onkeyup='generarTablaClientes(1)'>" +
                                    "<span class='input-group-btn'>" +
                            "<button class='btn btn-default' type='button'>Go!</button>" +
                        "</span>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
            "</div>";
    $('#contenedorPrincipalEncabezado').html(html);
    $('#contenedorPrincipalEncabezado').fadeIn('slow');
    generarTablaClientes(1);
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPrincipalDetalle').fadeIn('slow');
}

function detalleCliente(idCliente) {
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPaginacion').html("");
    var html = "";
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=getClienteById&idCliente=' + idCliente,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            html = "<div class='form-horizontal text-center'>" +
                        "<div class = 'form-group'>" +
                            "<label>Nombre</label>" +
                                "<input type='text' class='form-control input-lg' id='nombreCliente'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Email</label>" +
                                "<input type='text' class='form-control input-lg' id='emailCliente'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Telefono</label>" +
                                "<input type='text' class='form-control input-lg' id='telefonoCliente'>" +
                        "</div>" +
                        "<div class='btn-toolbar text-center btn-group-lg'>" +
                            "<button class='btn btn-default' onclick='generarTablaClientes("+paginaActualGlobal+")'>Volver</button>";
                            if(idCliente != 0)
                                html += "<button class='btn btn-danger' data-toggle='modal' data-target='#clienteModalConfirm'>Eliminar</button>";
                            html += "<button class='btn btn-primary' onclick='updateCliente("+idCliente+")'>Guardar</button>" +
                        "</div>" +
                    "</div>"+
                    "<div id='clienteModalConfirm' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>" +
                    "<div class='modal-dialog'>" +
                        "<div class='modal-content'>" +
                            "<div class='modal-header'>" +
                                "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
                                "<h4 class='modal-title' id='myModalLabel2'>¿Desea eliminar al cliente seleccionado?</h4>" +
                            "</div>" +
                            "<div class='modal-footer'>" +
                                "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>" +     
                                "<button type='button' class='btn btn-danger' data-dismiss='modal' onclick='deleteCliente("+idCliente+")'>Eliminar</button>" +                                
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>"+
                "<div class='x_title'></div><br>" +
                "<div class ='row' id='tablaEventosCliente'></div>";
            $('#contenedorPrincipalDetalle').html(html);
            generarEventosCliente(idCliente);
            $('#idCliente').val(response['idCliente']);
            $('#nombreCliente').val(response['nombreCliente']);
            $('#emailCliente').val(response['emailCliente']);
            $('#telefonoCliente').val(response['telefonoCliente']);
            $('#contenedorPrincipalDetalle').fadeIn('slow');
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });

}

function updateCliente(idCliente) {
    var nombreCliente = $('#nombreCliente').val();
    var emailCliente = $('#emailCliente').val();
    var telefonoCliente = $('#telefonoCliente').val();
    //var idCliente = $('#idCliente').val();
    var action;
    var mensaje;
    if (validarCampo(nombreCliente)) {
        if (idCliente == 0) {
            action = "createCliente";
            mensaje = "¡El cliente ha sido agregado exitosamente!";
        } else {
            action = "updateCliente";
            mensaje = "¡El cliente ha sido actualizado exitosamente!";
        }
        $.ajax({
            url: 'handlerEventos.php',
            data: 'action=' + action + '&idCliente=' + idCliente + '&nombreCliente=' + nombreCliente +
                '&emailCliente=' + emailCliente + '&telefonoCliente=' + telefonoCliente,
            type: 'POST',
            dataType: 'text',
            success: function(response) {
                generarTablaClientes(paginaActualGlobal);
                showAlert('contenedorMensajes', 'success', mensaje, 3000);
            },
            error: function(e) {
                console.log(e.responseText);

            }
        });
    } else
        showAlert('contenedorMensajes', 'warning', '¡Debe ingresar un nombre!', 3000);
}

function generarTablaClientes(paginaActual) {
    paginaActualGlobal = paginaActual;
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPaginacion').hide();
    var nombreCliente = $('#buscadorCliente').val();
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=getClienteAllPagina&nombreCliente=' + nombreCliente +
              '&paginaActual='+paginaActual,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            if (msg.length > 0) {
                contenidoTabla = "<table id='example' class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Nombre</th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {
                    contenidoTabla = contenidoTabla + "<tr data-toggle='modal' data-id='cliente_" + msg[i]['idCliente'] +
                        "' data-target='#clienteModal' onclick='detalleCliente(" + msg[i]['idCliente'] +
                        ")'><td class='nombreCliente'>" + msg[i].nombreCliente + "</td></tr>";
                }

                contenidoTabla = contenidoTabla + "</tbody></table>";
            }
                contenidoTabla += "<div class='btn-toolbar text-center'>" +
                                    "<button class='btn btn-primary btn-lg boton-fijo' onclick='detalleCliente(0)'>Agregar</button>" +
                                "</div>";
            $('#contenedorPrincipalDetalle').html(contenidoTabla);
            $('#contenedorPrincipalDetalle').fadeIn('slow');
            $('#contenedorPaginacion').fadeIn('slow');
            paginar();

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}


function deleteCliente(idCliente) {
    //$('.antoclose').click();
    //var idCliente = $('#idCliente').val();
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=deleteCliente&idCliente=' + idCliente,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
            generarTablaClientes(paginaActualGlobal);
            showAlert('contenedorMensajes', 'success', '¡El cliente ha sido eliminado exitosamente!', 3000);

        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function paginar() {

    var pagesNumber;
    var nombreCliente = $('#buscadorCliente').val();
    var html;
    var pagina;
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=getClienteAllCount&nombreCliente=' + nombreCliente,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            pagesNumber = response['pagesNumber'];
    html = "<ul class='pagination-lg pagination'>";
    for (i = 0; i < pagesNumber; i++) {
        pagina = i + 1;
        if(paginaActualGlobal == pagina)
            html += "<li class='active'><a href='#' onclick='generarTablaClientes("+pagina+")'>"+pagina+"</a></li>";   
        else         
            html += "<li><a href='#' onclick='generarTablaClientes("+pagina+")'>"+pagina+"</a></li>";
    }
        html += "</ul>";
        $('#contenedorPaginacion').html(html);
        },
        error: function(e) {
            console.log(e.responseText);
            return 1;

        }
    });
}

function generarEventosCliente(idCliente) {
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPaginacion').hide();
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=getEventoByCliente&idCliente=' + idCliente,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            if (msg.length > 0) {
                contenidoTabla = "<table class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Fecha</th><th>Tipo Evento</th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {
                    contenidoTabla = contenidoTabla + "<tr><td>" + msg[i].fechaEvento + "</td><td>" + msg[i].tipoEvento + "</td></tr>";
                }

                contenidoTabla = contenidoTabla + "</tbody></table>";
            }
            $('#tablaEventosCliente').html(contenidoTabla);
            $('#tablaEventosCliente').fadeIn('slow');
            paginar();

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}





/*
function detalleCliente(idCliente) {
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPaginacion').html("");
    var html = "";
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=getClienteById&idCliente=' + idCliente,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            html = "<div class='form-horizontal'>" +
                        "<div class = 'form-group'>" +
                            "<label class='col-sm-3 control-label'>Nombre</label>" +
                            "<div class='col-sm-9'>" +
                                "<input type='text' class='form-control' id='nombreCliente'>" +
                            "</div>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label class='col-sm-3 control-label'>Email</label>" +
                            "<div class='col-sm-9'>" +
                                "<input type='text' class='form-control' id='emailCliente'>" +
                            "</div>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label class='col-sm-3 control-label'>Telefono</label>" +
                            "<div class='col-sm-9'>" +
                                "<input type='text' class='form-control' id='telefonoCliente'>" +
                            "</div>" +
                        "</div>" +
                        "<div class='btn-toolbar text-center btn-group-lg boton-fijo'>" +
                            "<button class='btn btn-default' onclick='generarTablaClientes("+paginaActualGlobal+")'>Volver</button>";
                            if(idCliente != 0)
                                html += "<button class='btn btn-danger' data-toggle='modal' data-target='#clienteModalConfirm'>Eliminar</button>";
                            html += "<button class='btn btn-primary' onclick='updateCliente("+idCliente+")'>Guardar</button>" +
                        "</div>" +
                    "</div>"+
                    "<div id='clienteModalConfirm' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>" +
                    "<div class='modal-dialog'>" +
                        "<div class='modal-content'>" +
                            "<div class='modal-header'>" +
                                "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
                                "<h4 class='modal-title' id='myModalLabel2'>¿Desea eliminar al cliente seleccionado?</h4>" +
                            "</div>" +
                            "<div class='modal-footer'>" +
                                "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>" +     
                                "<button type='button' class='btn btn-danger' data-dismiss='modal' onclick='deleteCliente("+idCliente+")'>Eliminar</button>" +                                
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>"+
                "<div class='x_title'></div><br>" +
                "<div class ='row' id='tablaEventosCliente'></div>";
            $('#contenedorPrincipalDetalle').html(html);
            generarEventosCliente(idCliente);
            $('#idCliente').val(response['idCliente']);
            $('#nombreCliente').val(response['nombreCliente']);
            $('#emailCliente').val(response['emailCliente']);
            $('#telefonoCliente').val(response['telefonoCliente']);
            $('#contenedorPrincipalDetalle').fadeIn('slow');
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });

}*/