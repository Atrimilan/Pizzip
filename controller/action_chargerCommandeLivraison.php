<?php
header('Access-Control-Allow-Origin: *');	// CORS policy

require_once("../controller/connexion.php");	// Connexion à la BDD
//include("../controller/connexion.php");	// Connexion à la BDD

    //            ----- REQUETE SQL -----
$requeteLivraisonCommande = "SELECT * FROM COMMANDE where A_Livrer = 'O' AND (Etat = 'prete' or Etat = 'enLivraison')";

    //            ----- donnée recuperees du PHP -----
$result = $pdo -> query($requeteLivraisonCommande);                      
while ($tabCommande = $result -> fetchAll(PDO :: FETCH_ASSOC) ) {

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

    //            ----- TRANSFORMER EN JSON -----
        $tableauJson = json_encode($tabCommande);
        echo $tableauJson;    
        $fichierJson = file_put_contents('livraison.json',$tableauJson);
        //$fichierJson = file_put_contents('livraison.json',$tableauJson, FILE_APPEND);

}
?>
<body>
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery -->

    <script src="../model/scripts/livraison.js"></script>  
</body>
