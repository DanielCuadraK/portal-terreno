<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Meta, title, CSS, favicons, etc. -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Portal El Terreno</title>
      <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
      <link href="css/animate.min.css" rel="stylesheet">
      <!-- Custom styling plus plugins -->
      <link href="css/custom.css" rel="stylesheet">
      <link rel="stylesheet" href="css/jquery-ui.css">

      <link href="css/jquery-ui.theme.min.css" rel="stylesheet">
        <link href="css/calendar/fullcalendar.css" rel="stylesheet">
        <link href="css/calendar/fullcalendar.print.css" rel="stylesheet" media="print">
      <script src="js/jquery.min.js"></script>
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">

<!-- Latest compiled and minified JavaScript -->
      <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
      <!--[if lt IE 9]>
      <script src="../assets/js/ie8-responsive-file-warning.js"></script>
      <![endif]-->
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="nav-md">
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
                           <li><a href="#" onclick="generarPantallaCalendario()"><i class="fa fa-calendar"></i> Calendario <span class="fa fa-chevron-right"></span></a>
                           </li>
                           <li><a href="#" onclick="generarPantallaCotizaciones()"><i class="fa fa-edit"></i> Cotizaciones <span class="fa fa-chevron-right"></span></a>
                           </li>
                           <li><a href="#" onclick="generarPantallaClientes()"><i class="fa fa-users"></i>Clientes<span class="fa fa-chevron-right"></span></a>
                           </li>
                           <li><a href="#" onclick="generarPantallaServicios()"><i class="fa fa-exchange"></i> Servicios <span class="fa fa-chevron-right"></span></a>
                           </li>
                           <li><a href="#" onclick="generarPantallaProveedores()"><i class="fa fa-exchange"></i> Proveedores <span class="fa fa-chevron-right"></span></a>
                           </li>
                           <li><a href="#" onclick="generarPantallaReportes()"><i class="fa fa-bar-chart"></i> Reportes <span class="fa fa-chevron-right"></span></a>
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
                        <!--<li class="">
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
                        </li>-->
                        <!--<li role="presentation" class="dropdown">
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
                           </li>-->
                     </ul>
                  </nav>
               </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
            <div class="x_content" id="contenedorMensajes"></div>
            <div class = "x_content" id="contenedorPrincipalEncabezado"></div>
            <div class="x_panel">
            <div class="x_content" id="contenedorPrincipalDetalle"></div>
            <div class="x_content" id="calendar"></div>
            <!-- /page content-->
            <div id="contenedorPaginacion" class="text-center"></div>
            </div>
            <!-- footer content -->
            <!-- /footer content -->
         </div>
      </div>
    </div>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- Datatables -->
      <script type="text/javascript" src="js/moment.min2.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/calendar/fullcalendar.min.js"></script>
        <script src="js/calendar/es.js"></script>
      <script src="js/custom/clientes.js"></script>
      <script src="js/custom/portal.js"></script>
      <script src="js/custom/servicios.js"></script>
      <script src="js/custom/cotizaciones.js"></script>
      <script src="js/custom/calendario.js"></script>
      <script src="js/custom/proveedores.js"></script>
      <script src="js/custom/reportes.js"></script>
      <script src="js/custom/encuestas.js"></script>
      <script src="js/jquery-dateFormat.js"></script>
      <script> generarPantallaCalendario(); </script>
   </body>
</html>