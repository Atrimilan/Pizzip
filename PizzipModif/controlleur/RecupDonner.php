<?php

require_once '../modele/TakeData.php';

$takeData = new TakeData();
$result = $takeData->recupInfo($pdo);
 echo json_encode($result);


