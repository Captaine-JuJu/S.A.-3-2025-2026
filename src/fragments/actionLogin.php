<?php

print_r($_POST);

$connect = mysqli_connect("localhost", "root", "");
$bd = mysqli_select_db($connect, "sae");

if (isset($_POST["login"], $_POST["mdp"], $_POST["Connexion"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    $sql = "SELECT * FROM user";
    $result = mysqli_query($connect, $sql);
    while($ligne = mysqli_fetch_row($result)){
        if ($login == $ligne[0] && $mdp == $ligne[1]){
            session_start();
            $_SESSION["login"] = $login;
            header("location: journauxActivites.php");
            exit(0);
        }
    }

}
header("location: pageConnexion.php?error");