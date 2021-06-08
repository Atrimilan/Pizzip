<?php
header('Access-Control-Allow-Origin: *');    // CORS policy
    $a=$_GET['var1'];
    $b=$_GET['var2'];
    $var3= $a+$b;
    $resultat = ["valeur1" => $a, "valeur2" => $b, "valeur3" => $var3];
    echo json_encode($resultat);    // envoyer le tout au format JSON
?>