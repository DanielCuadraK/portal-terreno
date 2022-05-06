<?php
function openConnection(){

	$pdo = new PDO('mysql:dbname=portal_terreno;host=localhost;charset=utf8', 'root', '',
               array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    return $pdo;
}
?>