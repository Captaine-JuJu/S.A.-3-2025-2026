<?php
require_once("../authen.php");
authentification("Techniciens");
include("../fragments/headers.html");
include("../accesDenied.php");
?>
    <header>
        <h1>Ajouter écran</h1>
    </header>
<?php
    include("../fragments/menuTech.html");
    ?>
    <?php
    include_once("../connexion.php");

    $sqlFab = "SELECT * FROM fabriquant";
    $sqlOS = "SELECT * FROM os";

    $resultFab = mysqli_query($connect, $sqlFab);
    $resultOS = mysqli_query($connect, $sqlOS);
    ?>
    <div id="container">
        <div id="inventaires">
            <h2>Bienvenue <?php echo $_SESSION['login']?></h2>
            <div id="technique">
                <div id="formulaireAjouter">
                    <h3>Ajout Ecran</h3>
                    <div id="ajoutEcran">
                        <form method="POST" action="actionAjoutE.php">
                            <table role="presentation">
                                <tr>
                                    <td>
                                        <label>N° série :
                                            <input type="text" name="nSerieE" id="nSerieE"></label>
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
                <h3>Inventaire des écrans</h3>
                <?php
                // compte le nombre d'écrans dans la base de données
                $totalsql = "SELECT COUNT(*) AS total FROM Monitors;";
                $resulttotal = mysqli_query($connect, $totalsql);
                $totalM = mysqli_fetch_row($resulttotal)[0];

                $machineParPage = 4;
                if($totalM <= $machineParPage){
                    $nombre_page = 0;
                }else {
                    // calcul le nombre de pages nécessaire pour tous afficher
                    $nombre_page = ceil($totalM / $machineParPage);
                }

                $pageMonitor = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                // Vérifier que la page est dans les bornes
                if ($pageMonitor < 1) {
                    $pageMonitor = 1;
                } elseif ($pageMonitor > $totalM) {
                    $pageMonitor = $totalM;
                }

                //delimite le nombre de page afficher
                $offset = ($pageMonitor - 1) * $machineParPage;

                $sql = "SELECT * FROM Monitors ORDER BY num_series DESC LIMIT ? OFFSET ?";
                $sqlp = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($sqlp, 'ss', $machineParPage, $offset);
                mysqli_stmt_execute($sqlp);
                $result = mysqli_stmt_get_result($sqlp);
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
                        <th></th>
                    </tr>
                    <?php
                    while ($ligne = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        foreach ($ligne as $value){
                            echo "<td>".$value."</td>";
                        }
                        echo "<td><input type='submit' name='supprimer' value='supprimer'></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <nav class="pagination">
                    <?php
                    if($nombre_page != 0){
                        if ($pageMonitor > 1): ?>
                            <a href="technicien_ecran.php?page=<?= $pageMonitor - 1?>" class="prev">Précédent</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $nombre_page; $i++): ?>
                            <?php if ($i == $pageMonitor): ?>
                                <span><strong><?= $i ?></strong></span>
                            <?php else: ?>
                                <a href="technicien_ecran.php?page=<?= $i?>" class="page"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($pageMonitor < $nombre_page): ?>
                            <a href="technicien_ecran.php?page=<?= $pageMonitor + 1?>" class="next">Suivant</a>
                        <?php endif; }?>
                </nav>
            </div>
        </div>
    </div>
<?php
//Fermeture base de donné
mysqli_close($connect);
include("../fragments/footers.html");
?>