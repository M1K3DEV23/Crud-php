<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "phpcrud";


$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_errno) {
    die("Conexion fallida" . $conn->connect_error);
}

?>