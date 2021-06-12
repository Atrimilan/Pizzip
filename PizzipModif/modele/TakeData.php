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

    function recupIgredientUtiliser($pdo) {
        try {
            $tabResult = array();
            $requete = "select * from INGREDIENT where DateArchiv='utiliser'";
            $result = $pdo->query($requete);
            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                $tabResult[$ligne['IdIngred']] = ["NomIngred" => $ligne["NomIngred"], "frais" => $ligne["Frais"], "unité" => $ligne['Unite'], "StockMin" => $ligne["StockMin"], "StockReel" => $ligne["StockReel"], "PrixUHT" => $ligne["PrixUHT"], "Quantité à commander" => $ligne["Q_A_Com"]];
            }
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $tabResult;
    }
    function recupIgredientArchiver($pdo) {
        try {
            $tabResult = array();
            $requete = "select * from INGREDIENT where DateArchiv='archiver'";
            $result = $pdo->query($requete);
            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                $tabResult[$ligne['IdIngred']] = ["NomIngred" => $ligne["NomIngred"], "frais" => $ligne["Frais"], "unité" => $ligne['Unite'], "StockMin" => $ligne["StockMin"], "StockReel" => $ligne["StockReel"], "PrixUHT" => $ligne["PrixUHT"], "Quantité à commander" => $ligne["Q_A_Com"]];
            }
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $tabResult;
    }
     function actualiserIngred($pdo,$id) {
        try {
            $requete = "UPDATE INGREDIENT SET DateArchiv = 'utiliser' where IdIngred = ".$id;
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $result;
    }
    
    function archiverIngred($pdo,$id) {
        try {
            $requete = "UPDATE INGREDIENT SET DateArchiv = 'archiver' where IdIngred = ".$id;
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $result;
    }
    function changefrais($donner, $id, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET Frais = '$donner' WHERE IdIngred = $id ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $result;
    }

    function changeUnite($donner, $id, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET Unite = '$donner' WHERE IdIngred = $id ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $result;
    }

    function changeStockMin($donner, $id, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET StockMin = '$donner' WHERE IdIngred = $id ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $result;
    }

    function changeStockReel($donner, $id, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET StockReel = '$donner' WHERE IdIngred = $id ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $result;
    }

    function changePrixUHT($donner, $id, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET PrixUHT = '$donner' WHERE IdIngred = $id ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $result;
    }

    function changeQuantiteACommander($donner, $id, $pdo) {
        try {
            $requete = "UPDATE INGREDIENT SET Q_A_Com = '$donner' WHERE IdIngred = $id ";
            $result = $pdo->exec($requete);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $result;
    }

}
