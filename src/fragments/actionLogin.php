<?php

print_r($_POST);

// connexion au a la base de donnée
$connect = mysqli_connect("localhost", "root", "");
$bd = mysqli_select_db($connect, "sae");

// verification des données du formulaire
if (isset($_POST["login"], $_POST["mdp"], $_POST["Connexion"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    // requete SQL sur la table user
    $sql = "SELECT * FROM user";
    //envoie de la requete à la base de donnée
    $result = mysqli_query($connect, $sql);
    // lecture ligne par ligne de la table user
    while($ligne = mysqli_fetch_row($result)){
        // verification de l'identifiant et du mot de passe en comparant aux données de la table user
        if ($login == $ligne[0] && $mdp == $ligne[1]){
            session_start();
            $_SESSION["login"] = $login;
            header("location: journauxActivites.php");
            exit(0);
        }
    }

}
header("location: pageConnexion.php?error");
