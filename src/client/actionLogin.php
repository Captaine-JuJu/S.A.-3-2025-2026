<?php

print_r($_POST);

// connexion au a la base de donnée
$connect = mysqli_connect("localhost", "root", "azerty", "users");

$bd = mysqli_select_db($connect, "users");

// verification des données du formulaire
if (isset($_POST["login"], $_POST["mdp"], $_POST["Connexion"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    // requete SQL sur la table user
    $sql = "SELECT * FROM user WHERE login='$login' AND password='$mdp'";
    // requete SQL préparé
    $sqlp = "SELECT * FROM user WHERE login=? AND password=?";

    // envoi de la requete à la base de donnée
    $result = mysqli_query($connect, $sql);
    //Prépare requête SQL
    $requete = mysqli_prepare($connect, $sqlp);

    // verification de l'identifiant et du mot de passe en comparant aux données de la table user
    if (mysqli_num_rows($result) == 1 && mysqli_stmt_bind_param($requete, "ss", $login, $mdp)){
        session_start();
        $_SESSION["login"] = $login;

        while($ligneRole = mysqli_fetch_row($result)){
            // Redirection vers les pages techniciens
            if ($ligneRole[2] == "Techniciens") {
                mysqli_close($connect);
                header("location: ../techniciens/indexTech.php");
            }
            if ($ligneRole[2] == "ADMIN_WEB") {
                mysqli_close($connect);
                header("location: ../adminweb/indexAdminWeb.php");
            }
            if ($ligneRole[2] == "ADMIN_SYS") {
                mysqli_close($connect);
                header("location: ../sysadmin/indexAdminSys.php");
            }
        }
        //Fermeture base de donnée
        mysqli_close($connect);
        exit(0);
    }

}

//Fermeture base de donnée
mysqli_close($connect);
header("location: pageConnexion.php?error");
