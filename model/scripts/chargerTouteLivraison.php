<?php
header('Access-Control-Allow-Origin: *');	// CORS policy
include("../../controller/connexion.php"); // Connexion à la BDD

$tabComplet = array();


    //            ----- REQUETE SQL -----
$requeteLivraisonCommande = "SELECT * FROM COMMANDE where A_Livrer = 'O' AND (Etat = 'prete' or Etat = 'enLivraison')";

    //            ----- donnée recuperees du PHP -----
$result = $pdo -> query($requeteLivraisonCommande);                      
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

    $tabComplet[] = $tabCommande;
          
    //            ----- REQUETE SQL -----    
    $requeteDetailCommande = "SELECT * FROM COM_DETAIL where NumCom = $numcommande";
         
    $result1 = $pdo -> query($requeteDetailCommande);                      
    while ($tabComDetail = $result1 -> fetch(PDO :: FETCH_ASSOC) ) {
          
        $numDetail = $tabComDetail['Num_Detail'];
        $quantite = $tabComDetail['Quant'];

        $tabComplet[] = $tabComDetail;

    //            ----- REQUETE SQL -----    
        $requeteDetail = "SELECT NomPizza FROM DETAIL where Num_Detail = $numDetail";

        $result2 = $pdo -> query($requeteDetail);
        while ($tabDetail = $result2 -> fetch(PDO :: FETCH_ASSOC) ) {
            $nomPizza = $tabDetail['NomPizza'];
            $tabComplet[] = $tabDetail;
        }
    }              
}
   
    /*echo"<br><br>";
    print_r($tabComplet);
    echo"<br><br>";*/

    //            ----- TRANSFORMER EN JSON -----
$tableauJsonCommande = json_encode($tabComplet);
$fichierJson1 = file_put_contents('livraisonTotal.json',$tableauJsonCommande);

/*echo"<br><br>";
echo $tableauJsonCommande; */ 
       
?>

<body>
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery --> 
    <script src="../../model/scripts/livraison.js"></script>  
</body>