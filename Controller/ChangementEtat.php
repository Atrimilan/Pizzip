<?php
require_once '../Modele/TakeData.php';

$etat=$_POST["etat"];
$numCom =$_POST["numCom"];
$takeData = new TakeData();
$takeData->changeEtat($etat,$numCom, $pdo);
changeEtat($numCom,$etat, $pdo);



