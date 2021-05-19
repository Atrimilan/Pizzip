<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../Modele/TakeData.php';

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

$takeData = new TakeData();
$tabCom = $takeData->recupNumcom($pdo);
$tabNumCom = array();
foreach ($tabCom as $key => $value) {
    $tabCom [$key]["Commande"] = $takeData->RecupDetail($key, $pdo);
}
foreach ($tabCom as $key => $value) {
    foreach ($tabCom[$key]["Commande"] as $key1 => $value1) {
        $tabCom[$key]["Commande"][$key1] += $takeData->recupPizza($key1, $pdo);
    }
}
foreach ($tabCom as $key => $value) {
    array_push($tabNumCom, $key);
}
foreach ($tabNumCom as $value) {
    $takeData->changeEtat($value, $pdo);
}
echo json_encode($tabNumCom);
createFichier($tabCom);

function createFichier($tabCom) {
    foreach ($tabCom as $numCOm => $value) {
        $infoClientString = "";
        $infoPizza = "";
        $infoLivraison = "";
        foreach ($tabCom[$numCOm] as $key => $infoClient) {
            if ($key != "Commande") {
                $infoClientString .= " <b>$key</b> : $infoClient ";
            }
            if ($key == "type de livraison") {
                $infoLivraison = $infoClient;
            }
        }

        foreach ($tabCom[$numCOm]["Commande"] as $key2 => $value2) {
            foreach ($value2 as $key3 => $value3) {
                $infoPizza .= "<b>$key3</b> : $value3 ";
            }
            $infoPizza .= "<br>";
        }


        $txt = "<td>";
        $txt .= "    <h3>Numéro de commande : $numCOm</h3>";
        $txt .= $infoClientString;
        $txt .= "<br>";
        $txt .= $infoPizza;
        $txt .= "</td>";
        $txt .= "<td>";
        $txt .= "<div class='form-check'>";
        $txt .= "    <input class='btn-check' type='radio' value='accepter' name='$numCOm' id='flexRadioDefault1' checked>";
        $txt .= "    <label class='form-check-label' for='flexRadioDefault1'>";
        $txt .= "        accepter";
        $txt .= "    </label>";
        $txt .= "</div>";
        $txt .= "<div class='form-check'>";
        $txt .= "    <input class='btn-check' type='radio' value='enPrepa' name='$numCOm' id='flexRadioDefault2' >";
        $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
        $txt .= "        en cours de préparation";
        $txt .= "    </label>";
        $txt .= "</div>";
        $txt .= "<div class='form-check'>";
        $txt .= "    <input class='btn-check' type='radio' value='prete' name='$numCOm' id='flexRadioDefault2'>";
        $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
        $txt .= "        préte";
        $txt .= "    </label>";
        $txt .= "</div>";
        if ($infoLivraison == "O") {
            $txt .= "<div class='form-check'>";
            $txt .= "    <input class='btn-check' type='radio' value='$infoLivraison' name='$numCOm' id='flexRadioDefault2'>";
            $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
            $txt .= "         récupération du livreur ";
            $txt .= "    </label>";
            $txt .= "</div>";
            $txt .= "</td> ";
        } else {
            $txt .= "<div class='form-check'>";
            $txt .= "    <input class='btn-check' type='radio' value='$infoLivraison' name='$numCOm' id='flexRadioDefault2'>";
            $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
            $txt .= "         livree au client ";
            $txt .= "    </label>";
            $txt .= "</div>";
            $txt .= "</td> ";
        }
        $fichier = $numCOm . '.txt';
        $chemin = "../Modele/dossierOF/" . $fichier;
        $fichier = fopen($chemin, "w");
        fwrite($fichier, $txt);
        fclose($fichier);
    }
}
