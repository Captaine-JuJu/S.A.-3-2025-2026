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
?>
<div id="container">
    <div id="inventaires">
        <div id="technique">
            <div id="formulaireAjouter">
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
<?php
include_once("../connexion.php");
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
include("../fragments/footers.html");
?>

