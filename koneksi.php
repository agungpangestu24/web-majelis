<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_majelis";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!isset($_SESSION)) { session_start(); }
?>
