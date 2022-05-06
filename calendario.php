<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal El Terreno - Calendario</title>

        <!-- Bootstrap core CSS -->

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/icheck/flat/green.css" rel="stylesheet">

        <link href="css/calendar/fullcalendar.css" rel="stylesheet">
        <link href="css/calendar/fullcalendar.print.css" rel="stylesheet" media="print">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link href="css/jquery-ui.theme.min.css" rel="stylesheet">

        <script src="js/jquery.min.js"></script>

        <!--[if lt IE 9]>
            <script src="../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>


    <body class="nav-md" onload="generarCalendario()">
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
                                </li>
                                <li><a href="#"><i class="fa fa-dollar"></i> Gastos <span class="fa fa-chevron-right"></span></a>
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
                                <h3>
                                    Calendario de eventos
                                </h3>
                            </div>

                            <div class="title_right">
                                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search for...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" onclick="generarCalendario()">Go!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <div id='calendar'></div>
                                        <div id='formulario'></div>

                                    </div>
                                </div>
                            </div>
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


                <!-- Start Calender modal -->
                <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Detalles Evento</h4>
                            </div>
                            <div class="modal-body">
                                <div id="testmodal" style="padding: 5px 20px;">
                                    <form id="antoform" class="form-horizontal calender" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fecha</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="fechaEvento" name="title">
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Cliente</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="clienteAutocomplete">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="statusEvento">
                                                    <option>Ocupado</option>
                                                    <option>Apartado</option>
                                                    <option>Cancelado</option>
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tipo de Evento</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="tipoEvento" name="title">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Invitados</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="invitadosEvento" name="title">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Hora Inicio</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="horaInicioEvento" name="title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Hora Fin</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="horaFinEvento" name="title">
                                            </div>
                                        </div>                                                                              
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Comentarios</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" style="height:55px;" id="comentariosEvento" name="descr"></textarea>
                                                <input type = "hidden" id="idEvento">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default antoclose" id="btnCerrarModal" data-dismiss="modal">Cerrar</button>
                                <!--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#CalenderModalConfirm">Eliminar</button> -->
                                <button type="button" class="btn btn-primary antosubmit" data-dismiss="modal" onclick="guardarEvento()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

        <!--Modal Confirm-->
                <div id="CalenderModalConfirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel2">¿Desea eliminar la fecha selecciondada?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btnEliminarEvento" data-dismiss="modal" id="btnEliminarEvento" onclick="eliminarEvento()">Eliminar</button>                                
                                <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
                <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>




                <!-- End Calender modal -->
                <!-- /page content -->
            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <script src="js/bootstrap.min.js"></script>
            <script src="js/validator/validator.js"></script>

        <script src="js/nprogress.js"></script>
        <!-- chart js -->
        <script src="js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="js/icheck/icheck.min.js"></script>
        <script src="js/custom/portal.js"></script>
        <script src="js/custom.js"></script>

        <script src="js/moment.min.js"></script>
        <script src="js/calendar/fullcalendar.min.js"></script>
        <script src="js/calendar/es.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/custom/calendario.js"></script>
    </body>

</html>