<?php
    // Se connecter a la BDD
    require_once("../../controller/connexion.php");
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    $connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);

    //            ----- REQUETE SQL -----    
    $requeteTouteCommande = "SELECT * FROM COMMANDE ";
    $requeteLivraisonCommande = "SELECT * FROM COMMANDE where Etat = 'pretALivrer'";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Piz.zip - Livraison</title>
    <link href="../model/style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        //         -----  HEADER -----
        include("../pages/Header.php");
    ?>


    <!-- <p> Livreur : <?php echo $_SESSION['prenom']; ?> <br/><br/> </p> -->
    <h1>Commandes à Livrer :</h1> <br/><br/>
    <input type="button" value="AFFICHER LIVRAISON" onclick="actionAffiche()">

    <div id="informations"></div>

<!--                    -------- TABLEAU Commande ---------->
<center>
                <table class="tftable" border="1">
                <tr><th>COMMANDE</th><th>INFOS</th><th>ACTION</th></tr>
                
                <?php        
                   $result = $connex -> query($requeteLivraisonCommande);                      
                   while ($tabCommande = $result -> fetch(PDO :: FETCH_ASSOC) ) {

                        $numcommande = $tabCommande['NumCom'];
                        $nomClient = $tabCommande['NomClient'];
                        $telephoneClient = $tabCommande['TelClient'];
                        $adresseClient = $tabCommande['AdrClient'];
                        $codePostal = $tabCommande['CP_Client'];
                        $VilleClient = $tabCommande['VilClient'];
                        $dateCommande = $tabCommande['Date'];
                        $HeureDispo = $tabCommande['HeureDispo'];
                        $emballage = $tabCommande['TypeEmbal'];
                        $prix = $tabCommande['CoutLiv'];
                        //$livreur = $tabCommande['idLivreur'];
                        //$archive = $tabCommande['DateArchiv'];
                        $etatCommande = $tabCommande['Etat'];   
                ?>
                
                <tr>
                    <td> <?php echo $numcommande?></td>
                    <td><?php echo "Nom : $nomClient <br> Telephone : $telephoneClient <br> Adresse : $adresseClient <br> $codePostal <br> $VilleClient <br> Date : $dateCommande à $HeureDispo <br> Emballage : $emballage<br> Prix : $prix €<br> ETAT : $etatCommande<br>"; ?></td>
                    <td><input type="button" value="LIVRE" onclick="action()"></td> 
                </tr>        

                <?php        
                    }				
                ?>                            
                </table> <br>
    </center>

<!--                    -------- FIN TABLEAU Commande ---------->

    <?php
    //         -----  FOOTER -----
    include("../pages/Footer.php");
    ?>

    <script src="../../model/scripts/livraison.js"></script>    
</body>

</html>