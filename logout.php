<?php
session_start();

session_unset();
session_destroy();
header('refresh: 1 ; url = http://localhost/akna/login.php');
include("header.php");

echo "<h1>Sikeres kijelentkezés</h1>";

include("footer.php");
?>
