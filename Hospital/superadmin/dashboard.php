<?php
session_start();
// if (!empty($_SESSION["admin"])) {
//     header('Locatio:../login.php');
// }
include '../config.php';
$qry = "SELECT * from users  ";
$query = "SELECT * from doctors WHERE status='pending'";
$sql = "SELECT * from users WHERE Role='patient'  ";
$sqlqry = " SELECT * FROM appointment WHERE status ='pending'";
// executing queries
$query_run = mysqli_query($conn, $qry);
$qry_run = mysqli_query($conn, $query);
$sql_run = mysqli_query($conn, $sql);
$qrysql = mysqli_query($conn, $sqlqry);
// fetching the rows

include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
include "includes/main.php";
include "includes/footer.php";
?>