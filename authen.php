<?php
session_start();
include("connexion.php");

/**
*authentification() verifie que le role associé a l'id de session correspond bien au role attendu sur la page
*@param $roleAttendu
*@return void
*/
function authentification($roleAttendu) {
	
	//si un user tente d'acceder a une page sans login il est redirigé sur la page de connexion
	if(!isset($_SESSION['login']) || !isset($_SESSION['role'])) {
		header("location: ../pageConnexion.php?nonConnecte");
		exit();
	}

	//si un user tente de se connecter a une page qui ne correspond pas a son role, le renvoie sur la page 
	//acceuil de son role avec un pop up acces denied
	if($_SESSION['role'] !== $roleAttendu) {
		$provenance = isset($_SERVER['HTTP_REFER']) ? $_SERVER['HTTP_REFERER'] : null;

		if($provenance) {
			$separateur = (strpos($provenance, '?') !== false) ? '&' : '?';
			header("location: " . $provenance . $separateur . "forbidden=1");
		}else{

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

