<?php
include("../headers.html");
?>
    <title>Page - Technicien</title>
    </head>
    <body>
    <header>
        <h1>Gestion</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="technicien.php">Gestion</a></li>
            <li><a href="pageConnexion.php">Connexion</a></li>
        </ul>
    </nav>
    <div id="container">
        <div id="inventaires">
            <h2>Bienvenue (login)</h2>
            <div id="technique">
                <div id="formulaireAjouter">
                    <h3>Ajout Unitée Central</h3>
                    <div id="ajoutUC">
                        <form method="POST" action="">
                            <table role="presentation">
                                <tr>
                                    <td>
                                        <label>Nom :
                                            <input type="text" name="nom" id="nom"></label>
                                    </td>
                                    <td>
                                        <label>N° Serie :
                                            <input type="number" name="nSerieUC" id="nSerieUC"></label>
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

                        <form method="POST" action="">
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
                </table>
                <h3>Inventaire des écrans</h3>
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
                </table>
            </div>
        </div>
    </div>
    </body>
    </html>


<?php
include("technicien.html");
session_start();
if(isset($_SESSION['login'])){
    $login = $_SESSION['login'];
    if ($_SESSION['login']=="admin"){
        echo"bonjour Administrateur";
        echo "<br>";
    }else{
        echo"bonjour $login";
        echo "<br>";
    }

    echo "<a href='logout.php'>logout </a>";
} else {
    header("location:login.php?error");
}
