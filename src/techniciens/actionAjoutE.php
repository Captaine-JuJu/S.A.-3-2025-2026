<?php
print_r($_POST);
include_("../connexion.php");
if(isset($_POST["nSerieE"], $_POST["connecteurE"])){

    $fabricant = $_POST["fabricantE"];
    $nSerie = $_POST["nSerieE"];
    $modele = $_POST["modeleE"];
    $taille = $_POST["tailleE"];
    $reso = $_POST["resolutionE"];
    $connecteur = $_POST["connecteurE"];
    $support = $_POST["supportE"];

    //$connect = mysqli_connect("localhost", "root", "");
    $sqlVerif = "SELECT num_serie FROM Monitors ;";

    $result = mysqli_query($connect, $sqlVerif);
    $requete = "INSERT INTO Devices VALUES ('$nSerie', '$fabricant', '$modele', '$taille', '$reso', '$connecteur', '$support');";
  //Si le numéro de série n'est pas déjà dans la bdd
    while($row = mysqli_fetch_row($result)){
        if($row[0] == $nSerie){

            header("location: technicien.php?creation=deja_existent");
            exit(0);
        }
    }
    $ajout = mysqli_query($connect, $requete);
    header("location: technicien.php");
    //uwu
}
