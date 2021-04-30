<?php
header('Access-Control-Allow-Origin: *');	// CORS policy

if (isset($_GET['fic'])) {
	$fic = $_GET['fic'];

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
	}

	echo json_encode($obj, JSON_FORCE_OBJECT);	// envoyer le tout au format JSON
}
