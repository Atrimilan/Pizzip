<?php

require_once '../modele/TakeData.php';

$takeData = new TakeData();
$result = $takeData->recupIgredientUtiliser($pdo);
 echo json_encode($result);


