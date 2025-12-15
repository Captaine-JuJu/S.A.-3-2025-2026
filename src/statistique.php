<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Sae</title>
    <script src="statistiques.js"></script>
</head> -->
<?php
include("../fragments/headers.html");
?>
<body>

<header>
    <h1>Statistique</h1>
</header>
<?php
include("../fragments/menu.html");
include_once("outilsStat.php");
include_once("../connexion.php");
?>


<div id="StatistiqueUC">
    <h2>Unité centrale</h2>
    <?php

    $sql = "SELECT fabricant, COUNT(*) as nbr FROM Monitors GROUP BY fabricant;";
    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "Fabricant : ". $row[0];
        echo " Nombre Machine : ".$row[1]."<br>";
    }

    $sql = "SELECT fabricant, COUNT(*) as nbr FROM Devices GROUP BY fabricant;";
    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "Fabricant : ". $row[0];
        echo " Nombre Machine : ".$row[1]."<br>";
    }

    $sql = "SELECT OS, COUNT(*) as nbr FROM Devices GROUP BY OS;";

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "OS : ". $row[0];
        echo " Nombre Machine : ".$row[1]."<br>";
    }

    $sql = "SELECT Localisation, COUNT(*) as nbr FROM Devices GROUP BY Localisation;";

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "Localisation : ". $row[0];
        echo " Nombre de machine : ".$row[1]."<br>";
    }

    $fp = fopen("données/inventory_devices.csv", "r");
    date_default_timezone_set('Europe/Berlin');

    $sous_garantie = 0;
    $hors_garantie = 0;
    $filiere = array();
    $room = array();
    $cpu = array();

    fgetcsv($fp);

    while(($resultA = fgetcsv($fp)) !== false) {

        // Domaine
        $filiere[] = $resultA[9];

        //
        $room[] = $resultA[13];

        //
        $cpu[] = $resultA[6];
    }

//  $proba_de_tombe_sur_un_hors_garantie =cacul_pourcentage($hors_garantie,$hors_garantie+$sous_garantie,100);
//  echo $proba_de_tombe_sur_un_hors_garantie."<br>";

    $repartition_filiere = array_count_values($filiere);
    $max_filiere = max($repartition_filiere);
    echo $max_filiere."<br>";

    $repartition_cpu = array_count_values($cpu);
    $max_cpu = max($repartition_cpu);
    echo $max_cpu."<br>";

    $repartition_room = array_count_values($room);
    $max_room = max($repartition_room);
    echo $max_room."<br>";

    fclose($fp);
    ?>
</div>


<div id="StatistiqueE">
    <h2>Ecran</h2>
    <?php

    $fpIM = fopen("données/inventory_monitors2.csv", "r");


    $Connectiques = array();
    $MANUFACTURER = array();
    $SIZE_INCH = array();
    $RESOLUTION = array();

    fgetcsv($fpIM);

    while(($resultA = fgetcsv($fpIM)) !== false) {

        $Connectiques[]=$resultA[6];
        $MANUFACTURER[]=$resultA[2];
        $SIZE_INCH[] =$resultA[4];
        $RESOLUTION[] = $resultA[5];

    }

    $repartition_Connectiques = array_count_values($Connectiques);
    $max_connectiques = max($repartition_Connectiques);
    echo $max_connectiques."<br>";

    $repartition_MANUFACTURER = array_count_values($MANUFACTURER);
    $max_manufacturer = max($repartition_MANUFACTURER);
    echo $max_manufacturer."<br>";

    $repartition_SIZE_INCH = array_count_values($SIZE_INCH);
    $max_size_inch = max($repartition_SIZE_INCH);
    echo $max_size_inch."<br>";

    $repartition_RESOLUTION = array_count_values($RESOLUTION);
    $max_resolution = max($repartition_RESOLUTION);
    echo $max_resolution."<br>";

    fclose($fpIM);
    ?>
</div>


<div id="StatistiqueC">
    <h2>Connection</h2>
    <?php
    include_once("outilsStat.php");
    $fp = fopen("../données/connections.csv", "r");

    $listConnection = array();
    $listUtilisateur = array();

    fgetcsv($fp);

    while(($resultA = fgetcsv($fp)) !== false) {

        $listUtilisateur[] = $resultA[0];
        $listConnection[] = $resultA[2];

    }
    $listConnection = convert_int($listConnection);

    echo array_sum($listConnection) / 3600;
    echo " h";

    $a = tempsConnectionParUtlistateur($listUtilisateur, $listConnection);


    fclose($fp);
    ?>
</div>

<?php
include("../fragments/footers.html");
?>
