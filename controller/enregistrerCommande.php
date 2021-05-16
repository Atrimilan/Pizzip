<?php
header('Access-Control-Allow-Origin: *');	// CORS policy

require_once("./connexion.php");	// Connexion à la BDD

$success = true;

if (!empty($_GET['modeCommande']) && !empty($_GET['nom']) && !empty($_GET['prenom'])  && !empty($_GET['tel']) && !empty($_GET['typeBoite']) && !empty($_GET['verifPizza']) && !empty($_GET['verifPizzaQuant'])) {

	$modeCommande = $_GET['modeCommande'];
	$nom = $_GET['nom'];
	$prenom = $_GET['prenom'];
	$typeBoite = $_GET['typeBoite'];
	$tel = $_GET['tel'];	// Tel long de 10 char, premier = 0, est numérique
	$verifPizza = str_replace(',', '', $_GET['verifPizza']);	// enlever la virgule finale
	$verifPizzaQuant = str_replace(',', '', $_GET['verifPizzaQuant']);	// enlever la virgule finale

	if ($typeBoite == "isotherme") {
		$typeBoite = "thermo";	// dans la BDD 'isotherme' => 'thermo'
	} else if ($typeBoite != "carton") {
		$success = false;
	}

	if (is_numeric($prenom) == true || is_numeric($nom) == true) {	//---Vérification
		$success = false;
	}
	if (strlen($tel) != 10 || (strlen($tel) == 10 && substr($tel, 0, 1) == '0') == false || is_numeric($tel) == false) {	//---Vérification
		$success = false;
	}

	$resultVerifPizza = $pdo->query("SELECT * FROM PIZZA WHERE NomPizza='" . $verifPizza . "'");
	$ligneVerifPizza = $resultVerifPizza->fetch(PDO::FETCH_ASSOC);	// Vérifier l'existence de la pizza dans la BDD
	if (!$ligneVerifPizza || $verifPizzaQuant <= 0) {
		$success = false;	// Si la pizza n'est pas trouvée
	}

	if ($modeCommande == "livraison" && !empty($_GET['adresse']) && !empty($_GET['codePostal']) && !empty($_GET['ville']) && $success == true) {

		$adresse = $_GET['adresse'];
		$codePostal = $_GET['codePostal'];	// Code Postal long de 5 char, est numérique
		$ville = $_GET['ville'];

		if (is_numeric($ville) == true) {	//---Vérification
			$success = false;
		}
		if (!(strlen($codePostal) == 5 && is_numeric($codePostal))) {	//---Vérification
			$success = false;
		}

		if ($success == true) {
			try {
				$insert = $pdo->exec("INSERT INTO COMMANDE(NomClient,TelClient,AdrClient,CP_Client,VilClient,Date,HeureDispo,TypeEmbal,
				A_Livrer,PrixCom,CoutLiv,Etat) VALUES ('" . $nom . " " . $prenom . "','" . $tel . "','" . $adresse . "','" . $codePostal . "','" . $ville . "',
				CURRENT_DATE,CURRENT_TIME,'" . $typeBoite . "','O','100','15','enLivraison')");	// Requete PDO
			} catch (PDOException $e) {
				print $e->getMessage();
			}
		}
	} else if ($modeCommande == "aEmporter" && $success == true) {
		if ($success == true) {
			try {
				$insert = $pdo->exec("INSERT INTO COMMANDE(NomClient,TelClient,Date,HeureDispo,TypeEmbal,
				A_Livrer,PrixCom,Etat) VALUES ('" . $nom . " " . $prenom . "','" . $tel . "',
				CURRENT_DATE,CURRENT_TIME,'" . $typeBoite . "','N','100','enLivraison')");	// Requete PDO
			} catch (PDOException $e) {
				print $e->getMessage();
			}
		}
	} else {
		$success = false;
	}
	/*$fic = $_GET['fic'];

	$fourId = "";
	$timestamp = array();
	$value = array();

	// Connexion à la BDD
	require_once("./connexion.php");

	// Requete SQL par PDO
	$result = $pdo->query("SELECT data_four_id,data_timestamp,data_value FROM four_data WHERE data_four_id = '" . $fic . "'");

	while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
		$fourId = $ligne['data_four_id'];	// on a qu'un seul ID, pas besoin de l'enregistrer dans un array
		array_push($timestamp, $ligne['data_timestamp']);	// enregistrer chaque date
		array_push($value, $ligne['data_value']);			// enregistrer chaque température
	}

	$contenu = $fourId;	// créer une chaine d'elements, commencant pas l'ID du four
	foreach ($timestamp as $temps => $t) {
		$contenu .= "," . $timestamp[$temps] . "," . $value[$temps];	// puis pour toutes les dates disponibles, ont ajoute la date
	}																	// et la température correspondante, dans la chaine
	$cont = explode(",", $contenu);

	$obj = new stdClass();
	foreach ($cont as $key => $value) {
		$obj->{" " . $key} = $value;
	}*/
} else {
	$success = false;
}

$resultat = ["success" => $success];
echo json_encode($resultat);	// envoyer le tout au format JSON