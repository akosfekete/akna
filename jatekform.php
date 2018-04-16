<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['isfirstrun'] = true;
?>

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
                <label for="cheat">Cheat:</label><br>
                <select name="cheat" id="cheat">
                    <option value="0">Ki</option>
                    <option value="1">Be</option>
                </select><br><br>
                <input type="submit" value="Játék">
</form>