<?php
include("../fragments/headers.html");
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
                    <h2> Ajout du fabriquant</h2>
                    <label for="fabriquant">Fabricant:<br>
                        <input type="text" id="fabriquant" name="fabriquant"></label><br>
                    <input type="submit" name ="ajouter" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$connect = mysqli_connect("localhost", "root", "azerty", "users");
//$connect = mysqli_connect("localhost", "root", "");
$bd = mysqli_select_db($connect, "os");
if(isset($_POST["OS"], $_POST["fabriquant"],$_POST["fabriquant"])) {
    $OS = $_POST["OS"];
    $fabriquant = $_POST["fabriquant"];
    $sql = "INSERT INTO os (Nom, Fabricant) VALUES('$OS','$fabriquant');";
    if (mysqli_query($connect, $sql)) {
        echo "Nouveau enregistrement créé avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" .mysqli_error($connect);
    }
}
include("../fragments/footers.html");
?>

