<?php

$tabFinal = ["jules"=>7,"marton"=>["jules" =>8,"prenom"=>["jules"=>67]]];

for ($index = 0; $index < 10; $index++) {
    $tabFinal['marton']['ajout']= $index;
}
var_dump($tabFinal);