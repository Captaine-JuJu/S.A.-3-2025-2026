<?php
print_r($_POST);
include_once("../connexion.php");
if(isset($_POST["numS"])){
    $num = $_POST["numS"];
    $sql = "DELETE FROM Devices where num_serie='$num';";
    if (mysqli_query($connect, $sql)) {
        header("Location: technicien_ecran.php?status=succes");
    } else {
        echo "Erreur lors de la suppression";
    }
}
