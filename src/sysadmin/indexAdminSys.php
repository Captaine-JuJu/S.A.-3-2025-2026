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

// connexion au a la base de donnée
include_once("connexion.php");


    $sql = "SELECT * FROM log";
    $sqlp = mysqli_prepare($connect, $sql);

    mysqli_stmt_execute($sqlp);

    $result = mysqli_stmt_get_result($sqlp);


    $rows = [];
    while ($ligne = mysqli_fetch_row($result)) {
        $rows[] = $ligne;
    }
    $rows = array_reverse($rows);


    echo "<div class='log'>";
        echo "<table>";
        echo "<thead>";
        echo "<th>Login</th>";
        echo "<th>Rôle</th>";
        echo "<th>Date</th>";
        echo "</thead>";
        $i=0;
        foreach ($rows as $ligne){
            if ($i >=30){break;}
            echo "<tr>";
            foreach ($ligne as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
            $i++;
        }
        echo "</table>";
echo "</div>";
include_once("../fragments/footers.html");
