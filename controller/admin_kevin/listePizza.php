<?php
require_once('../connexion.php');   // Connexion à la BDD

$pizza = array();

$listePizza = array();
array_push($listePizza);

$resultIng = $pdo->query("SELECT NomPizza FROM PIZZA");  // Récupérer tous les ingrédients
while ($ligne = $resultIng->fetch(PDO::FETCH_ASSOC)) {
    array_push($listePizza, $ligne['NomPizza']); // Ajouter tous les ingrédients dans la liste
}
$pizza['listePizza'] = $listePizza;

echo json_encode($pizza); // Envoyer le tableau au JS