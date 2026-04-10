<?php
include_once("../connexion.php");

if (isset($_POST["numS"])) {
    $num = $_POST["numS"];

    $stmt = mysqli_prepare($connect, "DELETE FROM Monitors WHERE num_serie = ?");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $num);
      
        if (mysqli_stmt_execute($stmt)) {
            header("Location: technicien_ecran.php?status=succes");
        } else {
            header("Location: technicien_ecran.php?status=erreur_sql");
        }
        
        mysqli_stmt_close($stmt);
    } else {
        header("Location: technicien_ecran.php?status=erreur_prep");
    }
} else {
    header("Location: technicien_ecran.php");
}
exit();
