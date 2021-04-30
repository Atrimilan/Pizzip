<?php
    // Se connecter a la BDD
    //require("connexion.php");
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    //$connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);
    //            ----- REQUETE SQL -----    
    //$nomdelarequete = "";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste Livraison</title>
    <link href="../model/style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
        //         -----  HEADER -----
        include("../pages/Header.php");
    ?>


    <!-- <p> Livreur : <?php echo $_SESSION['prenom']; ?> <br/><br/> </p> -->
    <h1>Commandes à Livrer :</h1> <br/><br/>
    <input type="button" value="AFFICHER" onclick="actionAffiche()">



    <?php
    //         -----  FOOTER -----
    include("../pages/Footer.php");
    ?>    
</body>

</html>