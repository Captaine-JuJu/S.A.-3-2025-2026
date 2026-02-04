<?php
require_once("../authen.php");
authentification("ADMIN_SYS");
include_once("../fragments/headers.html");
include("../accesDenied.php");
?>
<header>
	<h1>Administrateur Système</h1>
</header>
<?php
include_once("../fragments/menuSys.html");

$fp = fopen("../données/connections.csv", "r");

fgetcsv($fp);
echo "<div class='log'>";
	echo "<table>";
	echo "<thead>";
	echo "<th>Login</th>";
	echo "<th>IP</th>";
	echo "<th>Date</th>";
	echo "</thead>";
	while(($resultA = fgetcsv($fp)) !== false){

		echo "<tr>";
		echo "<td>".$resultA[0]."</td>";
		echo "<td>".$resultA[1]."</td>";
		echo "<td>".$resultA[2]."</td>";
		echo "</tr>";
	}
	echo "</table>";
echo "</div>";
fclose($fp);
include_once("../fragments/footers.html");
