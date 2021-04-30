<?php
//CONNEXION A LA BASE DE DONNEE
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_GET['fic'])){
	$fic=$_GET['fic'];
	require_once 'connexion.php'; // ../../controller/connexion.php
        if (!empty($_GET)) {
            // CONNEXION PDO
            try {
                $connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage() . '<br />';
                echo 'N° : ' . $e->getCode();
                die();
            }
            try {
                //REQUETE : JOINTURE ENTRE LA TABLE FOURS ET DATA
            	/*$requete= $connex->query("SELECT data.date, data.heure, data.temperature, fours.four_marque "
                        . "FROM data, fours WHERE data.four_id=".$fic." AND fours.four_id=".$fic);      */  
                $requete= $connex->query("select* from INGREDIENT".$fic);       
            } catch (PDOException $e) {
                print $e->getMessage();
            }
}
?>


<html>
    <head>
        <title>Pizzip - GESTIONNAIRE DES STOCKS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="MUTH Kevin">        
    </head>
    
    <body>
        <div>
            <h1><b>Pizzip - GESTIONNAIRE DES STOCKS</b></h1>
        </div>
        
        <div>
            
        </div>
    </body>
</html>