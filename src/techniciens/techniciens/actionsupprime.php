<?php
print_r($_GET);
echo $_GET["nom"];
include_once("../connexion.php");
if(isset($_GET["nom"])){
    $nom = $_GET["nom"];
    $sql = "DELETE FROM Devices where Nom='$nom';";
    $result = mysqli_query($connect, $sql);
}