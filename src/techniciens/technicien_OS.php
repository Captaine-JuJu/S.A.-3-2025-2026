<?php
require_once("../authen.php");
authentification("Techniciens");
include("../fragments/headers.html");
include("../accesDenied.php");
?>
    <header>
        <h1>Gestion</h1>
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
                    <h3>Ajout Unitée Central</h3>
                    <div id="ajoutUC">
                        <form method="POST" action="actionAjoutUC.php">
                            <table role="presentation">
                                <tr>
                                    <td>
                                        <label>Nom (Obligatoire):
                                            <input type="text" name="nomUC" id="nomUC" required></label>
                                    </td>
                                    <td>
                                        <label>N° Serie (Obligatoire):
                                            <input type="text" name="nSerieUC" id="nSerieUC" required></label>
				                    </td>
                                    <td>
                                        <label>Fabricant : </label>
                                            <select name="fabricantUC" id="fabricantUC">
                                                <option value=""> Choisissez une option </option>
                                                <?php
                                                while ($ligne = mysqli_fetch_row($resultFab)) {
                                                    echo "<option value='".$ligne[0]."'>".$ligne[0]."</option>";
						                        }
                                                ?>
                                            </select>
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
                                        <label>RAM (Go) :
                                            <input type="text" name="RAMUC" id="RAMUC"></label>
                                    </td>
                                    <td>
                                        <label>Stockage (Go) :
                                            <input type="text" name="stockageUC" id="stockageUC"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>OS : </label>
                                        <select name ="OSUC" id="OSUC">
                                            <option value=""> Choisissez une option </option>
                                            <?php
                                            while ($ligne = mysqli_fetch_row($resultOS)) {
                                                echo "<option value='".$ligne[0]."'>".$ligne[0]."</option>";
					    }
                                            ?>
                                        </select>
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
                            <input type="submit" value="AjouterUC" name="OK">
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
                <h3>Inventaire des unites centrales</h3>
                <form method="POST">
                    <label for="colonnes">Colonnes:<br>
                        <select name="colonnes">
                            <?php
                            // affiche le nom des colonnes du tableau dans le select
                            $sql = "DESCRIBE devices;";
                            $result = mysqli_query($connect, $sql);
                            $nbr_ligne = 0;
                            while ($li= mysqli_fetch_row($result)){
                                // n'affiche que les colonnes pas déja afficher dans le tableau
                                if($nbr_ligne >= 3) {
                                    echo "<option value='.$li[0].'>" . $li[0] . "</option>";
                                }
                                $nbr_ligne++;
                            }
                            ?>
                        </select>
                    </label>
                </form><br>

                <?php
                $colonne = isset($_POST['colonne']) ? $_POST['colonne'] : 'all';


                // compte le nombre d'article dans la base de données
                $totalsql = "SELECT COUNT(*) AS total FROM Devices;";
                $resulttotal = mysqli_query($connect, $totalsql);
                $total = mysqli_fetch_row($resulttotal)[0];

                $machineParPage = 2;
                if($total <= $machineParPage){
                    $nombre_page = 0;
                }else {
                    // calcul le nombre de pages nécessaire pour tous afficher
                    $nombre_page = ceil($total / $machineParPage);
                }
                $pageMonitor = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                // Vérifier que la page est dans les bornes
                if ($pageActuelle < 1) {
                    $pageActuelle = 1;
                } elseif ($pageActuelle > $total) {
                    $pageActuelle = $total;
                }

                //delimite le nombre de page afficher
                $offset = ($pageActuelle - 1) * $machineParPage;

                //affiche le nombre d'unités centrale dans la base de données
                $sql = "SELECT * FROM Devices ORDER BY Nom DESC LIMIT ? OFFSET ?";
                $sqlp = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($sqlp, 'ss', $machineParPage, $offset);
                mysqli_stmt_execute($sqlp);
                $result = mysqli_stmt_get_result($sqlp);
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
                        <th></th>
                    </tr>
                    <?php
                    while ($ligne = mysqli_fetch_assoc($result)) {
                        $nom = $ligne['Nom'];
                        echo "<tr>";
                        foreach ($ligne as $value){
                            echo "<td>".$value."</td>";
                        }
                        echo "<td><input type='submit' formmethod='get' formaction='actionsupprime.php' name='supprimer' value='supprimer'></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>

                <nav class="pagination">
                    <?php
                    if($nombre_page != 0){
                        if ($pageActuelle > 1): ?>
                        <a href="technicien_OS.php?page=<?= $pageActuelle - 1 ?>page2=<?=$pageMonitor?>" class="prev">Précédent</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $nombre_page; $i++): ?>
                        <?php if ($i == $pageActuelle): ?>
                            <span><strong><?= $i ?></strong></span>
                        <?php else: ?>
                            <a href="technicien_OS.php?page=<?= $i ?>page2=<?=$pageMonitor?>" class="page"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($pageActuelle < $nombre_page): ?>
                        <a href="technicien_OS.php?page=<?= $pageActuelle + 1 ?>page2=<?=$pageMonitor?>" class="next">Suivant</a>
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
<?php
//include("techniciens.html");
//session_start();
//if(isset($_SESSION['login'])){
//    $login = $_SESSION['login'];
//    if ($_SESSION['login']=="admin"){
//        echo"bonjour Administrateur";
//        echo "<br>";
//    }else{
//        echo"bonjour $login";
//        echo "<br>";
//    }
//
//    echo "<a href='logout.php'>logout </a>";
//} else {
//    header("location:login.php?error");
//}
