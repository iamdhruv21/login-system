<?php

$servername = "127.0.0.2:3306";
$username = 'root';
$password = '@21Nov2004';
$database = 'users';

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("error". mysqli_connect_error($conn));
}

?>