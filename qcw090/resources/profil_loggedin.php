        <div class="box" id="box2">
            <form action="profil.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="kep" value="<?php echo $var;?>" />
                <?php echo is_null($error) ? "" : "<label id=\"error\">$error</label><br>"; ?>
                <label for="profilkep">Profilkép megváltoztatása</label>
                <input type="file" name="profilkep" id="profilkep"><br>
                <input type="submit" value="Mentés">
            </form>
        </div> 