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

    /*$numcommande = $tabCommande['NumCom'];
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
    $numDetail = $tabCommande['Num_Detail'];
    $quantite = $tabCommande['Quant'];
    $nomPizza = $tabCommande['NomPizza'];*/

    $tabComplet[] = $tabCommande;
              
}

$tableauJsonCommande = json_encode($tabComplet);

echo $tableauJsonCommande;

