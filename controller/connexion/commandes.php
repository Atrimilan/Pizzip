<?php
    // Se connecter a la BDD
    require("connexion.php");
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    $connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);

    //            ----- REQUETE SQL -----    
    $requeteTouteCommande = "SELECT * FROM COMMANDE ";
    $requeteLivraisonCommande = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <!--                    -------- TABLEAU Commande ---------->
    <center>
                <table class="tftable" border="1">
                <tr><th>COMMANDE</th><th>INFOS</th></tr>
                
                <?php        
                   $result = $connex -> query($requeteTouteCommande);                      
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
                </tr>        

                <?php        
                    }				
                ?>                            
                </table> <br>
    </center>

<!--                    -------- FIN TABLEAU Commande ---------->
</body>
</html>

    