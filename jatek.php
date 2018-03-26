<?php
session_start();
$_SESSION['isfirstrun'] = true;

?>

<?php include("header.php"); ?>
        
            <form action="akna.php" method="get">
                <label for="aknaszam">Nehézség: </label> <br>
                <select name="nehezseg" id="nehezseg">
                    <option value="0">Könnyű</option>
                    <option value="1">Közepes</option>
                    <option value="2">Nehéz</option>
                </select><br><br>
                <label for="mezomeret">Méret:</label><br>
                <select name="mezomeret" id="mezomeret">
                    <option value="10">10X10</option>
                    <option value="15">15X15</option>
                    <option value="20">20X20</option>
                </select><br><br>
                <input type="submit">
            </form>
        
<?php include("footer.php"); ?>