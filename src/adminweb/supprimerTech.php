<?php
include_once("../connexion.php");

if (isset($_POST["login"])) {
    $login = $_POST["login"];

    if ($login == "tech1") {
        echo "Attention !! Cet utilisateur ne peut pas être supprimé !";
        exit();
    }

    $stmt = mysqli_prepare($connect, "DELETE FROM user WHERE login = ?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $login);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ajoutTech.php?status=succes");
            exit(); 
        } else {
            echo "Erreur lors de la suppression : ";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
