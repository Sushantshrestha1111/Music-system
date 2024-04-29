<?php 
$sn="localhost";
$un="root";
$pass="";
$dbname="twowheelers";
error_reporting(0);
$conn = new mysqli($sn,$un,$pass,$dbname);
if(!$conn){
	die("connection failed".mysqli_connect_error());
}else{
	$email=$_POST['email'];
$sql = "SELECT * FROM bike where bike_name=$email";
$result = mysqli_query($conn, $sql);
	if (mysqli_fetch_assoc($result)) {
		echo "user  found";
	}else{
		echo "user not found";
	}
	$conn->close();

}
?>
