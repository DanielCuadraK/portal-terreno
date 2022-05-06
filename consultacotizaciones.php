<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
        <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
</head>
<body>
<?php

$user = $_POST['user'];
$password = $_POST['pass'];

if($user == 'cuadra' && $password == 'cuadra')
{

require "connection.php";

$sql = "SELECT * FROM cotizaciones ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='example' class='table table-striped responsive-utilities jambo_table'>".
    "<thead>".
    "<tr class='headings'>".
    "<th>Nombre</th><th>Fecha</th><th>Comentarios</th><th>Asistentes</th><th>Evento</th><th>Acción</th>".
    "</tr></thead>".
    "<tbody>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nombre"]."</td><td>".$row["fecha"]."</td><td>"
        .$row["comentarios"]."</td><td>".$row["asistentes"]."</td><td>".$row["tipoevento"]."</td><td><input type='checkbox' class'tableflat'></td></tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 results";
}
$conn->close();
}
else {

	if(isset($_POST))
    {?>

            <form method="POST" action="cotizaciones.php">
            User <input type="text" name="user"></input><br/>
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
            </form>
    <?}
}
?>
</body>
</html>