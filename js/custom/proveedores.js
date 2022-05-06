function generarPantallaProveedores() {
    $('#contenedorPrincipalEncabezado').hide();
    $('#contenedorPaginacion').html(""); 
    html =  "<div class='page-title'>" +
                        "<div class='title_left'>" +
                            "<h3>Proveedores </h3>" +
                        "</div>" +
                        "<div class='title_right'>" +
                            "<div class='col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search'>" +
                                "<div class='input-group'>" +
                                    "<input type='text' id='buscadorProveedor' class='form-control' placeholder='Filtrar...' onkeyup='generarTablaProveedores(1)'>" +
                                    "<span class='input-group-btn'>" +
                            "<button class='btn btn-default' type='button'>Go!</button>" +
                        "</span>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
            "</div>";
    $('#contenedorPrincipalEncabezado').html(html);
    $('#contenedorPrincipalEncabezado').fadeIn('slow');
    generarTablaProveedores(1);
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPrincipalDetalle').fadeIn('slow');

}

function generarTablaProveedores(paginaActual) {
	$('#contenedorPrincipalDetalle').hide();
    var empresaProveedor = $('#buscadorProveedor').val();
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=getProveedorAll&empresaProveedor=' + empresaProveedor,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            totalServicios = 0;
            if (msg.length > 0) {
                contenidoTabla = "<div><table class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Proveedor</th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                    contenidoTabla = contenidoTabla + "<tr onclick='detalleProveedor("+ msg[i]['idProveedor'] +
                        ")'><td>" + msg[i]['empresaProveedor'] + "</td>" +
                        "</td>" +
                        "</tr>";
                }

            }
                contenidoTabla = contenidoTabla + "</tbody></table></div>" +
                "<div class='btn-toolbar text-center'>" +
                "<button class='btn btn-primary btn-lg boton-fijo' onclick='detalleProveedor(0)'>Agregar</button>" +
                "</div>";
            $('#contenedorPrincipalDetalle').html(contenidoTabla);
            $('#contenedorPrincipalDetalle').fadeIn('slow');

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}

function detalleProveedor(idProveedor) {
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPaginacion').html("");
    var html = "";
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=getProveedorById&idProveedor=' + idProveedor,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            html = "<div class='form-horizontal text-center'>" +
                        "<div class = 'form-group'>" +
                            "<label>Empresa</label>" +
                                "<input type='text' class='form-control input-lg' id='empresaProveedor'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Nombre</label>" +
                                "<input type='text' class='form-control input-lg' id='nombreProveedor'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Email</label>" +
                                "<input type='text' class='form-control input-lg' id='emailProveedor'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Teléfono 1</label>" +
                                "<input type='text' class='form-control input-lg' id='telefono1Proveedor'>" +
                        "</div>" +
                        "<div class = 'form-group'>" +
                            "<label>Teléfono 2</label>" +
                                "<input type='text' class='form-control input-lg' id='telefono2Proveedor'>" +
                        "</div>" +
                        "<div class='btn-toolbar text-center'>" +
                            "<button class='btn btn-default' onclick='generarTablaProveedores("+paginaActualGlobal+")'>Volver</button>";
                            if(idProveedor != 0)
                                html += "<button class='btn btn-danger' data-toggle='modal' data-target='#proveedorModalConfirm'>Eliminar</button>";
                            html += "<button class='btn btn-primary' onclick='updateProveedor("+idProveedor+")'>Guardar</button>" +
                        "</div>" +
                    "</div>"+
                    "<div id='proveedorModalConfirm' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>" +
                    "<div class='modal-dialog'>" +
                        "<div class='modal-content'>" +
                            "<div class='modal-header'>" +
                                "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
                                "<h4 class='modal-title' id='myModalLabel2'>¿Desea eliminar al proveedor seleccionado?</h4>" +
                            "</div>" +
                            "<div class='modal-footer'>" +
                                "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>" +
                                "<button type='button' class='btn btn-danger' data-dismiss='modal' onclick='deleteProveedor("+idProveedor+")'>Eliminar</button>" +                                
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
                "<div class='x_title'></div><br>" +
                "<div class ='row' id='tablaServicioProveedor'></div>";
            $('#contenedorPrincipalDetalle').html(html);
            $('#idProveedor').val(response['idProveedor']);
            $('#empresaProveedor').val(response['empresaProveedor']);
            $('#nombreProveedor').val(response['nombreProveedor']);
            $('#emailProveedor').val(response['emailProveedor']);
            $('#telefono1Proveedor').val(response['telefono1Proveedor']);
            $('#telefono2Proveedor').val(response['telefono2Proveedor']);            
            $('#contenedorPrincipalDetalle').fadeIn('slow');
            generarTablaServicioProveedor(idProveedor);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });

}

function deleteProveedor(idProveedor) {
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=deleteProveedor&idProveedor=' + idProveedor,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
            generarTablaProveedores(paginaActualGlobal);
            showAlert('contenedorMensajes', 'success', '¡El proveedor ha sido eliminado exitosamente!', 3000);

        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function updateProveedor(idProveedor) {
    var empresaProveedor = $('#empresaProveedor').val();
    var nombreProveedor = $('#nombreProveedor').val();
    var emailProveedor = $('#emailProveedor').val();
    var telefono1Proveedor = $('#telefono1Proveedor').val();
    var telefono2Proveedor = $('#telefono2Proveedor').val();  
    var action;
    var mensaje;
    if (validarCampo(empresaProveedor) && validarCampo(nombreProveedor) && validarCampo(telefono1Proveedor)) {
        if (idProveedor == 0) {
            action = "createProveedor";
            mensaje = "¡El proveedor ha sido agregado exitosamente!";
        } else {
            action = "updateProveedor";
            mensaje = "¡El proveedor ha sido actualizado exitosamente!";
        }
        $.ajax({
            url: 'handlerEventos.php',
            data: 'action=' + action + '&idProveedor=' + idProveedor + '&empresaProveedor=' + empresaProveedor +
                '&nombreProveedor=' + nombreProveedor + '&emailProveedor=' + emailProveedor +
                '&telefono1Proveedor=' + telefono1Proveedor + '&telefono2Proveedor=' + telefono2Proveedor,
            type: 'POST',
            dataType: 'text',
            success: function(response) {
                generarPantallaProveedores(1);
                showAlert('contenedorMensajes', 'success', mensaje, 3000);
            },
            error: function(e) {
                console.log(e.responseText);

            }
        });
    } else
        showAlert('contenedorMensajes', 'warning', '¡Faltan campos!', 3000);
}

function generarTablaServicioProveedor(idProveedor) {
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=getServicioByProveedor&idProveedor=' + idProveedor,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            totalServicios = 0;
            if (msg.length > 0) {
                contenidoTabla = "<table class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Servicio</th>" +
                    "<th>Costo</th>" +
                    "<th></th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                    contenidoTabla = contenidoTabla + "<tr><td>" + msg[i]['descripcionServicio'] + "</td>" +
                        "<td>" + msg[i]['costoUnitario'] + "</td>" +
                        "<td><a data-toggle='tooltip' data-placement='top' title='Eliminar' onclick='deleteServicioProveedor("+msg[i]['idServicioProveedor']+","+idProveedor+")'href='#nuevoAbono'>"+
                        "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>"+
                        "</a></td></tr>";
                        "</tr>";
                }

            }
                contenidoTabla = contenidoTabla + "</tbody></table>" +
                "<div class='btn-toolbar text-center'>" +
                "<button class='btn btn-primary btn-lg' onclick='formularioAgregarServicio("+idProveedor+")'>Agregar</button>" +
                "</div>";
            $('#tablaServicioProveedor').html(contenidoTabla);

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}

function formularioAgregarServicio(idProveedor){
 var action = "getServicioAll";
 var html = "";
     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
        html = html + "<div class='form-horizontal text-center'><div class='form-group'><label>Servicio:</label>"+
                        "<select class='form-control input-lg' id='idServicio'>";
            if (response.length > 0) {

                for (i in response) {
                    html = html + "<option value ='"+response[i]['idServicio']+"'>"+
                    response[i]['descripcionServicio']+"</option>";
                }
            }
            html = html + "</select></div>" +
                "<div class='form-group'>" +
                    "<label>Costo Unitario</label>" +
                        "<input type='text' class='form-control input-lg' id='costoUnitario' name='title'>" +
                "</div>" +
                "<div class='btn-toolbar text-center'>" +
                    "<button class='btn btn-primary btn-lg' onclick='generarTablaServicioProveedor("+idProveedor+")'>Cancelar</button>" +
                    "<button class='btn btn-primary btn-lg' onclick='guardarServicioProveedor("+ idProveedor +")'>Guardar</button>" +
                "</div></div>";
            $('#tablaServicioProveedor').html(html);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function guardarServicioProveedor(idProveedor){
 var idServicio = $('#idServicio').val();
 var costoUnitario = $('#costoUnitario').val();
 var action = "createServicioProveedor";

     $.ajax({
        url: 'handlerEventos.php',
        data: 'action=' + action + '&idProveedor=' + idProveedor + '&idServicio=' + idServicio + '&costoUnitario=' +costoUnitario,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
          generarTablaServicioProveedor(idProveedor);
        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}

function deleteServicioProveedor(idServicioProveedor, idProveedor) {
    $.ajax({
        url: 'handlerEventos.php',
        data: 'action=deleteServicioProveedor&idServicioProveedor=' + idServicioProveedor,
        type: 'POST',
        dataType: 'text',
        success: function(response) {
            generarTablaServicioProveedor(idProveedor);

        },
        error: function(e) {
            console.log(e.responseText);

        }
    });
}