<?php
header('Access-Control-Allow-Origin: *');	// CORS policy

require_once("./connexion.php");	// Connexion à la BDD

$success = true;
$idAutoInc;
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
				CURRENT_DATE,CURRENT_TIME,'" . $typeBoite . "','O','100','15','nonTraitee')");	// Requete PDO
			} catch (PDOException $e) {
				print $e->getMessage();
			}
			$idAutoInc = $pdo->lastInsertId();
		}
	} else if ($modeCommande == "aEmporter" && $success == true) {
		if ($success == true) {
			try {
				$insert = $pdo->exec("INSERT INTO COMMANDE(NomClient,TelClient,Date,HeureDispo,TypeEmbal,
				A_Livrer,PrixCom,Etat) VALUES ('" . $nom . " " . $prenom . "','" . $tel . "',
				CURRENT_DATE,CURRENT_TIME,'" . $typeBoite . "','N','100','nonTraitee')");	// Requete PDO
			} catch (PDOException $e) {
				print $e->getMessage();
			}
			$idAutoInc = $pdo->lastInsertId();
		}
	} else {
		$success = false;
	}
} else {
	$success = false;
}

$resultat = ["success" => $success, "numCom" => $idAutoInc];
echo json_encode($resultat);	// envoyer le tout au format JSON