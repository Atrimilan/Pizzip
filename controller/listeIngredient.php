<?php
require_once('./connexion.php');   // Connexion à la BDD

$ingredients = array();

$listeIngredients = array();
array_push($listeIngredients);

$resultIng = $pdo->query("SELECT NomIngred FROM INGREDIENT");  // Récupérer tous les ingrédients
while ($ligne = $resultIng->fetch(PDO::FETCH_ASSOC)) {
    array_push($listeIngredients, $ligne['NomIngred']); // Ajouter tous les ingrédients dans la liste
}
$ingredients['listeIngredients'] = $listeIngredients;

echo json_encode($ingredients); // Envoyer le tableau au JS