<?php

include_once("outilsStat.php");

$fpIM = fopen("./données/Inventory_monitors2.csv", "r");


$Connectiques = array();
$MANUFACTURER = array();
$SIZE_INCH = array();
$RESOLUTION = array();

fgetcsv($fpIM);

while(($resultA = fgetcsv($fpIM)) !== false) {

    $Connectiques=$resultA[6];
    $MANUFACTURER=$resultA[2];
    $SIZE_INCH =$resultA[4];
    $RESOLUTION = $resultA[5];

}

$repartition_Connectiques = array_count_values($Connectiques);
$max_connectiques = max($repartition_Connectiques);

$repartition_MANUFACTURER = array_count_values($MANUFACTURER);
$max_manufacturer = max($repartition_MANUFACTURER);

$repartition_SIZE_INCH = array_count_values($SIZE_INCH);
$max_size_inch = max($repartition_SIZE_INCH);

$repartition_RESOLUTION = array_count_values($RESOLUTION);
$max_resolution = max($repartition_RESOLUTION);

fclose($fpIM);