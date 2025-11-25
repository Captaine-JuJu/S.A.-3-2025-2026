<?php

print_r($_POST);

$filename = "données/connections.csv";
$fp = fopen($filename, "r");


if (isset($_POST["login"], $_POST["mdp"])) {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    while (($resultat = fgetcsv($fp))) {

        $log1 = $resultat[0];
        $mdp1 = $resultat[1];

        if ($login == $log1 && $mdp == $mdp1) {
            session_start();
            $_SESSION["login"] = $login;
            header("location: admin.php");
            exit(0);
        }
    }
}
header("location: login.php?error");