<?php
$server="localhost";
$uname="root";
$pass="";

$con = mysqli_connect($server,$uname,$pass,"erpdb");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}