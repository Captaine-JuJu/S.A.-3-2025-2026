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
?>

    <div class="container">
        <div class="inventaires">

            <h1>Journal d'activité 1</h1>
            <?php
            $contenu = file_get_contents('../données/logReussi.json');
            $listeA = json_decode($contenu, true);

            if (is_array($listeA)) {
                $liste = array_reverse($listeA);
            }
            ?>

    	    <table class="ssh-table">
            <thead>
	    <tr>
            	<th>Login</th>
            	<th>Rôle</th>
            	<th>Date</th>
	    </tr>
            </thead>
	    <tbody>
	    <?php
            $i=0;
            foreach ($liste as $ligne){
                if ($i >=30){break;}
            	$role = $ligne['role'] ?? '';
            	$rowClass = "row-closed";

            	if ($role === "ADMIN_SYS") {
                    $rowClass = "row-success";
            	} elseif ($role === "ADMIN_WEB") {
                    $rowClass = "row-admin";
            	} elseif ($role === "Techniciens") {
                    $rowClass = "row-closed";
            	}

            	echo "<tr class='$rowClass'>";
            	echo "<td class='col-user'><strong>" .$ligne['login']. "</strong></td>";
            	echo "<td class='col-user'>".$role."</td>";
            	echo "<td class='col-date'>" .$ligne['date']. "</td>";
            	echo "</tr>";

            	$i++;
	    	}
?>
		<tbody>
            </table>
        </div>
    </div>
<?php
include_once("../fragments/footers.html");
