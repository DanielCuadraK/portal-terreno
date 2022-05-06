<?php
require "connection.php";

/*$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "elterreno";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->select_db("elterreno");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */


$query = "select * from eventos ";

$conn->real_query($query);
$res = $conn->use_result();

$events = array();
while ($row = $res->fetch_assoc()) {
    $start = $row['fechaEvento'];
    //$end = $row['end'];
    //$title = $row['statusEvento'];
    $eventsArray['title'] = $row['statusEvento'];
    $eventsArray['start'] = $start;
    $eventsArray['nuevoCampo'] = 'HelloWorld';
    $eventsArray['idEvento'] = $row['idEvento'];

    switch ($row['statusEvento']) {
    case "OCUPADO":
        $eventsArray['backgroundColor'] = '#BFF2CA';
        break;
    case "APARTADO":
        $eventsArray['backgroundColor'] = '#C7CED1';
        break;
    case "CANCELADO":
        $eventsArray['backgroundColor'] = '#FF8CA7';
        break;
    }
    $events[] = $eventsArray;
}
echo json_encode($events);
?>
