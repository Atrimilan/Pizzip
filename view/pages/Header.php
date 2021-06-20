
<ul>
    <li><a  href="../Page_login.php">Deconnexion<img src="../../../model/images/pizzipLogo.png" width="20"></a></li>

    <li> <!-- -------- Selection Livreur depuis BDD ---------->

                Livreur : <select name="espaceLivreur" size="1">
                    <?php
                    $requeteToutLivreur = "SELECT * FROM LIVREUR";
                    $result = $pdo->query($requeteToutLivreur);
                    while ($tabLivreur = $result->fetch(PDO::FETCH_ASSOC)) {
                        $idduLivreur = $tabLivreur['IdLivreur'];
                    ?>
                        <option value="<?php echo $idduLivreur; ?>"> <?php echo $tabLivreur['Nom']; ?> <?php echo $tabLivreur['Prenom']; ?></option>
                    <?php
                    }
                    ?>
                </select><br><br>
                <!--                    -------- FIN Selection Livreur depuis BDD ---------->
                <!--<input id="bouton_Liv" type="submit" name="bouton_Livreur" value="OK"> -->

        </li>
</ul>