<?php
require_once('./connexion.php');   // Connexion à la BDD
echo json_encode(["test" => "test"]);
$pizza = $_GET['pizzaASupprimer'];
print($pizza);
supprimerPizza($pdo,$pizza);

function supprimerPizza($pdo, $pizza)
{
    try {
        $supp = $pdo->exec("DELETE FROM PIZZA WHERE NomPizza='".$pizza."'");
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

