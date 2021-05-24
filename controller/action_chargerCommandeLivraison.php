<?php
header('Access-Control-Allow-Origin: *');	// CORS policy

    //            ----- N'affiche pas les erreurs PHP -----
ini_set('display_errors', false); // false pour cacher
ini_set('display_startup_errors', false);

//require_once("../controller/connexion.php");	// Connexion à la BDD
include("../controller/connexion.php");	// Connexion à la BDD

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


     //$requeteDetailCommande = "SELECT * FROM COM_DETAIL where NumCom = $numcommande";
     //$result1 = $pdo -> query($requeteDetailCommande);                      
     //while ($tabComDetail = $result1 -> fetch(PDO :: FETCH_ASSOC) ) {
         
         //$numDetail = $tabComDetail['Num_Detail'];
         //$quantite = $tabComDetail['Quant'];

         //$requeteDetail = "SELECT * FROM DETAIL where Num_Detail = $numDetail";
         //$result2 = $pdo -> query($requeteDetail);                      
         //while ($tabDetail = $result2 -> fetch(PDO :: FETCH_ASSOC) ) {
             
             //$nomPizza = $tabDetail['NomPizza'];     

    //            ----- TRANSFORMER EN JSON -----
        $tableauJson = json_encode($tabCommande);
        //$tableauJson1 = json_encode($tabComDetail);
        //$tableauJson2 = json_encode($tabDetail);
        //echo $tableauJson1;    
        $fichierJson = file_put_contents('livraison.json',$tableauJson);

        //}
    //}
}

?>
<body>
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery --> 
    <script src="../../model/scripts/livraison.js"></script>  
</body>
