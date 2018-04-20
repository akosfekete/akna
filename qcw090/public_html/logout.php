<?php
require_once($_SERVER['DOCUMENT_ROOT']."/qcw090/constants.php");
session_start();

session_unset();
session_destroy();
header("refresh: 1 ; url = login.php");
include_once(TEMPLATES_PATH."/header.php"); 

echo "<h1>Sikeres kijelentkezés</h1>";

include_once(TEMPLATES_PATH."/footer.php"); 
?>
