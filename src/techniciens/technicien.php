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
                    </div>

                    <h3>Ajout Ecran</h3>
                    <div id="ajoutEcran">

                        <form method="POST" action="actionAjoutE.php">
                            <table role="presentation">
                                <tr>
                                    <td>
                                        <label>N° série (Obligatoire) :
                                            <input type="text" name="nSerieE" id="nSerieE"></label>
                                    </td>
                                    <td>
                                        <label>Fabricant (Obligatoire):
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
                <label for="Machine">Machines:<br>
                    <select name="Machines">
                        <?php
                        echo "<option value='Unites_centrales'>Unites centrales</option>";
                        echo "<option value='ecrans'>Ecrans</option>";
                        ?>
                    </select>
                </label><br>
                <h3>Inventaire des Machines</h3>
                <label for="colonnes">Colonnes:<br>
                    <select name="colonnes">
                        <?php
                        $sql = "DESCRIBE devices;";
                        $result = mysqli_query($connect, $sql);
                        while ($ligne = mysqli_fetch_row($result)){
                            echo "<option value='.$ligne[0].'>".$ligne[0] ."</option>";
                        }
                        ?>
                    </select>
                </label><br>

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
                        <th></th>
                    </tr>
                    <?php
                    while ($ligne = mysqli_fetch_row($result)) {
                        echo "<tr>";
                        $nom = $ligne[0];
                        foreach ($ligne as $value){
                            echo "<td>".$value."</td>";
                        }
                        echo "<td><input type='button' name='supprimer' value='supprimer'></td>";
                        echo "</tr>";
                    }
                    if (isset($_GET['supprimer'])){
                        $sql = "DELETE FROM Devices where Nom='$nom';";
                        $result = mysqli_query($connect, $sql);
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
                        <th></th>
                    </tr>
                    <?php
                    while ($ligne = mysqli_fetch_row($result)) {
                        echo "<tr>";
                        foreach ($ligne as $value){
                            echo "<td>".$value."</td>";
                        }
                        echo "<td><input type='submit' name='supprimer' value='supprimer'></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
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
