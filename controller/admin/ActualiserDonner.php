<?php

require_once './TakeData.php';

$id = $_POST["id"];
$takeData = new TakeData();
$result = $takeData->actualiserIngred($pdo, $id);
 echo json_encode($result);