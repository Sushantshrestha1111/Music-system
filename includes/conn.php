<?php 
$severname="localhost";
$username="root";
$password="";
$dbname="puud";
$conn = new mysqli($severname,$username,$password,$dbname);
if (mysqli_connect_error()) {
	header('location :../index.php');
  die("Database connection failed: " . mysqli_connect_error());
}