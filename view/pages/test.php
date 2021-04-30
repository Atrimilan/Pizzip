<?php
$host = "remotemysql.com";
$user = "eEPfirnc1C";
$pwd = "vZFMsKIeXw";
$bdd = "eEPfirnc1C";

try {
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $bdd, $user, $pwd);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die();
}

try {

    $result = $pdo->query("SELECT * FROM PIZZA");    // SQL par PDO
    
    while ($tabPizza = $result->fetch(PDO::FETCH_ASSOC)) {
        echo $tabPizza['NomPizza'];
        echo "<br>";
    }
} catch (PDOException $e) {
    print $e->getMessage();
}
