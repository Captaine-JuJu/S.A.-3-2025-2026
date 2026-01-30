<?php
    include("fragments/headers.html");
?>
<header>
    <h1>Gestion</h1>
</header>
<?php
    include("fragments/menu.html");
    include("connexion.php");
?>
<div id="container">
    <div id="inventaires">
        <h2>Bienvenue</h2>
        <div id="technique">

            <h3>Inventaire des unités centrales</h3>

            <?php
                $sql = "SELECT * FROM Devices";
                $result = mysqli_query($connect, $sql);
            ?>

            <table id="unitéesCentrales">
                <tr>
                    <th>Nom</th>
                    <th>N° série</th>
                    <th>Fabricant</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>CPU</th>
                    <th>RAM</th>
                    <th>Stockage</th>
                    <th>OS</th>
                    <th>Domain</th>
                    <th>Localisation</th>
                    <th>Bâtiment</th>
                    <th>Pièce</th>
                    <th>DDR</th>
                    <th>Date d'achat</th>
                    <th>Date fin garantis</th>
                </tr>
                <?php
                    while ($ligne = mysqli_fetch_row($result)) {
                        echo "<tr>";
                        foreach($ligne as $value){
                        	echo "<td>".$value."</td>";
                        }
                        echo "</tr>";
                    }
                ?>

            </table>
            <h3>Inventaire des écrans</h3>
            <?php
                $sql = "SELECT * FROM Monitors";
                $result = mysqli_query($connect, $sql);
            ?>
            <table>
                <tr>
                    <th>N° série</th>
                    <th>Fabricant</th>
                    <th>Model</th>
                    <th>Taille</th>
                    <th>Résolution</th>
                    <th>Relié à</th>
                    <th>Support</th>
                </tr>
                <?php
                while ($ligne = mysqli_fetch_row($result)) {
                    echo "<tr>";
                    foreach ($ligne as $value){
                        echo "<td>".$value."</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
    //Fermeture base de donnée
    mysqli_close($connect);
    include("fragments/footers.html");
?>
