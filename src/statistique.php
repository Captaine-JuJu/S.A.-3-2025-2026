<?php
include("fragments/headers.html");
?>
<body>

<header>
    <h1>Statistique</h1>
</header>
<?php
include("fragments/menu.html");
include_once("STAT/outilsStat.php");
include_once("connexion.php");
?>

<div id="StatistiqueUser">
    <?php
        $fp = fopen("données/connections.csv", "r");

        $listConnection = array();
        $listUtilisateur = array();

        fgetcsv($fp);

        while(($resultA = fgetcsv($fp)) !== false) {

            $listUtilisateur[] = $resultA[0];
            $listConnection[] = $resultA[2];

        }
    ?>
</div>

<div id="StatistiqueUC">
    <h2>Unité centrale</h2>
    <?php

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
    ?>


</div>


<div id="StatistiqueE">
    <h2>Ecran</h2>
    <?php


    $sql = "SELECT fabricant, COUNT(*) as nbr FROM Monitors GROUP BY fabricant;";
    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "Fabricant : ". $row[0];
        echo " Nombre d'Ecrant : ".$row[1]."<br>";
    }

    $sql = "SELECT MODEL, COUNT(*) as nbr FROM Monitors GROUP BY MODEL;";

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "MODEL : ". $row[2];
        echo " Nombre d'Ecrant : ".$row[1]."<br>";
    }

    $sql = "SELECT Taille, COUNT(*) as nbr FROM Monitors GROUP BY Taille;";

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "Taille : ". $row[3];
        echo " Nombre d'Ecrant : ".$row[1]."<br>";
    }

    $sql = "SELECT RESOLUTION, COUNT(*) as nbr FROM Monitors GROUP BY RESOLUTION;";

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "RESOLUTION : ". $row[4];
        echo " Nombre d'Ecrant : ".$row[1]."<br>";
    }

    $sql = "SELECT CONNECTEUR, COUNT(*) as nbr FROM Monitors GROUP BY CONNECTEUR;";

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_row($result)) {
        echo "CONNECTEUR : ". $row[5];
        echo " Nombre d'Ecrant : ".$row[1]."<br>";
    }
    ?>
</div>


<div id="StatistiqueC">
    <h2>Connection</h2>
    <?php
        $fp = fopen("données/connections.csv", "r");

        $listConnection = array();
        $listUtilisateur = array();

        fgetcsv($fp);

        while(($resultA = fgetcsv($fp)) !== false) {

            $listUtilisateur[] = $resultA[0];
            $listConnection[] = $resultA[2];

        }

        $listConnection = convert_int($listConnection);
        $listTempsUser = tempsConnectionParUtlistateur($listUtilisateur, $listConnection);

        $topUser = topUtilisateur($listTempsUser);
        $maxTemps = maxTemps($listTempsUser);

        echo "Temps de connection moyen par utilisateur : " . moyenne($listConnection). "<br>";
        echo "Utilisateur le plus souvent connecté : ".$topUser." nombre de connexions <br>";
        echo "Utilisateur le plus longtemps connecté : ".$maxTemps[0]." avec ".($maxTemps[1]/60)." minutes de connexion <br>";


        fclose($fp);
    ?>
</div>

<?php
    include("fragments/footers.html");
?>
