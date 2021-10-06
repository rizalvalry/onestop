<?php
date_default_timezone_set('Asia/Jakarta');

$server = "localhost";
$username = "root";
$password = "";
$database = "laundry_aji";

$conn = mysqli_connect($server, $username, $password, $database);

//mysqli_select_db($database) or die("Datebase tidak bisa dibuka");
?>
