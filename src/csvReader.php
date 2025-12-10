<?php
$filename = "connections.csv";

$fp = fopen($filename, "r");

$listConnection = array();

while($resultA = fgetcsv($fp)){
    foreach ($resultA as $value) {
        echo $value;
        $listConnection[] = $value;
    }
    fclose($fp);
}
