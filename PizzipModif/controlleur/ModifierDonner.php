<?php

require_once '../modele/TakeData.php';

$result =[];

$id= $_POST["id"];
$estFrais = $_POST["estFrais"];
$unité = $_POST["unité"];
$stockMin = $_POST["stockMin"];
$stockReel = $_POST["stockReel"];
$PUHT = $_POST["PUHT"];
$qtàCommander = $_POST["qtàCommander"];
$takeData = new TakeData();

array_push($result,$takeData->changefrais($estFrais, $id, $pdo));
array_push($result,$takeData->changeUnite($unité, $id, $pdo));
array_push($result,$takeData->changeStockReel($stockReel, $id, $pdo));
array_push($result,$takeData->changeStockMin($stockMin, $id, $pdo));
array_push($result,$takeData->changeQuantiteACommander($qtàCommander, $id, $pdo));
array_push($result,$takeData->changePrixUHT($PUHT, $id, $pdo));
        
echo json_encode($result);