<?php

print_r($_POST);

// connexion au a la base de donnée
$connect = mysqli_connect("192.168.25.15", "root", "sea2025","!sea2025!", "users");
$bd = mysqli_select_db($connect, "users");

// verification des données du formulaire
if (isset($_POST["login"], $_POST["mdp"], $_POST["Connexion"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    // requete SQL sur la table user
    $sql = "SELECT * FROM user";
    // requete SQL préparé
    $sqlp = "SELECT * FROM user WHERE login=? AND password=?";

    //envoie de la requete à la base de donnée
    $result = mysqli_query($connect, $sql);
    //Prépare requête SQL
    $requete = mysqli_prepare($connect, $sqlp);

    // lecture ligne par ligne de la table user
    while($ligne = mysqli_fetch_row($result)){
        // verification de l'identifiant et du mot de passe en comparant aux données de la table user
        if ($login == $ligne[0] && $mdp == $ligne[1] && mysqli_stmt_bind_param($requete, "ss", $login, $mdp)){
            session_start();
            $_SESSION["login"] = $login;
            header("location: journauxActivites.php");
            exit(0);
        }
    }

}
header("location: pageConnexion.php?error");
