<?php  
    header('Access-Control-Allow-Origin: *');	// CORS policy 
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    include("../../controller/connexion.php");
    //$connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);   

    //            ----- REQUETE SQL -----  
    include("../../controller/action_chargerCommandeLivraison.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Piz.zip - Livraison</title>
    <link href="../model/style/style.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery -->


    <style type="text/css">
        .tftable {font-size:12px;color:#333333;width:90%;border-width: 5px;border-color: #729ea5;border-collapse: collapse;}
        .tftable th {font-size:16px;background-color:#f1c50e;border-width: 3px;padding: 8px;border-style: solid;border-color: black;text-align:center;}
        .tftable tr {background-color:#ffffd3;}
        .tftable td {font-size:16px;border-width: 3px;padding: 8px;border-style: solid;border-color: black;text-align:left;}
        .tftable tr:hover {background-color:#ffffff;}
    </style>

</head>

<body>
    <?php
        //         -----  HEADER -----
        //include("../pages/Header.php");
    ?>


    <!-- <p> Livreur : <?php echo $_SESSION['prenom']; ?> <br/><br/> </p> -->
    <h1>Commandes à Livrer :</h1> <br/><br/>

    <div id="informations"></div>
    <p id="espace_nombre"> </p>

<center>
    
    <br><br>

    <!--                    -------- TABLEAU COMMANDES ---------->                
    <table id="tabe" class="tftable" border="1">
        <tr><th>COMMANDE</th><th>INFORMATIONS</th><th>ACTIONS</th></tr>           
    </table> <br>
    <!--                    -------- TABLEAU COMMANDES ---------->
    
    

</center>


    <?php
        

        //         -----  FOOTER -----
        include("../pages/Footer.php");
    ?>


    <script src="../../model/scripts/chargerLivraison2.js"></script> 
    <!-- <script src="../../model/scripts/livraison.js"></script> -->
    



</body>

</html>