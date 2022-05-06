function generarPantallaEncuestas() {
    $('#contenedorPrincipalEncabezado').hide();
    $('#contenedorPaginacion').html(""); 
    html =  "<div class='page-title'>" +
                        "<div class='title_left'>" +
                            "<h3>Preguntas Encuesta </h3>" +
                        "</div>" +
            "</div>";
    $('#contenedorPrincipalEncabezado').html(html);
    $('#contenedorPrincipalEncabezado').fadeIn('slow');
    generarTablaPreguntas();
    $('#contenedorPrincipalDetalle').hide();
    $('#contenedorPrincipalDetalle').fadeIn('slow');

}

function generarTablaPreguntas() {
    $('#contenedorPrincipalDetalle').hide();
    $.ajax({
        type: "POST",
        url: "handlerEventos.php",
        data: 'action=getPreguntaEncuestaAll',
        dataType: 'json',
        success: function(msg) {
            var contenidoTabla = "Sin resultados";
            totalServicios = 0;
            if (msg.length > 0) {
                contenidoTabla = "<div><table class='table table-striped responsive-utilities jambo_table tabla-cursor'>" +
                    "<thead>" +
                    "<tr class='headings'>" +
                    "<th>Pregunta</th>" +
                    "</tr></thead>" +
                    "<tbody>";
                for (i in msg) {

                    contenidoTabla = contenidoTabla + "<tr onclick='detallePregunta("+ msg[i]['idPregunta'] +
                        ")'><td>" + msg[i]['preguntaEncuesta'] + "</td>" +
                        "</td>" +
                        "</tr>";
                }

            }
                contenidoTabla = contenidoTabla + "</tbody></table></div>" +
                "<div class='btn-toolbar text-center'>" +
                "<button class='btn btn-primary btn-lg boton-fijo' onclick='detallePregunta(0)'>Agregar</button>" +
                "</div>";
            $('#contenedorPrincipalDetalle').html(contenidoTabla);
            $('#contenedorPrincipalDetalle').fadeIn('slow');

        },
        error: function(e) {
            console.log(e.responseText);
        }

    });
}