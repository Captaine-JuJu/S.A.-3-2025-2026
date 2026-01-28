<?php
print_r($_POST);
include_once("../connexion.php");
if(isset($_POST["nomUC"], $_POST["nSerieUC"])){

    $nom = $_POST["nomUC"];
    $nSerieUC = $_POST["nSerieUC"];
    $fabriquant = $_POST["fabriquantUC"];
    $model = $_POST["modelUC"];
    $type = $_POST["typeUC"];
    $cpu = $_POST["CPUUC"];
    $ram = $_POST["RAMUC"];
    $stockage = $_POST["stockageUC"];
    $OS = $_POST["OSUC"];
    $Domaine = $_POST["domaineUC"];
    $Localisation = $_POST["localisationUC"];
    $batiment = $_POST["batimentUC"];
    $pieces = $_POST["pieceUC"];
    $mac_addr = $_POST["DDRUC"];
    $date_achat = $_POST["dateAchatUC"];
    $date_fin = $_POST["finGarantisUC"];

    //$connect = mysqli_connect("localhost", "root", "");
    $sqlVerif = "SELECT Nom, Num_serie FROM Devices;";

    $result = mysqli_query($connect, $sqlVerif);
    $requete = "INSERT INTO Devices VALUES ('$nom', '$nSerieUC', '$fabriquant', '$model', '$type', '$cpu', '$ram', '$stockage', '$OS', '$Domaine', '$Localisation', '$batiment', '$pieces', '$mac_addr', '$date_achat', '$date_fin');";
    //Si le numéro de série n'est pas déjà dans la bdd
    while($row = mysqli_fetch_row($result)){
        if($row[0] == $nom || $row[1] == $nSerieUC){
            header("location: technicien.php?creation=deja_existent");
            exit(0);
        }
    }
    echo("ok");
    $ajout = mysqli_query($connect, $requete);
    mysqli_close($connect);
    header("location: technicien.php");
}
mysqli_close($connect);
header("location: technicien.php?error");
