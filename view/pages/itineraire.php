<?php  
    header('Access-Control-Allow-Origin: *');	// CORS policy 
    //      ----- CONNEXION A LA BASE DE DONNEES -----
    include("../../controller/connexion.php");
    //$connex = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);   


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Piz.zip - Itinéraire</title>
    <link href="../model/style/style.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-latest.js"> </script> <!-- Dernier Jquery -->



</head>

<body>
    <?php
        //         -----  HEADER -----
        //include("../pages/Header.php");
    ?>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2732.402957757791!2d4.8438628153934555!3d46.77666367913846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f2fce98c1cf919%3A0xd5cb77de520bae7f!2sNicephore%20Cit%C3%A9!5e0!3m2!1sfr!2sfr!4v1622049900742!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    
    <iframe src=""></iframe>

        <a href="http://maps.google.com/maps?saddr=34 Quai Saint-Cosme, 71100 Chalon-sur-Saône&daddr=chalon" id="test" target="_blank" title="iti">afficher</a>    

    <?php
        

        //         -----  FOOTER -----
        include("../pages/Footer.php");
    ?>

</body>

</html>