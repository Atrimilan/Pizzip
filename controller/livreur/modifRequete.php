<?php

    include("../../controller/connexion.php");  

    $etat=$_POST["etat"];
    $numCom =$_POST["numCom"];
        
       //            ----- REQUETE SQL -----    
       $requeteChangeEtatCommande = "UPDATE COMMANDE SET Etat = :etatLivraison WHERE NumCom = :numCommande;";
       $requetePre = $pdo -> prepare ($requeteChangeEtatCommande);

       // --- VALEUR A REMPLIR  ---
       $requetePre -> bindValue (":etatLivraison" , $etat , PDO::PARAM_STR);
       $requetePre -> bindValue (":numCommande" , $numCom , PDO::PARAM_STR);

       // --- EXECUTION REQUETE PREPARE  ---
       $requetePre ->execute();       

    echo "livraison n° $numCom = $etat";
