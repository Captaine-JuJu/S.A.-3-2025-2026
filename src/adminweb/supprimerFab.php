<?php
include_once("../connexion.php");

if (isset($_POST["nomFab"])) {
    $Fab = $_POST["nomFab"];

    $stmt = mysqli_prepare($connect, "DELETE FROM fabriquant WHERE nom = ?");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $Fab);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ajoutInformation.php?suppression_reussie_Fab");
            exit();
        } else {
            header("Location: ajoutInformation.php?suppression_erreur_Fab");
            exit();
        }
        mysqli_stmt_close($stmt);
    }
}
