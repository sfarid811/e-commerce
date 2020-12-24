<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);


$cookie_name = 'eshop';

setcookie($cookie_name, "", time() - 3600);
//setcookie(session_name(), '', -666,);
echo "logged out";

//header("location : signin.php");
header('Refresh: 1; URL = signin.php');

 ?>
