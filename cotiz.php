<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php

$user = $_POST['user'];
$password = $_POST['pass'];

if($user == 'cuadra' && $password == 'cuadra')
{

$servername = "localhost";
$username = "elterren_info";
$password = "RS1[l1V9JSOM";
$dbname = "elterren_elterreno";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM cotizaciones";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Nombre</th><th>Fecha</th><th>Comentarios</th><th>Asistentes</th><th>Evento</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nombre"]."</td><td>".$row["fecha"]."</td><td>"
        .$row["comentarios"]."</td><td>".$row["asistentes"]."</td><td>".$row["evento"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
}
else {

	if(isset($_POST))
    {?>

            <form method="POST" action="cotiz.php">
            User <input type="text" name="user"></input><br/>
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
            </form>
    <?}
}
?>
</body>
</html>