<?php

require_once './TakeData.php';

$takeData = new TakeData();
$result = $takeData->recupIgredientUtiliser($pdo);
 echo json_encode($result);


