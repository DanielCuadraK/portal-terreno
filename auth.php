<?php
// inc/auth.php
session_start();
if (!($_SESSION['logged_in'])) {
  header("Location: index.php"); // user is not logged in, redirect to login page
  exit;
}
?>