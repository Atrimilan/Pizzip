<?php
header('Access-Control-Allow-Origin: *');    // CORS policy
require_once("./connexion.php");    // Connexion à la BDD

$ingredients = array();

$listeIngredients = array();
array_push($listeIngredients, "");  // Mettre une première ligne vide (car la valeur peut être null)

$resultIng = $pdo->query("SELECT NomIngred FROM INGREDIENT");  // Récupérer tous les ingrédients
while ($ligne = $resultIng->fetch(PDO::FETCH_ASSOC)) {
    array_push($listeIngredients, $ligne['NomIngred']); // Ajouter tous les ingrédients dans la liste
}
$ingredients['listeIngredients'] = $listeIngredients;


$listePizza = array();

$resultPizza = $pdo->query("SELECT NomPizza,IngBase1,IngBase2,IngBase3,IngBase4,IngOpt1,IngOpt2,IngOpt3,IngOpt4 FROM PIZZA");
while ($ligne = $resultPizza->fetch(PDO::FETCH_ASSOC)) {

    $nomPizza = $ligne['NomPizza'];
    $IngBase1 = verifierNull($ligne['IngBase1']);   // si "null" remplacer par ""
    $IngBase2 = verifierNull($ligne['IngBase2']);   // ...
    $IngBase3 = verifierNull($ligne['IngBase3']);   // ...
    $IngBase4 = verifierNull($ligne['IngBase4']);
    $IngOpt1 = verifierNull($ligne['IngOpt1']);
    $IngOpt2 = verifierNull($ligne['IngOpt2']);
    $IngOpt3 = verifierNull($ligne['IngOpt3']);
    $IngOpt4 = verifierNull($ligne['IngOpt4']);

    $listePizza[$nomPizza] = ['IngBase1' => $IngBase1, 'IngBase2' => $IngBase2, 'IngBase3' => $IngBase3, 'IngBase4' => $IngBase4, 'IngOpt1' => $IngOpt1, 'IngOpt2' => $IngOpt2,
    'IngOpt3' => $IngOpt3, 'IngOpt4' => $IngOpt4];  // Mettre les ingrédients dans le JSON, dans l'objet portant le nom de la pizza
}
$ingredients['listePizza'] = $listePizza;   // Mettre la liste de pizza dans un objet du JSON du même nom

echo json_encode($ingredients); // Envoyer le tableau au JS



function verifierNull($val) // ne pas renvoyer "null" mais "" si la valeur est null
{
    if ($val == null) {
        return "";
    } else {
        return $val;
    }
}
