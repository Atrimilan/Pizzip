<?php
//Author MUTH Kévin
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
?>
