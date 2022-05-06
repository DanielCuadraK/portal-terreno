//var arrayProveedores = new Array();

function generarPantallaReportes() {
    $('#contenedorPrincipalEncabezado').hide();
    $('#contenedorPaginacion').html(""); 
    html =  "<div class='page-title'>" +
                        "<div class='title_left'>" +
                            "<h3>Reportes </h3>" +
                        "</div>";

    $('#contenedorPrincipalEncabezado').html(html);
    $('#contenedorPrincipalEncabezado').fadeIn('slow');
    html =  "<div class='btn-toolbar text-center'>" +
                "<button class='btn btn-primary' onclick='generarReporteServicios()'>Servicios</button>" +
                "<button class='btn btn-primary' onclick='generarReporteRentas()'>Rentas</button>" +
            "</div>" +
                "<div><table id='table' data-show-columns='true' data-height='460'></table>"+
            "</div>";
    //generarReporteRentas();
    $('#calendar').hide();
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPrincipalDetalle').html(html);
    $('#contenedorPrincipalDetalle').fadeIn('slow');

}

/*function generarReporteServicios(paginaActual) {
	$('#contenedorPrincipalDetalle').hide();
    //var descripcionServicio = $('#buscadorServicio').val();
    var action = "getReporteServicios";
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=' + action, //+ descripcionServicio,
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            totalServicios = 0;
            if (msg.length > 0) {
                contenidoTabla = "<table class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Fecha</th>" +
                    "<th>Servicio</th>" +
                    "<th>Precio</th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                    contenidoTabla = contenidoTabla + "<tr>" +
                        "<td>" + msg[i]['fechaEvento'] + "</td>" +
                        "<td>" + msg[i]['descripcionServicio'] + "</td>" +
                        "<td>" + msg[i]['cantidadServicio'] + "</td>" +
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

    });*/

    function generarReporteServicios(){
        var $table = $('#table');
        $('#table').bootstrapTable('destroy');
         $table.bootstrapTable({
            url: 'handlerEventos.php',
            method: "post",
            queryParams: "postQueryParamsServicios",
            contentType: 'application/x-www-form-urlencoded',
            search: true,
            pagination: true,
            buttonsClass: 'primary',
            showFooter: true,
            minimumCountColumns: 2,
            columns: [{
                field: 'fechaEvento',
                title: 'fechaEvento',
                sortable: true,
            },{
                field: 'descripcionServicio',
                title: 'descripcionServicio',
                sortable: true,
            },{
                field: 'cantidadServicio',
                title: 'cantidadServicio',
                sortable: true,
                
            },  ],
 
         });
}

    function postQueryParamsServicios(params) {
        params.action = "getReporteServicios"; // add param1
        return params; // body data
    }

    function generarReporteRentas(){
        var $table = $('#table');
        $('#table').bootstrapTable('destroy');
         $table.bootstrapTable({
            url: 'handlerEventos.php',
            method: "post",
            queryParams: "postQueryParamsRentas",
            contentType: 'application/x-www-form-urlencoded',
            search: true,
            pagination: true,
            buttonsClass: 'primary',
            showFooter: true,
            minimumCountColumns: 2,
            columns: [{
                field: 'mes',
                title: 'Mes',
                sortable: true,
            },{
                field: 'cantidad',
                title: 'Cantidad',
                sortable: true,
            }, ],
 
         });
}

    function postQueryParamsRentas(params) {
        params.action = "getReporteRentas";
        params.fechaInicial = "2018-01-01";
        params.fechaFinal = "2018-12-31"
        params.statusEvento = "Ocupado"; // add param1
        return params; // body data
    }
