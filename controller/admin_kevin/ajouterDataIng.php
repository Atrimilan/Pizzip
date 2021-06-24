<?php
require_once('../connexion.php');
$verif ="";
$variable = trim(strtolower($_POST['ing'])); //Convertie la chaine en minuscule et enlève les espaces en début et en fin
$tab = saveIng($pdo,$variable); //Sauvegarde les données récupéré dans un tableau
if (lectureTab($tab,$variable)){
    ajouterIng($pdo,$variable); //Si l'ingrédient n'est pas dans le tableau : alors AJOUTER
    $verif = "ajoute";
}
else {
    $verif = "present"; // Si non, ne rien faire
}
echo json_encode($verif); // return verif

// -------------- AFFICHER INGREDIENT -----------------
function saveIng($pdo, $variable){
    try {
        $tabResult = array();
        $req = "SELECT NomIngred FROM INGREDIENT";
        $result = $pdo->query($req);
        $id = 0;
        while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                        $tabResult['Nom Ingredient'.$id] = $ligne['NomIngred'];
            $id++;
        }
    } catch (PDOException $ex) {
        print $ex->getMessage();
    }
    return $tabResult;
}

// ---------------- LECTURE DE TABLEAU ----------------------
function lectureTab($tab, $chaine){
    $verif = true;
    foreach($tab as $value ){
        
        if ($value == $chaine){
            $verif = false;
        }    
    }
    return $verif;
}
// --------- REQUETE SQL AJOUT TABLE INGREDIENT ------------
function ajouterIng($pdo,$variable){
    try{
        $req = "INSERT INTO INGREDIENT (NomIngred)
                 VALUES ('".$variable."')";
        $requete=$pdo->exec($req);
    }catch(PDOException $e){
        print $e->getMessage();
    }
}