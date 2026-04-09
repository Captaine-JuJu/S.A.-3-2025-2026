<?php
require_once("../authen.php");
authentification("ADMIN_WEB");
include("../fragments/headers.html");
include("../accesDenied.php");
?>
<body>
<header>
    <h1>Statistique</h1>
</header>

<?php
include("../fragments/menuweb.html");
include("../connexion.php");
?>

<div class="container">
    <div class="statistiques">
        <div class="StatistiqueUC">
            <h2> Statistiques</h2>
            <h3>Unité centrale</h3>
            <div class="connexions">
		<div class="stat">
                <label>
                    <?php

                    $totalsql = "SELECT COUNT(*) AS total FROM Devices;";
                    $resulttotal = mysqli_query($connect, $totalsql);

                    $total = mysqli_fetch_row($resulttotal)[0];
                    echo "Nombre d'unité centrale totale: ".$total;

                    $sql = "SELECT fabricant, COUNT(*) as nbr FROM Devices GROUP BY fabricant;";
                    $result = mysqli_query($connect, $sql);

                    echo "<table>";
                    echo "<thead>";
                    echo "<th>Fabricant</th>";
                    echo "<th>Nombre de machine</th>";
                    echo "<th>Pourcentage</th>";
                    echo "</thead>";
                    while ($row = mysqli_fetch_row($result)) {
                        echo "<tr>";
                        echo "<td>".$row[0]."</td>";
                        echo "<td>".$row[1]."</td>";
                        $pourcen =($row[1]/$total)*100;
                        echo "<td>".round($pourcen,2)."%"."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
		    ?>
		    </div>
		    <div class="stat">
		    <?php

                    $sql = "SELECT OS, COUNT(*) as nbr FROM Devices GROUP BY OS;";
                    $result = mysqli_query($connect, $sql);

                    echo "<table>";
                    echo "<thead>";
                    echo "<th>OS</th>";
                    echo "<th>Nombre de machine</th>";
                    echo "<th>Pourcentage</th>";
                    echo "</thead>";
                    while ($row = mysqli_fetch_row($result)) {
                        echo "<tr>";
                        echo "<td>".$row[0]."</td>";
                        echo "<td>".$row[1]."</td>";
                        $pourcen = ($row[1]/$total)*100;
                        echo "<td>".round($pourcen,2)."%"."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
		    ?>
		    </div>
		    <div class="stat">
		    <?php

                    $sql = "SELECT Localisation, COUNT(*) as nbr FROM Devices GROUP BY Localisation;";
                    $result = mysqli_query($connect, $sql);

                    echo "<table>";
                    echo "<thead>";
                    echo "<th>Localisation</th>";
                    echo "<th>Nombre de machine</th>";
                    echo "<th>Pourcentage</th>";
                    echo "</thead>";
                    while ($row = mysqli_fetch_row($result)) {
                        echo "<tr>";
                        echo "<td>". $row[0]."</td>";
                        echo "<td>".$row[1]."</td>";
                        $pourcen = ($row[1]/$total)*100;
                        echo "<td>".round($pourcen,2)."%"."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </label>
		</div>
            </div>
        </div>
        <div class="StatistiqueE">
            <label>
                <h3>Ecran</h3>
		<div class="stat">
                <?php
                $totalsql = "SELECT COUNT(*) AS total FROM Monitors;";
                $resulttotal = mysqli_query($connect, $totalsql);

                $total = mysqli_fetch_row($resulttotal)[0];
                echo "Nombre d'écran total: ".$total;

                $sql = "SELECT fabricant, COUNT(*) as nbr FROM Monitors GROUP BY fabricant;";
                $result = mysqli_query($connect, $sql);

                echo "<table>";
                echo "<thead>";
                echo "<th>Fabricant</th>";
                echo "<th>Nombre de machine</th>";
                echo "<th>Pourcentage</th>";
                echo "</thead>";
                while($row = mysqli_fetch_row($result)){
                    echo "<tr>";
                    echo "<td>".$row[0]."</td>";
                    echo "<td>".$row[1]."</td>";
                    $pourcen =($row[1]/$total)*100;
                    echo "<td>".round($pourcen,2)."%"."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </label>
	    </div>
        </div>
        <div class="StatistiqueC">
            <label>
                <h3>Connexion</h3>
		<div class="stat">
                <?php
                include_once("../outilsStat.php");
                $fp = fopen("../données/connections.csv", "r");

                $listConnection = array();
                $listUtilisateur = array();

                fgetcsv($fp);

                while(($resultA = fgetcsv($fp)) !== false) {

                    $listUtilisateur[] = $resultA[0];
                    $listConnection[] = $resultA[2];

                }
                for($i = 0; $i<count($listConnection);$i++){
                    $listeConnection[$i] = intval($listeConnection[$i]);
                }

                echo "Total d'heure de connexion:  ".round((array_sum($listConnection) / 3600),2);
                echo " h<br>";

                $temps = tempsConnectionParUtlistateur($listUtilisateur, $listConnection);
                $max = maxTemps($temps);
                $minute = $max[1]/60;
                echo "Top utilisateur : ".$max[0]." avec ".$minute. " minutes de connexion<br>";
                fclose($fp);

                $moy = moyenne($listConnection);
                echo "Moyenne de temps de connexion: ".$moy." secondes<br>";

                $mediane = mediane($listConnection);
                echo "Mediane de temps de connexion: ".$mediane." secondes<br>";

                ?>
            </label>
	    </div>
        </div>
    </div>
</div>
<?php
include("../fragments/footers.html");
?>
