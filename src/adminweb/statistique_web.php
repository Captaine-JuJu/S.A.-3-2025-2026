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
		<h2> Statistiques</h2>
		<div class="StatistiqueUC">    
    	    <h3>Unité centrale</h3>
		    <div class="connexions">
				<div class="stat">
				<?php
				
				// $sql = "SELECT fabricant, COUNT(*) as nbr FROM Monitors GROUP BY fabricant";
				// $result = mysqli_query($connect, $sql);
				
				// while ($row = mysqli_fetch_row($result)) {
				// echo "Fabricant : ". $row[0];
				//   echo " Nombre Machine : ".$row[1]."<br>";
				// }
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
				
				//$fp = fopen("données/inventory_devices.csv", "r");
				//date_default_timezone_set('Europe/Berlin');
				
				//$sous_garantie = 0;
				//$hors_garantie = 0;
				//$filiere = array();
				//$room = array();
				//$cpu = array();
				
				//fgetcsv($fp);
				
				//while(($resultA = fgetcsv($fp)) !== false) {
				
				//        $WARRANTY_END = date($resultA[16]);
				//        if ($WARRANTY_END<date_default_timezone_get()){
				//            $sous_garantie++;
				//        }
				//        else{$hors_garantie++;}
				
				// Domaine
				//$filiere[] = $resultA[9];
				
				//
				//$room[] = $resultA[13];
				
				//
				//$cpu[] = $resultA[6];
				//}
				
				//  $proba_de_tombe_sur_un_hors_garantie =cacul_pourcentage($hors_garantie,$hors_garantie+$sous_garantie,100);
				//  echo $proba_de_tombe_sur_un_hors_garantie."<br>";
				
				//$repartition_filiere = array_count_values($filiere);
				//$max_filiere = max($repartition_filiere);
				//echo $max_filiere."<br>";
				
				//$repartition_cpu = array_count_values($cpu);
				//$max_cpu = max($repartition_cpu);
				//echo $max_cpu."<br>";
				
				//$repartition_room = array_count_values($room);
				//$max_room = max($repartition_room);
				//echo $max_room."<br>";
				
				//fclose($fp);
				?>
				</div>
			</div>
		</div>
		<div class="StatistiqueE">
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
			
			//$fpIM = fopen("données/inventory_monitors2.csv", "r");
			
			//$Connectiques = array();
			//$MANUFACTURER = array();
			//$SIZE_INCH = array();
			//$RESOLUTION = array();
			
			//fgetcsv($fpIM);
			
			//while(($resultA = fgetcsv($fpIM)) !== false) {
			
			//$Connectiques[]=$resultA[6];
			//$MANUFACTURER[]=$resultA[2];
			//$SIZE_INCH[] =$resultA[4];
			//$RESOLUTION[] = $resultA[5];
			
			//}
			
			//$repartition_Connectiques = array_count_values($Connectiques);
			//$max_connectiques = max($repartition_Connectiques);
			//echo $max_connectiques."<br>";
			
			//$repartition_MANUFACTURER = array_count_values($MANUFACTURER);
			//$max_manufacturer = max($repartition_MANUFACTURER);
			//echo $max_manufacturer."<br>";
			
			//$repartition_SIZE_INCH = array_count_values($SIZE_INCH);
			//$max_size_inch = max($repartition_SIZE_INCH);
			//echo $max_size_inch."<br>";
			
			//$repartition_RESOLUTION = array_count_values($RESOLUTION);
			//$max_resolution = max($repartition_RESOLUTION);
			//echo $max_resolution."<br>";
			
			//fclose($fpIM);
			?>
			</div>
		</div>
		<div class="StatistiqueC">
			<h3>Connexion</h3>
			<div class="stat">
			<?php
			include_once("../outilsStat.php");
			$fp = fopen("données/connections.csv", "r");
			
			$listConnection = array();
			$listUtilisateur = array();
			
			fgetcsv($fp);
			
			while(($resultA = fgetcsv($fp)) !== false) {
			
				$listUtilisateur[] = $resultA[0];
				$listConnection[] = $resultA[2];
			}
			for($i = 0; $i<count($listConnection);$i++){
				$listeConnection[$i] = intval($listConnection[$i]);
			}
			
			echo "Total d'heure de connexion:  ".round((array_sum($listConnection) / 3600),2);
			echo " h<br>";
			echo "<br>";
			
			$temps = tempsConnectionParUtlistateur($listUtilisateur, $listConnection);
			$max = maxTemps($temps);
			$minute = $max[1]/60;
			echo "Top utilisateur : ".$max[0]." avec ".$minute. " minutes de connexion<br>";
			echo "<br>";
			fclose($fp);
			
			$moy = moyenne($listConnection);
			echo "Moyenne de temps de connexion: ".$moy." secondes<br>";
			echo "<br>";

			$mediane = mediane($listConnection);
			echo "Mediane de temps de connexion: ".$mediane." secondes<br>";
			echo "<br>";
			?>
			</div>
		</div>
	</div>
</div>
<?php
include("../fragments/footers.html");
?>
