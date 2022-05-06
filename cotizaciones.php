<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal El Terreno - Cotizaciones</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link href="css/jquery-ui.theme.min.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/custom/cotizaciones.js"></script>


    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md" onload="generarTablaCotizaciones()">
<?php
include('auth.php');
?>
    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><span>El Terreno</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="calendario.php"><i class="fa fa-calendar"></i> Calendario <span class="fa fa-chevron-right"></span></a>
                                </li>
                                <li><a href="cotizaciones.php"><i class="fa fa-edit"></i> Cotizaciones <span class="fa fa-chevron-right"></span></a>
                                </li>
                                <li><a href="clientes.php"><i class="fa fa-users"></i>Clientes<span class="fa fa-chevron-right"></span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-exchange"></i> Proveedores <span class="fa fa-chevron-right"></span></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/img.jpg" alt="">John Doe
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Cotizaciones <button class="btn btn-success" data-toggle="modal" data-target="#cotizacionModal" onclick="limpiarCampos()">+</button></h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                <label class="control-label">Filtrar por status:</label>
                                    <select class="form-control" id="filtroStatusCotizacion" onchange="generarTablaCotizaciones()">
                                        <option>Abierta</option>
                                        <option>En proceso</option>
                                        <option>Cerrada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div id="mensajes" class="x_title">
                                    <h2></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="tablaCotizaciones" class="x_content">
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>
                    <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">
                            <span class="lead"></i> El Terreno</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
                    
                </div>
                <!-- /page content -->
            </div>

        </div>


                 <!--Modal Confirm-->
                <div id="cotizacionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Detalles de Cotización</h4>
                            </div>
                            <div class="modal-body">
                                <div id="testmodal" style="padding: 5px 20px;">
                                    <form id="antoform" class="form-horizontal calender" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nombre</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nombreCotizacion">
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="emailCotizacion">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Teléfono</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="telefonoCotizacion">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fecha Evento</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" style="z-index: 1151 !important ;"id="fechaEventoCotizacion" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tipo Evento</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="tipoEventoCotizacion">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Asistentes</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="asistentesCotizacion">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Origen</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="origenCotizacion">
                                                    <option>Teléfono</option>
                                                    <option>Visita</option>
                                                    <option>Página web</option>
                                                    <option>Facebook</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="statusCotizacion">
                                                    <option>Abierta</option>
                                                    <option>En proceso</option>
                                                    <option>Cerrada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Comentarios</label>
                                            <div class="col-sm-9">
                                                <textarea rows="2" class="form-control" id="comentariosCotizacion"></textarea>
                                                <input type = "hidden" id="idCotizacion">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cotizacionModalConfirm">Eliminar</button>
                                <button type="button" class="btn btn-primary antosubmit" data-dismiss="modal" onclick="updateCotizacion()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


        <!--Modal Confirm-->
                <div id="cotizacionModalConfirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel2">¿Desea eliminar la cotización seleccionada?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnEliminarCotizacion" onclick="deleteCotizacion()">Eliminar</button>                                
                                <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>


        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/moment.min2.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/custom/portal.js"></script>
        <script type="text/javascript">
        $( "#fechaEventoCotizacion" ).datepicker({
            dateFormat: 'yy-mm-dd',
            inline: true,
            locale: 'es'
        });
        $("#tipoEventoCotizacion").autocomplete({
source: "getCotizacionEventoAutocomplete.php",
minLength: 2
});
        </script>
</body>
</html>