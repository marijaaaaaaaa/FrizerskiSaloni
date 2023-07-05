<?php

$host = 'localhost';
$user = 'admin';
$password = 'admin';
$database = 'frizerskisaloni';
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
