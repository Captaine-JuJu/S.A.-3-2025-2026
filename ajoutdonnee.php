<?php
$query = "LOAD DATA INFILE 'données/inventory_devices.csv' INTO TABLE Devices Fields BY ',' ENCLOSED BY '""' LINES TERMINATED BY '\n' IGNORE 1 ROW;"
$connect = mysqli_connect("localhost", "root","azerty","users");
$bd = mysqli_select_db($connect, "users");
$fp = fopen("données/inventory_devices.csv", "r");
fgetcsv($fp);
$requeteUC = $connect->prepare("INSERT INTO Devices(Nom,Num_serie) VALUES (?,?);");
$prepUC->bind_param("sis", $nom, $nSerieUC);

while (($data = fgetcsv($fp) !== FALSE) {
    $nom = $data[0];
    $nSerieUC = $data[1];
    
    $prepUC->execute();
}
echo "réussi... ou pas";
$prepUC->close();
fclose($fp);
