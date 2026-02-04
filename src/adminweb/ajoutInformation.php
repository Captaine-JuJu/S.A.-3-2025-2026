<?php
require_once("../authen.php");
authentification("ADMIN_WEB");
include("../fragments/headers.html");
include("../accesDenied.php");
?>
<header>
    <h1>Ajout information machine</h1>
</header>
<?php
include("../fragments/menuweb.html");
include_once("../connexion.php");
?>
<div class="tech">
    <div class="connexion">
        <div class="pageConnexion">
            <div class="container">
                <div class="inventaires">
                    <div class="technique">
                        <div class="formulaireAjouter">
                            <form method="post">
                                <h2> Ajout nom des systèmes d’exploitations</h2>
                                <label for="OS">Nom OS:<br>
                                    <input type="text" id="OS" name="OS"></label><br>
                        <input type="submit" name="ajouterOS" value="Ajouter">
                                <h2> Ajout du fabriquant</h2>
                                <label for="fabriquant">Fabricant:<br>
                                    <input type="text" id="fabriquant" name="fabriquant"></label><br>
                                <input type="submit" name ="ajouterFAB" value="Ajouter">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    if(isset($_POST["OS"])) {
        header("location: ../adminweb/ajoutInformation.php");
        $OS = $_POST["OS"];
        $sql = "INSERT INTO os (nom) VALUES ('$OS');";
        $sqlP = "INSERT INTO os (nom) VALUES (?);";

        $requete = mysqli_query($connect, $sql);
        if ($requete && mysqli_stmt_bind_param($requete, "s", "$OS")) {
            echo "Nouvel OS enregistré avec succès";
        } else {
            echo "Erreur : " . $sql . "<br>" .mysqli_error($connect);
        }
    }
    if(isset($_POST["fabriquant"])) {
        header("location: ../adminweb/ajoutInformation.php");
        $FAB = $_POST["fabriquant"];
        $sql = "INSERT INTO fabriquant (nom) VALUES ('$FAB');";
        $sqlp = "INSERT INTO fabriquant (nom) VALUES (?);";
        $requete = mysqli_query($connect, $sql);
        if ($requete && mysqli_stmt_bind_param($requete, "s", $FAB)){
            echo "Nouveau fabriquant enregistré avec succès";
        } else {
            echo "Erreur : " . $sql . "<br>" .mysqli_error($connect);
        }
    }
    ?>
    <div class="listetech connexion">
        <div class="pageConnexion">
            <div class="container">
                <div class="clinventaires">
                    <h3>Liste des os</h3>
                    <?php
                    $sql = "SELECT nom FROM os;";
                    $result = mysqli_query($connect, $sql);
                    ?>
                    <table id="techniciens">
                        <tr>
                            <th>Nom</th>
                            <th></th>
                        </tr>
                        <?php
                        while ($ligne= mysqli_fetch_row($result)){
                            echo "<tr>";
                            echo "<td>".$ligne[0]."</td>";
                            echo "<td><input type='button' name='supprimer' value='supprimer'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="listetech connexion">
        <div class="pageConnexion">
            <div class="container">
                <div class="clinventaires">
                    <h3>Liste des fabricants</h3>
                    <?php
                    $sql = "SELECT nom FROM fabriquant;";
                    $result = mysqli_query($connect, $sql);
                    ?>
                    <table id="techniciens">
                        <tr>
                            <th>Nom</th>
                            <th></th>
                        </tr>
                        <?php
                        while ($ligne= mysqli_fetch_row($result)){
                            echo "<tr>";
                            echo "<td>".$ligne[0]."</td>";
                            echo "<td><input type='button' name='supprimer' value='supprimer'></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../fragments/footers.html");
?>

