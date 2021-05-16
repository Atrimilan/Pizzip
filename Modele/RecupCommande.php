<?php

require_once './Connexion.php';
ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

$tabCom = recupNumcom($pdo);
$tabNumCom = array();
foreach ($tabCom as $key => $value) {
    $tabCom [$key]["Commande"] = RecupDetail($key, $pdo);
}
foreach ($tabCom as $key => $value) {
foreach ($tabCom[$key]["Commande"] as $key1 => $value1) {
        $tabCom[$key]["Commande"][$key1] += recupPizza($key1, $pdo);
    }
}
foreach ($tabCom as $key => $value) {
    array_push($tabNumCom, $key);
}
foreach ($tabNumCom as $value) {
    //changeEtat($value, $pdo);
}
var_dump($tabCom);
//echo json_encode($tabNumCom);
createFichier($tabCom);

function createFichier($tabCom) {
    
    foreach ($tabCom as $key => $value) {
        
        $txt = "<td>";
        $txt .= "    <p>numéro de commande : $key</p>";
        $txt .="<p>";
        $txt .= "</td>";
        $txt .= "<td>";
        $txt .= "<div class='form-check'>";
        $txt .= "    <input class='form-check-input' type='radio' value='accepter' name='$key' id='flexRadioDefault1' checked>";
        $txt .= "    <label class='form-check-label' for='flexRadioDefault1'>";
        $txt .= "        accepter";
        $txt .= "    </label>";
        $txt .= "</div>";
        $txt .= "<div class='form-check'>";
        $txt .= "    <input class='form-check-input' type='radio' value='enPrepa' name='$key' id='flexRadioDefault2' >";
        $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
        $txt .= "        en cours de préparation";
        $txt .= "    </label>";
        $txt .= "</div>";
        $txt .= "<div class='form-check'>";
        $txt .= "    <input class='form-check-input' type='radio' value='prete' name='$key' id='flexRadioDefault2'>";
        $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
        $txt .= "        préte";
        $txt .= "    </label>";
        $txt .= "</div>";
        $txt .= "<div class='form-check'>";
        $txt .= "    <input class='form-check-input' type='radio' value='livree' name='$key' id='flexRadioDefault2'>";
        $txt .= "    <label class='form-check-label' for='flexRadioDefault2'>";
        $txt .= "         livree";
        $txt .= "    </label>";
        $txt .= "</div>";
        $txt .= "</td> ";
        $fichier = $key . '.txt';
        $chemin = "dossierOF/" . $fichier;
        $fichier = fopen($chemin, "w");
        fwrite($fichier, $txt);
        fclose($fichier);
    }
}
function changeEtat($numCom,$pdo){
    // traitee livree pretALivree nonTraitee 
    try {
        $requete = "UPDATE COMMANDE SET Etat = 'acceptee' WHERE NumCom = $numCom ";
        $result = $pdo->exec($requete);
    } catch (PDOException $ex) {
        print $ex->getMessage();
    }
}
function recupPizza($numDetail, $pdo) {

    try {
        $tabResult = array();
        $requete = "select NomPizza,IngBase1,IngBase2,IngBase3,IngBase4,IngOpt1,IngOpt2,IngOpt3,IngOpt4 from DETAIL where Num_Detail = $numDetail";
        $result = $pdo->query($requete);
        while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
            $tabResult['nomPizza'] = $ligne['NomPizza'];
            
//            if($ligne['IngBase1']!=null){
//            $tabResult['nomPizza'] = $ligne['IngBase1'];
//            }
            if($ligne['IngBase1']!=null){
                $tabResult['IngBase1'] = $ligne['IngBase1'];
            }
            if($ligne['IngBase2']!=null){
                $tabResult['IngBase2'] = $ligne['IngBase2'];
            }
            if($ligne['IngBase3']!=null){
                $tabResult['IngBase3'] = $ligne['IngBase3'];
            }
            if($ligne['IngBase4']!=null){
                $tabResult['IngBase4'] = $ligne['IngBase4'];
            }
            if($ligne['IngOpt1']!=null){
                $tabResult['IngOpt1'] = $ligne['IngOpt1'];
            }
            if($ligne['IngOpt2']!=null){
                $tabResult['IngOpt2'] = $ligne['IngOpt2'];
            }
            if($ligne['IngOpt3']!=null){
                $tabResult['IngOpt3'] = $ligne['IngOpt3'];
            }
            if($ligne['IngOpt4']!=null){
                $tabResult['IngOpt4'] = $ligne['IngOpt4'];
            }
        }
    } catch (PDOException $ex) {
        print $ex->getMessage();
    }
    return $tabResult;
}

function recupNumcom($pdo) {

    try {
        $tabResult = array();
        $requete = "select NomClient,NumCom,TelClient,AdrClient,TypeEmbal,A_Livrer,PrixCom from COMMANDE where Etat = 'nonTraitee'";
        $result = $pdo->query($requete);
        while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
        $tabResult[$ligne['NumCom']] =["Nom"=>$ligne["NomClient"],"NumTel"=>$ligne['TelClient'],"adresse"=>$ligne["AdrClient"],"A_Livrer"=>$ligne["A_Livrer"],"emballage"=>$ligne["TypeEmbal"],"prix"=>$ligne["PrixCom"]];
        }
    } catch (PDOException $ex) {
        print $ex->getMessage();
    }

    return $tabResult;
}
function RecupDetail($numCom, $pdo) {

    try {
        $tabResult = array();
        $requete = "select Num_Detail,Quant from COM_DETAIL where NumCom = $numCom";
        $result = $pdo->query($requete);
        while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
            $tabResult[$ligne['Num_Detail']] = ['quantite'=>$ligne['Quant']];
           
        }
    } catch (PDOException $ex) {
        print $ex->getMessage();
    }
    return $tabResult;
}

?>