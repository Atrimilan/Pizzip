<?php
header('Access-Control-Allow-Origin: *');    // CORS policy

require_once("./connexion.php");    // Connexion à la BDD

$success = true;
$test = 0;

$json = file_get_contents('php://input');   // Récupérer les données JSON de la requête AJAX

if (!empty($json)) {
    $data = json_decode($json); // Convertir le JSON en objet PHP
    $pizza = $data->pizza;  // Récupérer le tableau de Pizza
    $numCommande = $data->numCommande;
    //$taillePizza = $data->taillePizza;

    for ($i = 0; $i < sizeof($pizza); $i++) { // Parcourir une première fois toutes les pizzas pour s'assurer qu'elles existent
        $verifPizza = $pizza[$i]->nomPizza;
        $verifPizza = str_replace(',', '', $verifPizza);    // enlever la virgule finale
        $verifPizzaQuant = $pizza[$i]->quantitePizza;
        $verifPizzaQuant = str_replace(',', '', $verifPizzaQuant);    // enlever la virgule finale

        $resultVerifPizza = $pdo->query("SELECT * FROM PIZZA WHERE NomPizza='" . $verifPizza . "'");
        $ligneVerifPizza = $resultVerifPizza->fetch(PDO::FETCH_ASSOC);
        if (!$ligneVerifPizza || $verifPizzaQuant <= 0) {
            $success = false;    // Si la pizza n'est pas trouvée
        }
    }

    if ($success == true) {  // Si les pizzas et quantités sont valides
        $test = 1;
        for ($i = 0; $i < sizeof($pizza); $i++) {
            $nomPizzaActuelle = $pizza[$i]->nomPizza;
            $nomPizzaActuelle = str_replace(',', '', $nomPizzaActuelle);    // enlever la virgule finale
            $quantitePizzaActuelle = $pizza[$i]->quantitePizza;
            $quantitePizzaActuelle = str_replace(',', '', $quantitePizzaActuelle);    // enlever la virgule finale

            $infosPizza = $pdo->query("SELECT IdPizza,IngBase1,IngBase2,IngBase3,IngBase4,IngOpt1,IngOpt2,IngOpt3,IngOpt4 FROM PIZZA WHERE NomPizza='" . $nomPizzaActuelle . "'");
            while ($element = $infosPizza->fetch(PDO::FETCH_ASSOC)) { // récupération par association de noms
                $IdPizza = $element['IdPizza'];
                $IngBase1 = $element['IngBase1'];
                $IngBase2 = $element['IngBase2'];
                $IngBase3 = $element['IngBase3'];
                $IngBase4 = $element['IngBase4'];
                $IngOpt1 = $element['IngOpt1'];
                $IngOpt2 = $element['IngOpt2'];
                $IngOpt3 = $element['IngOpt3'];
                $IngOpt4 = $element['IngOpt4'];
            }

            try {   // Insérer un DETAIL
                $insert = $pdo->exec("INSERT INTO DETAIL(NomPizza,IdPizza,IngBase1,IngBase2,IngBase3,IngBase4,IngOpt1,IngOpt2,IngOpt3,IngOpt4)
                VALUES ('" . $nomPizzaActuelle . "','" . $IdPizza . "','" . $IngBase1 . "','" . $IngBase2 . "','" . $IngBase3 . "','" . $IngBase4 . "'
                ,'" . $IngOpt1 . "','" . $IngOpt2 . "','" . $IngOpt3 . "','" . $IngOpt4 . "')");    // Requete PDO
            } catch (PDOException $e) {
                print $e->getMessage();
            }
            $numDetail = $pdo->lastInsertId();  // Prendre le dernier Num_Detail (celui qu'on vient d'insérer)

            try {   // Insérer un COM_DETAIL
                $insert = $pdo->exec("INSERT INTO COM_DETAIL (Num_Detail, Quant, NumCom) VALUES ('" . $numDetail . "','" . $quantitePizzaActuelle . "','" . $numCommande . "')");    // Requete PDO
            } catch (PDOException $e) {
                print $e->getMessage();
            }

            $test = 3;
        }
    }
} else {
    $success = false;
}

$resultat = ["success" => $success, "test" => $test, "dernierNumDetail" => $numDetail, "numCommande" => $numCommande];
echo json_encode($resultat);	// envoyer le tout au format JSON



//$resultat = ["success" => $success, "data" => $data];
//echo json_encode($resultat);	// envoyer le tout au format JSON
