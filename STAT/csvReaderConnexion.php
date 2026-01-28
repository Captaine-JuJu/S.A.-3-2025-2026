<?php

include_once("outilsStat.php");

$fp = fopen("./données/connections.csv", "r");

$listConnection = array();
$listUtilisateur = array();

fgetcsv($fp);

while(($resultA = fgetcsv($fp)) !== false) {

    $listUtilisateur[] = $resultA[0];
    $listConnection[] = $resultA[2];

}

echo topTempsConnection($listUtilisateur, $listConnection);

fclose($fp);
?>