<?php
    // Se connecter a la BDD
    require("connexion.php");
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    $connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);

    //            ----- REQUETE SQL -----    
    $requeteTouteCommande = "SELECT * FROM COMMANDE ";
    $requeteLivraisonCommande = "";


?>