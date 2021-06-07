<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TakeData
 *
 * @author julesKantzer
 */
 require_once '../Modele/Connexion.php'; 
class TakeData {
     
    
    function recupInfo($pdo) {

        try {
            $tabResult = array();
            $requete = "select * from INGREDIENT";
            $result = $pdo->query($requete);
            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                $tabResult[$ligne['IdIngred']] = ["NomIngred" => $ligne["NomIngred"],"frais" => $ligne["Frais"], "unité" => $ligne['Unite'], "StockMin" => $ligne["StockMin"], "StockReel" => $ligne["StockReel"], "PrixUHT" => $ligne["PrixUHT"], "Quantité à commander" => $ligne["Q_A_Com"]];
            }
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $tabResult;
        
    }
    function changeValeur($nomDeChamp,$donner, $valeur, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET $nomDeChamp = '$donner' WHERE IdIgred = $valeur ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
    function changeNomIngred($donner, $valeur, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET Etat = '$donner' WHERE IdIgred = $valeur ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
    function changefrais($donner, $valeur, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET Frais = '$donner' WHERE IdIgred = $valeur ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
    function changeUnite($donner, $valeur, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET Unite = '$donner' WHERE IdIgred = $valeur ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
    function changeStockMin($donner, $valeur, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET StockMin = '$donner' WHERE IdIgred = $valeur ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
    function changeStockReel($donner, $valeur, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET StockReel = '$donner' WHERE IdIgred = $valeur ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
    function changePrixUHT($donner, $valeur, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET PrixUHT = '$donner' WHERE IdIgred = $valeur ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
    function changeQuantiteACommander($donner, $valeur, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET Q_A_Com = '$donner' WHERE IdIgred = $valeur ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
    }
}
