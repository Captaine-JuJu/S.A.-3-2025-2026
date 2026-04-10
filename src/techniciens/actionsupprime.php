<?php
include_once("../connexion.php");

if (isset($_POST["nomS"], $_POST["idS"])) {
    $nom = $_POST["nomS"];
    $num = $_POST["idS"];

    $sql = "DELETE FROM Devices where Nom='$nom' AND Num_serie='$num';";

    if (mysqli_query($connect, $sql)) {

        header("Location: technicien_OS.php?status=succes");

    } else {

        echo "Erreur lors de la suppression";

    }

}
