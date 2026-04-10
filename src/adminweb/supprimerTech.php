<?php
include_once("../connexion.php");

if (isset($_POST["login"])) {
    $login = $_POST["login"];

    if ($login == "tech1") {
        header("Location: ajoutTech.php?suppression_impossible");
        exit();
    }

    $stmt = mysqli_prepare($connect, "DELETE FROM user WHERE login = ?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $login);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ajoutTech.php?suppression_reussie");
            exit(); 
        } else {
            header("Location: ajoutTech.php?suppression_erreur");
	    exit();
        }
        mysqli_stmt_close($stmt);
    }
}
?>
