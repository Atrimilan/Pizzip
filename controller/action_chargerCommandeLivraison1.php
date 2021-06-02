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


     $requeteDetailCommande = "SELECT * FROM COM_DETAIL where NumCom = $numcommande";
     $result1 = $pdo -> query($requeteDetailCommande);                      
    while ($tabComDetail = $result1 -> fetchAll(PDO :: FETCH_ASSOC) ) {
         
         $numDetail = $tabComDetail['Num_Detail'];
         $quantite = $tabComDetail['Quant'];

         $requeteDetail = "SELECT * FROM DETAIL where Num_Detail = $numDetail";
         $result2 = $pdo -> query($requeteDetail);                      
         while ($tabDetail = $result2 -> fetchAll(PDO :: FETCH_ASSOC) ) {
             
             $nomPizza = $tabDetail['NomPizza'];
        
             

    //            ----- TRANSFORMER EN JSON -----
        
        $tableauJsonCommande = json_encode($tabCommande);
        $tableauJsonComDetail = json_encode($tabComDetail);
        $tableauJsonDetail = json_encode($tabDetail);
        var_dump($tabComDetail) ;
        var_dump($tabCommande);
        var_dump($tabDetail);
        //echo $tableauJsonComDetail;
        //echo $tableauJsonDetail;
        //echo $tableauJsonCommande;  

        $fichierJson1 = file_put_contents('livraison.json',$tableauJsonCommande);
        $fichierJson2 = file_put_contents('detailcommande.json',$tableauJsonComDetail);
        $fichierJson3 = file_put_contents('detailpizza.json',$tableauJsonDetail);       
        }
    }        
}

?>
<body>
    <p> <?php echo $numcommande ?> </p>
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery --> 
    <script src="../../model/scripts/livraison.js"></script>  
</body>
