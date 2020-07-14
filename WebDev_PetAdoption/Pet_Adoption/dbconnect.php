<?php
$host="localhost";
$user="root";
$password="";
$db="findahome";
$con=mysqli_connect($host,$user,$password) or die("Connection Failed:".mysqli_connect_error());
mysqli_select_db($con,$db) or die(mysqli_error($con));
?>