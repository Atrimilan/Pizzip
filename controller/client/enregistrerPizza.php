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
    $taillePizza = $data->taillePizza;

    for ($i = 0; $i < sizeof($pizza); $i++) {   // Parcourir les pizza = Controller Pizzas existantes + Quantité valide + Ingrédients existants
        $verifPizza = str_replace(',', '', $pizza[$i]->nomPizza);   // enlever la virgule finale
        $verifPizzaQuant = str_replace(',', '', $pizza[$i]->quantitePizza);
        $verifTaille = str_replace(',', '', $taillePizza);

        $resultVerifPizza = $pdo->query("SELECT * FROM PIZZA WHERE NomPizza='" . $verifPizza . "'");
        $ligneVerifPizza = $resultVerifPizza->fetch(PDO::FETCH_ASSOC);
        if (!$ligneVerifPizza || $verifPizzaQuant <= 0) {
            $success = false;    // Si la pizza n'est pas trouvée
        }
        if ($verifTaille != "L" && $verifTaille != "XL"){	// Taille forcement soit L, soit XL
            $success = false;
        }

        $listeVerifIng = array();   // Mettre tous les ingrédients dans un tableau
        array_push($listeVerifIng, str_replace(',', '', $pizza[$i]->ingBase1));
        array_push($listeVerifIng, str_replace(',', '', $pizza[$i]->ingBase2));
        array_push($listeVerifIng, str_replace(',', '', $pizza[$i]->ingBase3));
        array_push($listeVerifIng, str_replace(',', '', $pizza[$i]->ingBase4));
        array_push($listeVerifIng, str_replace(',', '', $pizza[$i]->ingOpt1));
        array_push($listeVerifIng, str_replace(',', '', $pizza[$i]->ingOpt2));
        array_push($listeVerifIng, str_replace(',', '', $pizza[$i]->ingOpt3));
        array_push($listeVerifIng, str_replace(',', '', $pizza[$i]->ingOpt4));

        for ($j = 0; $j < sizeof($listeVerifIng); $j++) {   // Parcourir le tableau d'ingrédients
            if ($listeVerifIng[$j] != "") { // Si l'ingrédient n'est pas null ...
                $resultVerifIng = $pdo->query("SELECT * FROM INGREDIENT WHERE NomIngred='" . $listeVerifIng[$j] . "'"); // ... On vérifie son
                $ligneVerifIng = $resultVerifIng->fetch(PDO::FETCH_ASSOC);                              // existence dans la BDD
                if (!$ligneVerifIng) {
                    $success = false;    // Si l'ingrédient n'est pas trouvé
                }
            }
        }

        if (
            str_replace(',', '', $pizza[$i]->ingBase1) == "" && str_replace(',', '', $pizza[$i]->ingBase2) == "" &&
            str_replace(',', '', $pizza[$i]->ingBase3) == "" && str_replace(',', '', $pizza[$i]->ingBase4) == ""
        ) {
            $success = false;    // Si les 4 ingrédients sont vides, ca ne peut pas marcher
        }
    }

    if ($success == true) {  // Si les pizzas et quantités sont valides
        $test = 1;
        for ($i = 0; $i < sizeof($pizza); $i++) {   // Pour chaque Pizza
            $nomPizzaActuelle = $pizza[$i]->nomPizza;   // Obtenir les informations du JSON
            $quantitePizzaActuelle = $pizza[$i]->quantitePizza; // ...
            $IngBase1 = $pizza[$i]->ingBase1;   // ...
            $IngBase2 = $pizza[$i]->ingBase2;   // ...
            $IngBase3 = $pizza[$i]->ingBase3;   // ...
            $IngBase4 = $pizza[$i]->ingBase4;   // ...
            $IngOpt1 = $pizza[$i]->ingOpt1; // ...
            $IngOpt2 = $pizza[$i]->ingOpt2; // ...
            $IngOpt3 = $pizza[$i]->ingOpt3; // ...
            $IngOpt4 = $pizza[$i]->ingOpt4; // ...

            $nomPizzaActuelle = str_replace(',', '', $nomPizzaActuelle);    // enlever la virgule finale
            $quantitePizzaActuelle = str_replace(',', '', $quantitePizzaActuelle);    // ...
            $IngBase1 = str_replace(',', '', $IngBase1);    // ...
            $IngBase2 = str_replace(',', '', $IngBase2);    // ...
            $IngBase3 = str_replace(',', '', $IngBase3);    // ...
            $IngBase4 = str_replace(',', '', $IngBase4);    // ...
            $IngOpt1 = str_replace(',', '', $IngOpt1);    // ...
            $IngOpt2 = str_replace(',', '', $IngOpt2);    // ...
            $IngOpt3 = str_replace(',', '', $IngOpt3);    // ...
            $IngOpt4 = str_replace(',', '', $IngOpt4);    // ...

            $infosPizza = $pdo->query("SELECT IdPizza FROM PIZZA WHERE NomPizza='" . $nomPizzaActuelle . "'");
            while ($element = $infosPizza->fetch(PDO::FETCH_ASSOC)) { // récupération par association de noms
                $IdPizza = $element['IdPizza'];
            }

            try {   // Insérer un DETAIL
                $insert = $pdo->exec("INSERT INTO DETAIL(NomPizza,IdPizza,Taille,IngBase1,IngBase2,IngBase3,IngBase4,IngOpt1,IngOpt2,IngOpt3,IngOpt4)
                VALUES ('" . $nomPizzaActuelle . "','" . $IdPizza . "','" . $taillePizza . "','" . $IngBase1 . "','" . $IngBase2 . "','" . $IngBase3 . "','" . $IngBase4 . "'
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
