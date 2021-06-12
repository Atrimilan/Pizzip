<?php

require_once '../modele/TakeData.php';

$id = $_POST["id"];
$takeData = new TakeData();
$result = $takeData->archiverIngred($pdo, $id);
 echo json_encode($result);
