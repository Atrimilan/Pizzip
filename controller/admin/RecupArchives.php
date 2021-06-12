<?php

require_once './TakeData.php';

$takeData = new TakeData();
$result = $takeData->recupIgredientArchiver($pdo);
 echo json_encode($result);

