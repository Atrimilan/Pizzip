<?php
    // Se connecter a la BDD
    require_once("../../controller/connexion.php");
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    $connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);

    if ( isset ($_POST['BoutonChangeEtat']) ) {  // se déclenche au clic

        $ID_Commande = filter_input(INPUT_GET, 'ID_Commande', FILTER_SANITIZE_STRING);  // récupere l'ID de la commande cliqué

        //$ID_Commande = $commandeSelectionne;

        //            ----- REQUETE SQL -----    
        $requeteChangeEtatCommande = "UPDATE COMMANDE SET Etat = :etatLivraison WHERE NumCom = :numCommande;";
        $requetePre = $connex -> prepare ($requeteChangeEtatCommande);

        // --- VALEUR A REMPLIR  ---
        $requetePre -> bindValue (":etatLivraison" , "enLivraison" , PDO::PARAM_STR);
        $requetePre -> bindValue (":numCommande" , $ID_Commande , PDO::PARAM_STR);

        // --- EXECUTION REQUETE PREPARE  ---
        $requetePre ->execute();

        // --- MESSAGE ---
        echo"La commande n°$ID_Commande vient de passer En livraison";
        echo"<div style=color:green><p> MODIFICATIONS ENREGISTREES <br> </p></div>";
        header('../../view/pages/ihm_livreur.php');
    }
?>
