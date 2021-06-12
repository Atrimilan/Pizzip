<?php

require_once '../modele/TakeData.php';

$takeData = new TakeData();
$result = $takeData->recupIgredientArchiver($pdo);
 echo json_encode($result);

