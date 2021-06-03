<?php  
    header('Access-Control-Allow-Origin: *');	// CORS policy 
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    include("../../controller/connexion.php");  

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Piz.zip - Livraison</title>
    <link rel="stylesheet" href="../../model/style/style.css" media="screen">
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery -->

</head>

<body>
    <?php
        //         -----  HEADER -----
        //include("../pages/Header.php");
    ?>


    <!-- <p> Livreur : <?php echo $_SESSION['prenom']; ?> <br/><br/> </p> -->
    <h1>Commandes à Livrer :</h1> <br/><br/>

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


    <script src="../../model/scripts/chargerLivraison1.js"></script> 
    
    
    



</body>

</html>