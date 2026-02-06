<?php

print_r($_POST);

// connexion au a la base de donnée
include_once("connexion.php");

// verification des données du formulaire
if (isset($_POST["login"], $_POST["mdp"], $_POST["Connexion"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    // requete SQL préparé
    $sql = "SELECT * FROM user WHERE login=? AND password=?";
    $sqlp = mysqli_prepare($connect, $sql);

    mysqli_stmt_bind_param($sqlp, 'ss', $login, $mdp);
    mysqli_stmt_execute($sqlp);

    $result = mysqli_stmt_get_result($sqlp);

    // verification de l'identifiant et du mot de passe en comparant aux données de la table user
    if ($user = mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION["login"] = $user["login"];
        $_SESSION["role"] = $user["role"];

        $role = $user["role"];

        date_default_timezone_set("Europe/Paris");
        $date = date("d/m/Y H:i:s");
        echo $login,$role,$date;
        $sql_co = "INSERT INTO log (login,role,date) VALUES (?,?,?)";

        $sqlog = mysqli_prepare($connect, $sql_co);

        if ($sqlog) {
            mysqli_stmt_bind_param($sqlog, 'sss', $login, $role, $date);
            if (mysqli_stmt_execute($sqlog)) {
                echo "Insertion réussie!";
            } else {
                echo "Erreur lors de l'insertion.";
            }
            mysqli_stmt_close($sqlog);
        } else {
            echo "Erreur de préparation de la requête.";
        }

        mysqli_close($connect);

        switch ($role) {
            case "Techniciens":
                header("location: techniciens/indexTech.php");
                break;
            case "ADMIN_WEB":
                header("location: adminweb/indexAdminWeb.php");
                break;
            case "ADMIN_SYS":
                header("location: sysadmin/indexAdminSys.php");
                break;
        }
        exit();
    }
}

//Fermeture base de donnée
mysqli_close($connect);
header("location: pageConnexion.php?error");
