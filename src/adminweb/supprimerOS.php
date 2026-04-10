<?php
include_once("../connexion.php");

if (isset($_POST["nomOS"])) {
    $OS = $_POST["nomOS"];

    $stmt = mysqli_prepare($connect, "DELETE FROM os WHERE nom = ?");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $OS);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ajoutInformation.php?suppression_reussie");
            exit();
        } else {
            header("Location: ajoutInformation.php?suppression_erreur");
            exit();
        }
        mysqli_stmt_close($stmt);
    }
}
