<?php
session_start();

session_unset();
session_destroy();

include("header.php");

echo "<a href=\"login.php\">Vissza</a>\n";

include("footer.php");
?>

<? include("header.php"); ?>
<? include("footer.php"); ?>