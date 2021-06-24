<?php
require_once('./connexion.php');
$verif = "";
$pizza = trim($_POST['piz']); //Convertie la chaine en minuscule et enlève les espaces en début et en fin
$ingred = trim($_POST['ingr']);
$prix = $_POST['prix'];
$autorisation = pizzaExistePas($pdo, $pizza); //Sauvegarde les données récupéré dans un tableau

// ------------ VERIFICATION QUE LA PIZZA N'EXISTE PAS  -------------//
if ($autorisation == true){
    ajouterPizza($pdo, $pizza, $prix, $ingred);
    $verif = "ajoute";
} else {
    $verif = "present"; // Si non, ne rien faire
}
echo json_encode($verif); // return verif



//---------------------------------------------//
//------- FONCTION PIZZA EXISTE PAS ----------//
//-------------------------------------------//
function pizzaExistePas($pdo, $pizza)
{
    try {
        $req = "SELECT * FROM PIZZA WHERE NomPizza='" . $pizza . "'";
        $result = $pdo->query($req);
        $ligne = $result->fetch(PDO::FETCH_ASSOC);
        if(!$ligne){
            return true;    // droit d'ajouter
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        print $ex->getMessage();
    }
    return false;
}


// ------------------------------------------------- //
// -------------- FONCTION AJOUTER ----------------- //
// -------- REQUETE SQL AJOUT TABLE PIZZA -----------//
// ------------------------------------------------- //
function ajouterPizza($pdo, $pizza, $prix, $ingred)
{
    try {
        $insert = $pdo->exec("INSERT INTO PIZZA (NomPizza, PrixUHT, IngBase1) VALUES ('" . $pizza . "','" . $prix . "','" . $ingred . "')");
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}