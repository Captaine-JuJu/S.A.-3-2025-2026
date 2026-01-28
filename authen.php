<?php
session_start();
include("connexion.php");

/**
 * La fonction permet de verifier que le role de la session correspond bien au role attendu sur la page
 * @param $roleAttendu
 * @return void
 */
function authentification($roleAttendu) {

    //Si l'user tente d'acceder a une page sans session le redirige vers la page login
    if(!isset($_SESSION["login"]) || !isset($_SESSION["role"])){
        header("Location: ../pageConnexion.php?nonConnecte");
        exit();
    }

    //si l'user tente de se connecter a une page qui ne correspond pas a son role le renvoie sur la memem page avec un
    //pop up accesDenied
    if($_SESSION["role"] !== $roleAttendu){
        $provenance = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;

        if ($provenance ) {
            $separateur = (strpos($provenance, "?") !== false) ? "&" : "?";
            header("location: " . $provenance . $separateur . "forbidden=1");
        } else {

            $home = [
                "Techniciens" => "../techniciens/indexTech.php",
                "ADMIN_WEB" => "../adminweb/indexAdminWeb.php",
                "ADMIN_SYS" => "../sysadmin/indexAdminSys.php"
            ];

            $destination = $home[$_SESSION['role']] . "?forbidden=1";
            header("location: " . $destination);
        }

        exit();
    }
}
