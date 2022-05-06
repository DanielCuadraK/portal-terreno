<?php

require_once('connection.php');

//$conn = openConnection();

$pdo = openConnection();

$user = $_POST['user'];
$password = md5($_POST['pass']);

$stmt = $pdo->prepare('SELECT * FROM usuarios where usuario=:usuario AND pass = :password');
$stmt->execute(array(':usuario' => $user,':password' => $password));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


//$sql = "SELECT * FROM usuarios where usuario='".$user."' and pass ='".$password."'";
//$result = $conn->query($sql);

if (!empty($row['usuario']))
{
  session_start();
  session_regenerate_id(); // regenerate session_id to help prevent session hijacking

  $_SESSION['logged_in'] = true;
  $_SESSION['username'] = $row['usuario'];
  $_SESSION['email'] = $row['email'];  
  echo 'true';


  // add more session variables about the user as needed
}
else
{
    echo 'false';
}
?>