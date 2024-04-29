<?php 
session_start();
setcookie('admin',$_COOKIE['admin'],time()-3600,'/pood');
setcookie('user',$_COOKIE['user'],time()-3600,'/pood');

setcookie('pass',$_COOKIE['pass'],time()-3600,'/pood');
setcookie('uname',$_COOKIE['uname'],time()-3600,'/pood');

session_destroy();
header('location: ../index.php');
die();
