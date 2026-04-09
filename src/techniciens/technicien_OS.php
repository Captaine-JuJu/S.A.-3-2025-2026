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
    <div class="container">
        <div class="inventaires">
            <h2>Bienvenue <?php echo $_SESSION['login']?></h2>
            <div class="technique">
                <div class="formulaireAjouter">
                    <h3>Ajout Unitée Central</h3>
                    <div class="ajoutUC">
                        <form method="POST" action="actionAjoutUC.php">
                            <table role="presentation">
                                <tr>
                                    <td>
                                        <label for="nomUC">Nom (Obligatoire):
                                            <input type="text" name="nomUC" id="nomUC" required></label>
                                    </td>
                                    <td>
                                        <label for="nSerieUC">N° Serie (Obligatoire):
                                            <input type="text" name="nSerieUC" id="nSerieUC" required></label>
				                    </td>
                                    <td>
                                        <label for="fabricantUC">Fabricant : 
                                            <select name="fabricantUC" id="fabricantUC">
                                                <option value=""> Choisissez une option </option>
                                                <?php
                                                while ($ligne = mysqli_fetch_row($resultFab)) {
                                                    echo "<option value='".$ligne[0]."'>".$ligne[0]."</option>";
						                        }
                                                ?>
                                            </select>
					</label>   
                                    </td>
                                    <td>
                                        <label for="modelUC">Model :
                                            <input type="text" name="modelUC" id="modelUC"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="typeUC">Type :
                                            <input type="text" name="typeUC" id="typeUC"></label>
                                    </td>
                                    <td>
                                        <label for="CPUUC">CPU :
                                            <input type="text" name="CPUUC" id="CPUUC"></label>
                                    </td>
                                    <td>
                                        <label for="RAMUC">RAM (Go) :
                                            <input type="text" name="RAMUC" id="RAMUC"></label>
                                    </td>
                                    <td>
                                        <label for="stockageUC">Stockage (Go) :
                                            <input type="text" name="stockageUC" id="stockageUC"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="OSUC">OS : 
                                        <select name ="OSUC" id="OSUC">
                                            <option value=""> Choisissez une option </option>
                                            <?php
                                            while ($ligne = mysqli_fetch_row($resultOS)) {
                                                echo "<option value='".$ligne[0]."'>".$ligne[0]."</option>";
					    }
                                            ?>
                                        </select>
					</label>
                                    </td>
                                    <td>
                                        <label for="domaineUC">Domaine :
                                            <input type="text" name="domaineUC" id="domaineUC"></label>
                                    </td>
                                    <td>
                                        <label for="localisationUC">Localisation :
                                            <input type="text" name="localisationUC" id="localisationUC"></label>
                                    </td>
                                    <td>
                                        <label for="batimentUC">Bâtiment :
                                            <input type="text" name="batimentUC" id="batimentUC"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="pieceUC">Pièce :
                                            <input type="text" name="pieceUC" id="pieceUC"></label>
                                    </td>
                                    <td>
                                        <label for="DDRUC">DDR :
                                            <input type="text" name="DDRUC" id="DDRUC"></label>
                                    </td>
                                    <td>
                                        <label for="dateAchatUC">Date d'achat :
                                            <input type="date" name="dateAchatUC" id="dateAchatUC"></label>
                                    </td>
                                    <td>
                                        <label for="finGarantisUC">Date de fin de garantis :
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

                <div class="formulaireImporterExporterFichier">
                    <div id="exporte">
                        <h3>Exporter fichier des machines</h3>
                        <label for="exporter">Exporter :
                            <input type="button" value="exporter" name="exporter"></label>
                    </div>
                    <div class="import">
                        <h3>Importer fichier des machines</h3>

                        <label for="importer">Importer :
                            <input type="file" value="importer" name="importer"></label>
                    </div>
                </div>
                <h3>Inventaire des unites centrales</h3>

                <?php
                //$colonne = isset($_POST['colonne']) ? $_POST['colonne'] : 'all';


                // compte le nombre d'article dans la base de données
                $totalsql = "SELECT COUNT(*) AS total FROM Devices;";
                $resulttotal = mysqli_query($connect, $totalsql);
                $total = mysqli_fetch_row($resulttotal)[0];

                $machineParPage = 26;
                if($total <= $machineParPage){
                    $nombre_page = 0;
                }else {
                 //  calcul le nombre de pages nécessaire pour tous afficher
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
                $sql = "SELECT Nom, Num_serie, Fabricant, Model, Type, Domaine, Bâtiment, Pieces, Date_garantis FROM Devices ORDER BY Bâtiment, Nom ASC LIMIT ? OFFSET ?";
                $sqlp = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($sqlp, 'ss', $machineParPage, $offset);
                mysqli_stmt_execute($sqlp);
                $result = mysqli_stmt_get_result($sqlp);
                ?>

                <table class="unitéesCentrales" id="tabfixos">
                    <tr>
                        <th>Nom</th>
                        <th>N° série</th>
                        <th>Fabricant</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Domain</th>
                        <th>Bâtiment</th>
                        <th>Pièce</th>
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
                        echo "<td>";
			echo "<form method='POST' action='actionsupprime.php'>";
			echo "<input type='hidden' id='nomS' name='nomS' value='".$ligne['Nom']."'>";
			echo "<input type='hidden' id='idS' name='idS' value='".$ligne['Num_serie']."'>";
			echo "<button type='submit'>Supprimer</button>";
			echo "</form>";
			echo "</td>";
                    }
                    ?>
                </table>
                <nav class="pagination">
                    <?php
                    if($nombre_page != 0){
                        if ($pageActuelle == 1):
			    $debut = 1;
			    $fin = $pageActuelle +2;
			elseif ($pageActuelle == 2): ?>
			    <a href="technicien_OS.php?page=<?=1?>#tabfixos" class="page"><<</a>
                            <a href="technicien_OS.php?page=<?= $pageActuelle - 1 ?>#tabfixos" class="prev">Précédent</a>
                    	<?php
			    $debut = $pageActuelle -1;
			    $fin = $pageActuelle +1;
			else: ?>
			    <a href="technicien_OS.php?page=<?=1?>#tabfixos" class="page"><<</a>
			    <a href="technicien_OS.php?page=<?= $pageActuelle -1 ?>#tabfixos" class="prev">Précédent</a>
			    <span>...</span>
			<?php
			    $debut = $pageActuelle -1;
			    $fin = $pageActuelle +1;
			endif;
			if ($pageActuelle == $nombre_page or $pageActuelle == $nombre_page-1):
			    $debut = $nombre_page -2;
			    $fin = $nombre_page;
			endif ?>

                    <?php for ($i = $debut; $i <= $fin; $i++): ?>
                        <?php if ($i == $pageActuelle): ?>
                            <span><strong><?= $i ?></strong></span>
                        <?php else: ?>
                            <a href="technicien_OS.php?page=<?= $i ?>#tabfixos" class="page"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($pageActuelle == $nombre_page-1): ?>
                            <a href="technicien_OS.php?page=<?= $pageActuelle + 1 ?>#tabfixos" class="next">Suivant</a>
			    <a href="technicien_OS.php?page=<?= $nombre_page ?>#tabfixos" class="page">>></a>
		    <?php elseif ($pageActuelle != $nombre_page):?>
			    <span>...</span>
			    <a href="technicien_OS.php?page=<?= $pageActuelle +1 ?>#tabfixos" class="next">Suivant</a>
			    <a href="technicien_OS.php?page=<?= $nombre_page ?>#tabfixos" class="page">>></a>
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
