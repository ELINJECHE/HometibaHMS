<?php   
session_start();
unset($_SESSION["login"]);
unset($_SESSION["FirstName"]);
header("Location:login.php");
?>
