<?php
require_once './Connexion.php';

$etat=$_POST["etat"];
$numCom =$_POST["numCom"];
changeEtat($numCom,$etat, $pdo);


function changeEtat($numCom,$etat,$pdo){
    // traitee livree pretALivree nonTraitee 
    try {
        $requete = "UPDATE COMMANDE SET Etat ='".$etat."' WHERE NumCom = $numCom";
        $result = $pdo->exec($requete);
    } catch (PDOException $ex) {
        print $ex->getMessage();
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

