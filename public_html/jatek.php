<?php include("header.php"); ?>
        
<?php
    if(isset($_SESSION['loggedin'])) {
        include("jatekform.php");
    }
    else {
        include("nemjogosult.php");
    }
?>
        
<?php include("footer.php"); ?>