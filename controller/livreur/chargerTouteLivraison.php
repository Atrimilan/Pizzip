<?php
header('Access-Control-Allow-Origin: *');	// CORS policy
require_once("../../controller/connexion.php"); // Connexion à la BDD

$tabComplet = array();

    //            ----- REQUETE SQL -----
$requeteLivraisonCommande = "SELECT * FROM COMMANDE
INNER JOIN
	COM_DETAIL on (COMMANDE.NumCom = COM_DETAIL.NumCom)
INNER JOIN
    DETAIL on (COM_DETAIL.Num_Detail = DETAIL.Num_Detail)
where A_Livrer = 'O' AND (Etat = 'prete' or Etat = 'enLivraison')";

    //            ----- donnée recuperees du PHP -----
$result = $pdo -> query($requeteLivraisonCommande);                      
while ($tabCommande = $result -> fetch(PDO :: FETCH_ASSOC) ) {

    $tabComplet[] = $tabCommande;
              
}

$tableauJsonCommande = json_encode($tabComplet); // encode le tableu en JSON

echo $tableauJsonCommande;

