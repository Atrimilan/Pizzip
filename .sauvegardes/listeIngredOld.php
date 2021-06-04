<?php
header('Access-Control-Allow-Origin: *');    // CORS policy

require_once("./connexion.php");    // Connexion à la BDD

$ingredients = array();

array_push($ingredients, "");

$result = $pdo->query("SELECT NomIngred FROM INGREDIENT");  // Récupérer tous les ingrédients
while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
    array_push($ingredients, $ligne['NomIngred']);
}

echo json_encode($ingredients); // Envoyer le tableau au JS
