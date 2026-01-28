<?php
include_once("connexion.php");
$fp = fopen("données/inventory_devices.csv", "r");
echo "test";
fgetcsv($fp);
//$requeteUC = $connect->prepare("INSERT INTO Devices VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
//$prepUC->bind_param("sis", $nom, $nSerieUC,$fabriquant, $model, $type,$cpu,$ram,$stockage,$OS,$domaine,$localisation,$batiment,$pieces,$mac_addr,$date_achat,$date_garantis);

//while (($data = fgetcsv($fp) !== FALSE) {
//    $nom = $data[0];
//    $nSerieUC = $data[1];
//    $fabriquant = $data[2];
//    $model = $data[3];
//    $type = $data[4];
//    $cpu = $data[5];
//    $ram = $data[6];
//    $stockage = $data[7];
//    $OS = $data[8];
//    $domaine = $data[9];
//    $localisation = $data[10];
//    $batiment = $data[11];
//    $pieces = $data[12];
//    $mac_addr = $data[13];
//    $date_achat = $data[14];
//    $date_garantis = $data[15];
//
//    //$prepUC->execute();
//}
echo "réussi... ou pas";
//$prepUC->close();
fclose($fp);
