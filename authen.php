<?php
session_start();
include("connexion.php");

function authentification($roleAttendu) {

    if(!isset($_SESSION["login"]) || !isset($_SESSION["role"])){
        header("Location: pageConnexion.php?error=nonConnecte");
        exit();
    }

    if($_SESSION["role"] !== $roleAttendu){
        header("Location: pageConnexion.php?error=accesDenie");
        exit();
    }
}
