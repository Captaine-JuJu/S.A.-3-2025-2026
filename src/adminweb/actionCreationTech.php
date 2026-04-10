x<?php
// connexion a la base de donnée
include("../connexion.php");

// verification des données du formulaire
if (isset($_POST["login"], $_POST["mdp"], $_POST["mdpVerif"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];
    $mdpVerif = $_POST["mdpVerif"];

    $sql = "SELECT login FROM user WHERE login=?";
    $sqlp = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($sqlp, 's', $login);
    mysqli_stmt_execute($sqlp);
    mysqli_stmt_store_result($sqlp);
    if(mysqli_stmt_num_rows($sqlp) >= 1){
        header("location: ajoutTech.php?deja_existent");
        exit();
    }
    mysqli_stmt_close($sqlp);

    if(strlen($mdp) < 5){
        header("location: ajoutTech.php?mdp_trop_court");
        exit();
    }

    if($mdp !== $mdpVerif){
        header("location: ajoutTech.php?mdp_correspond_pas");
        exit();
    }


    $sqla = "INSERT INTO user (login, password, role) VALUES (?, ?, 'Techniciens')";
    $sqlap = mysqli_prepare($connect, $sqla);

    mysqli_stmt_bind_param($sqlap, 'ss', $login, $mdp);

    if (mysqli_stmt_execute($sqlap)){
        mysqli_close($connect);
        header("location: ajoutTech.php?ajout_reussi");
        exit();
    }
}
//Fermeture de la bd
mysqli_close($connect);
header("location: ajoutTech.php?error");
exit();
