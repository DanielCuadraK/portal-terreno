<html>
<head>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
</head>
<body>
      <?php
         include('auth.php');
         ?>
<table  id="table"
                        data-show-columns="true"
                        data-height="460">
            </table>

<script type="text/javascript">
  
   var $table = $('#table');
         $table.bootstrapTable({
            url: 'handlerEventos.php',
            method: "post",
            queryParams: "postQueryParams",
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
    function postQueryParams(params) {
        params.action = "getReporteServicios"; // add param1
        return params; // body data
    }
</script>
</body>
</html>