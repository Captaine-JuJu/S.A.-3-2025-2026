<?php
function cacul_pourcentage($nombre,$total,$pourcentage)
{
    $resultat = ($nombre/$total) * $pourcentage;
    return round($resultat); // Arrondi la valeur
}

include_once("outilsStat.php");

$fp = fopen("./données/Inventory_devices.csv", "r");

date_default_timezone_set('Europe/Berlin');

$sous_garantie = 0;
$hors_garantie = 0;

$filiere = array();

$room = array();

$cpu = array();


fgetcsv($fp);

while(($resultA = fgetcsv($fp)) !== false) {

    $WARRANTY_END = date($resultA[16]);
    if ($WARRANTY_END<date_default_timezone_get()){
        $sous_garantie++;
    }
    else{$hors_garantie++;}

    $filiere = $resultA[9];

    $room = $resultA[13];

    $cpu = $resultA[6];
}

$proba_de_tombe_sur_un_hors_garantie =calcul_pourcentage($hors_garantie,$hors_garantie+$sous_garantie,100);

$repartition_filiere = array_count_values($filiere);
$max_filiere = max($repartition_filiere);

$repartition_cpu = array_count_values($cpu);
$max_cpu = max($repartition_cpu);

$repartition_room = array_count_values($room);
$max_room = max($repartition_room);

fclose($fp);
?>