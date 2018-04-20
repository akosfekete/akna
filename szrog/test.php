
<?php 
    include("Menus.php");
    $menupont = new TrollMenupont("Valami", "#", TRUE);
    $menupont1 = new Menupont("Valami2", "#", FALSE);
    $menupont2 = new TrollMenupont("Valami3", "#", FALSE);
?>
<html>
    <head>

    </head>
    <body>
        <?php
             echo $menupont->toHtml();
        ?>
    </body>
</html>