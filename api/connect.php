<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "voting";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn)
die(mysqli_connect_error());




?>
