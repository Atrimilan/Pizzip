<?php
    // Se connecter a la BDD
    require_once("../../controller/connexion.php");
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    $connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);

    //            ----- REQUETE SQL -----    
    $requeteTouteCommande = "SELECT * FROM COMMANDE ";
    $requeteLivraisonCommande = "SELECT * FROM COMMANDE where Etat = 'prete' and A_Livrer = 'O' ";
    

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Piz.zip - Livraison</title>
    <link href="../model/style/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style type="text/css">
        .tftable {font-size:12px;color:#333333;width:90%;border-width: 5px;border-color: #729ea5;border-collapse: collapse;}
        .tftable th {font-size:16px;background-color:#f1c50e;border-width: 3px;padding: 8px;border-style: solid;border-color: black;text-align:center;}
        .tftable tr {background-color:#ffffd3;}
        .tftable td {font-size:16px;border-width: 3px;padding: 8px;border-style: solid;border-color: black;text-align:center;}
        .tftable tr:hover {background-color:#ffffff;}
    </style>

</head>

<body>
    <?php
        //         -----  HEADER -----
        //include("../pages/Header.php");
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

                        $requeteDetailCommande = "SELECT * FROM COM_DETAIL where NumCom = $numcommande";
                        $result1 = $connex -> query($requeteDetailCommande);                      
                        while ($tabComDetail = $result1 -> fetch(PDO :: FETCH_ASSOC) ) {
                            
                            $numDetail = $tabComDetail['Num_Detail'];
                            $quantite = $tabComDetail['Quant'];

                            $requeteDetail = "SELECT * FROM DETAIL where Num_Detail = $numDetail";
                            $result2 = $connex -> query($requeteDetail);                      
                            while ($tabDetail = $result2 -> fetch(PDO :: FETCH_ASSOC) ) {
                                
                                $nomPizza = $tabDetail['NomPizza'];
                                                        
                        
                ?>
                
                <tr id="ligne_">
                    <td> <?php echo $numcommande?></td>
                    <td><?php echo "Nom : $nomClient <br> Telephone : $telephoneClient <br> Adresse : $adresseClient  $codePostal $VilleClient <br> Date : $dateCommande à $HeureDispo <br> Emballage : $emballage<br> Prix : $prix €<br> ETAT : $etatCommande<br> Quantité : $quantite Pizza $nomPizza <br>"; ?></td>
                    <td><input type="button" id="etat_commande_<?php echo $numcommande?>" value="LIVRE" onclick="action()"></td> 
                </tr> 
                       
                
                <?php
                    }
                    }        
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

    <script type="text/javascript">
    // bug : ne prend que le dernier
        var commande = "<?php echo $numcommande?>";
        var livraison = document.getElementById("ligne_");

        function action() {
            livraison.style.background = "green";
            alert(commande);
        }

    </script> 

</body>

</html>