<?php include("header.php"); ?>

                   <form action="" method="POST">
                    <label for="email" class="kotelezo">E-mail cím:</label> <br> <input type="text" name="email" placeholder="E-mail"> <br>
                    <label for="felhasznalonev" class="kotelezo">Felhasználónév:</label> <br> <input type="text" name=felhasznalonev placeholder="Felhasználónév"><br>
                    <label for="jelszo" class="kotelezo">Jelszó:</label> <br> <input type="text" name="jelszo" placeholder="Jelszó"> <br><br>
                    <label for="vezeteknev">Vezetéknév:</label> <br> <input type="text" name=vezeteknev placeholder="Vezetéknév"><br>
                    <label for="keresztnev">Keresztnév:</label> <br> <input type="text" name=keresztnev placeholder="Keresztnév"> <br>
                    <label for="nem">Nem:</label> <br>
                    <select name="nem" id="nem">
                        <option value="f">Férfi</option>
                        <option value="n">Nő</option>
                    </select> <br>
                    <input type="submit">
                    <p>A <span class="kotelezo">pirossal</span> jelölt mezők kötelezőek.</p>
                   </form>
                   
<?php include("footer.php"); ?>