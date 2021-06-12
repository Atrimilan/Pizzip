<?php
require_once './TakeData.php';

$etat=$_POST["etat"];
$numCom =$_POST["numCom"];
$takeData = new TakeData();
$takeData->changeEtat($etat, $numCom, $pdo);



