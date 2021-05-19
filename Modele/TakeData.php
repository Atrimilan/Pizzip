<?php

require_once '../Modele/Connexion.php';

class TakeData {

    function changeEtat($etat, $numCom, $pdo) {
        try {
            $requete = "UPDATE COMMANDE SET Etat = '$etat' WHERE NumCom = $numCom ";
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
                $tabResult['Nom de la Pizza'] = $ligne['NomPizza'];
                if ($ligne['IngBase1'] != null) {
                    $tabResult['Ingredient 1'] = $ligne['IngBase1'];
                }
                if ($ligne['IngBase2'] != null) {
                    $tabResult['Ingredient 2'] = $ligne['IngBase2'];
                }
                if ($ligne['IngBase3'] != null) {
                    $tabResult['Ingredient 3'] = $ligne['IngBase3'];
                }
                if ($ligne['IngBase4'] != null) {
                    $tabResult['Ingredient 4'] = $ligne['IngBase4'];
                }
                if ($ligne['IngOpt1'] != null) {
                    $tabResult['Option 1'] = $ligne['IngOpt1'];
                }
                if ($ligne['IngOpt2'] != null) {
                    $tabResult['Option 2'] = $ligne['IngOpt2'];
                }
                if ($ligne['IngOpt3'] != null) {
                    $tabResult['Option 3'] = $ligne['IngOpt3'];
                }
                if ($ligne['IngOpt4'] != null) {
                    $tabResult['Option 4'] = $ligne['IngOpt4'];
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
                $tabResult[$ligne['NumCom']] = ["Nom" => $ligne["NomClient"], "N°" => $ligne['TelClient'], "Adresse" => $ligne["AdrClient"], "type de livraison" => $ligne["A_Livrer"], "Emballage" => $ligne["TypeEmbal"], "Prix" => $ligne["PrixCom"]];
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
                $tabResult[$ligne['Num_Detail']] = ['Quantite' => $ligne['Quant']];
            }
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $tabResult;
    }

}

?>