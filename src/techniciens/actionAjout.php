<?php

if(isset($_POST["nom"], $_POST["nSerieUC"])){

    $nom = $_POST["nom"];
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

    $connect = mysqli_connect("localhost", "root", "azerty", "users");

    $bd = mysqli_select_db($connect, "Devices");

    $sqlVerif = "SELECT * FROM Devices WHERE Num_serie='$nSerieUC';";
    $sqlVerifP = "SELECT * FROM Devices WHERE Num_serie=?;";

    $result = mysqli_query($connect, $sqlVerif);
    $requete = mysqli_prepare($connect, $sqlVerifP);

    //Si le numéro de série n'est pas déjà dans la bdd
    if(mysqli_num_rows($result) == 0 && mysqli_stmt_bind_param($requete, "s", $nSerieUC)){

        $sqlAdd = "INSERT INTO Devices VALUES ('$nom','$nSerieUC','$fabriquant','$model','$type','$cpu','$ram','$stockage','$OS','$Domaine','$Localisation','$batiment','$date_achat','$date_fin');";
        mysqli_query($connect, $sqlAdd);
        header("location: technicien.php?creation=ok");

    }
    header("location: technicien.php?creation=deja_existent");
}
header("location: technicien.php?error");
