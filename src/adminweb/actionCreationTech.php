<?php

print_r($_POST);

// connexion au a la base de donnée
$connect = mysqli_connect("192.168.25.15", "root", "sae2025","!sae2025!", "users");
//$connect = mysqli_connect("localhost", "root", "");
$bd = mysqli_select_db($connect, "users");

// verification des données du formulaire
if (isset($_POST["login"], $_POST["mdp"], $_POST["Ajouter"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    // requete SQL sur la table user
    $sql = "SELECT * FROM user";
    // requete SQL préparé
    $sqlp = "SELECT * FROM user WHERE login=?";


    //envoie de la requete à la base de donnée
    $result = mysqli_query($connect, $sql);
    //Prépare requête SQL
    $requete = mysqli_prepare($connect, $sqlp);

    // Vérifie la conformité de la commande
    if ( mysqli_stmt_bind_param($requete, "s", $login)) {
        // lecture ligne par ligne de la table user
        while ($ligne = mysqli_fetch_row($result)) {
            // verification de l'identifiant et du mot de passe en comparant aux données de la table user
            if ($login == $ligne[0]) {
                mysqli_close($connect);
                header("location: ajoutTech.php?creation=deja_existent");
            }
        }
        $sqlc = "INSERT INTO user VALUES ('$login', '$mdp', 'Techniciens')";

        //envoie de la requete à la base de donnée
        $resultc = mysqli_query($connect, $sqlc);

        mysqli_close($connect);

        header("location: ajoutTech.php?creation=ok");
    }
}
//Fermeture ede la bdd
mysqli_close($connect);
header("location: ajoutTech.php?error");
