<?php

include_once("outilsStat.php");

$fp = fopen("données/connections.csv", "r");

$listConnection = array();
$listUtilisateur = array();

fgetcsv($fp);

while(($resultA = fgetcsv($fp)) !== false) {

    $listUtilisateur[] = $resultA[0];
    $listConnection[] = $resultA[2];

}

$listConnection = convert_int($listConnection);

//foreach ($listUtilisateur as $utilisateur) {
//    echo $utilisateur . "<br>";
//}
//echo topUtilisateur($listUtilisateur);


echo array_sum($listConnection) / 3600;
echo " H";

$a = tempsConnectionParUtlistateur($listUtilisateur, $listConnection);





fclose($fp);