
<?php
session_start();
if (!isset($_SESSION["login"])) {
    header('Location:../login.php');
}
include "../config.php";
include "includes/header.php";
include "includes/topnav.php";
include "includes/sidenav.php";
include "includes/main.php";
include "includes/footer.php";
?>