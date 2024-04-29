<?php 
if (isset($_COOKIE['admin'])) {
	$title="Dhun - Dashboard";
	$href="../";
}elseif(isset($_COOKIE['user'])){
	$title="Dhun";
	$href="";
}else{
	$title="Dhun - login or Signup";
	$href="";
}
echo "
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
	<title>".$title."</title>
	<link rel='stylesheet' type='text/css' href='".$href."css/pood.css'>
	<link rel='stylesheet' type='text/css' href='".$href."css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.15.2/css/all.css' integrity='sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu' crossorigin='anonymous'>
	<link href='https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Outlined' rel='stylesheet'>
</head> ";