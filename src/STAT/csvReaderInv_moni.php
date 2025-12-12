<?php

include_once("outilsStat.php");

$fp = fopen("./données/Inventory_monitors2.csv", "r");


$Connectiques = array();
$MANUFACTURER = array();
$SIZE_INCH = array();
$RESOLUTION = array();

fgetcsv($fp);

while(($resultA = fgetcsv($fp)) !== false) {

    $Connectiques=$resultA[6];
    $MANUFACTURER=$resultA[2];
    $SIZE_INCH =$resultA[4];
    $RESOLUTION = $resultA[5];

}



fclose($fp);