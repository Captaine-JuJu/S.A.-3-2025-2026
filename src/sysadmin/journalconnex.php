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

            <h1>Journal d'activité 2</h1>
            <?php
            $contenu = file_get_contents('../données/logEchec.json');
            $listeA = json_decode($contenu, true);

            if (is_array($listeA)) {
                $liste = array_reverse($listeA);
            }
	    ?>

            <table class="ssh-table">
            <thead>
            <th>Login</th>
            <th>Motif</th>
            <th>Date</th>
            </thead>
	    <?php
            $i=0;
            foreach ($liste as $ligne){
                if ($i >=30){break;}
                echo "<tr>";
                echo "<td class='col-user'>".$ligne['login']."</td>";
                echo "<td class='col-ip'>".$ligne['motif']."</td>";
		echo "<td class='col-date'>".$ligne['date']."</td>";
                echo "</tr>";
                $i++;
            }
            echo "</table>";
            ?>
        </div>
    </div>
<?php
include_once("../fragments/footers.html");
