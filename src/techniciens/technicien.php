<?php
include("../fragments/headers.html");

?>
    <header>
        <h1>Gestion</h1>
    </header>
<?php
include("../fragments/menuTech.html");
?>
    <div id="container">
        <div id="inventaires">
            <h2>Bienvenue <?php echo $_SESSION['login']?></h2>
            <div id="technique">
                <div id="formulaireAjouter">
                    <h3>Ajout Unitée Central</h3>
                    <div id="ajoutUC">
                        <form method="POST" action="actionAjout.php">
                            <table role="presentation">
                                <tr>
                                    <td>
                                        <label>Nom :
                                            <input type="text" name="nom" id="nom"></label>
                                    </td>
                                    <td>
                                        <label>N° Serie :
                                            <input type="text" name="nSerieUC" id="nSerieUC"></label>
                                    </td>
                                    <td>
                                        <label>Fabricant :
                                            <input type="text" name="fabricantUC" id="fabricantUC"></label>
                                    </td>
                                    <td>
                                        <label>Model :
                                            <input type="text" name="modelUC" id="modelUC"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Type :
                                            <input type="text" name="typeUC" id="typeUC"></label>
                                    </td>
                                    <td>
                                        <label>CPU :
                                            <input type="text" name="CPUUC" id="CPUUC"></label>
                                    </td>
                                    <td>
                                        <label>RAM :
                                            <input type="text" name="RAMUC" id="RAMUC"></label>
                                    </td>
                                    <td>
                                        <label>Stockage :
                                            <input type="text" name="stockageUC" id="stockageUC"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>OS :
                                            <input type="text" name="OSUC" id="OSUC"></label>
                                    </td>
                                    <td>
                                        <label>Domaine :
                                            <input type="text" name="domaineUC" id="domaineUC"></label>
                                    </td>
                                    <td>
                                        <label>Localisation :
                                            <input type="text" name="localisationUC" id="localisationUC"></label>
                                    </td>
                                    <td>
                                        <label>Bâtiment :
                                            <input type="text" name="batimentUC" id="batimentUC"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Pièce :
                                            <input type="text" name="pieceUC" id="pieceUC"></label>
                                    </td>
                                    <td>
                                        <label>DDR :
                                            <input type="text" name="DDRUC" id="DDRUC"></label>
                                    </td>
                                    <td>
                                        <label>Date d'achat :
                                            <input type="date" name="dateAchatUC" id="dateAchatUC"></label>
                                    </td>
                                    <td>
                                        <label>Date de fin de garantis :
                                            <input type="date" name="finGarantisUC" id="finGarantisUC"></label>
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" value="Ajouter" name="OK">
                        </form>
                    </div>

                    <h3>Ajout Ecran</h3>
                    <div id="ajoutEcran">

                        <form method="POST" action="actionAjout.php">
                            <table role="presentation">
                                <tr>
                                    <td>
                                        <label>N° série :
                                            <input type="number" name="nSerieE" id="nSerieE"></label>
                                    </td>
                                    <td>
                                        <label>Fabricant :
                                            <input type="text" name="fabricantE" id="fabricantE"></label>
                                    </td>
                                    <td>
                                        <label>Model :
                                            <input type="text" name="modelE" id="modelE"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Taille :
                                            <input type="text" name="tailleE" id="tailleE"></label>
                                    </td>
                                    <td>
                                        <label>Résolution :
                                            <input type="text" name="resolutionE" id="resolutionE"></label>
                                    </td>
                                    <td>
                                        <label>Relié à :
                                            <input type="text" name="connecteurE" id="connecteurE"></label>
                                    </td>
                                    <td>
                                        <label>Support :
                                            <input type="text" name="supportE" id="supportE"></label>
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" value="Ajouter" name="OK">
                        </form>
                        <?php
                        if (isset($_GET['error']))
                            echo "Connexion échoué";
                        else if (isset($_GET['creation=deja_existent']))
                            echo "numéros déjà existant";
                        else if (isset($_GET['creation=ok']))
                            echo "Ajout réussie";
                        ?>
                    </div>
                </div>

                <div id="formulaireImporterExporterFichier">
                    <div id="exporte">
                        <h3>Exporter fichier des machines</h3>
                        <label>Exporter :
                            <input type="button" value="exporter" name="exporter"></label>
                    </div>
                    <div id="import">
                        <h3>Importer fichier des machines</h3>

                        <label>Importer :
                            <input type="file" value="importer" name="importer"></label>
                    </div>
                </div>
                <h3>Inventaire des unités centrales</h3>

                <?php
                $connect = mysqli_connect("192.168.25.15", "root", "sea2025","!sea2025!", "users");
                $bd = mysqli_select_db($connect, "users");
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
                    while ($ligne = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        foreach ($ligne as $value){
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
                    while ($ligne = mysqli_fetch_array($result)) {
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
include("../fragments/footers.html");
?>
