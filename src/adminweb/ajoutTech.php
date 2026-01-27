<?php
include("../fragments/headers.html");
?>
<header>
    <h1>Création Technicien</h1>
</header>
<?php
include("../fragments/menuweb.html");
?>
<div id="pageConnexion">
    <div id="connexion">
        <form method="POST" action="../ajoutdonnee.php">
            <label >Creation de l'identifiants :<input name="login" id="login" type="text" placeholder="Identifiant"></label>
            <label >Création du mot de passe : <input name="mdp" id="mdp" type="password" placeholder="Mot de passe"></label>
            <label >Vérification du mot de passe : <input name="mdp" id="mdpVerif" type="password" placeholder="Retaper le mot de passe"></label>
            <input type="submit" value="Ajouter" name="Ajouter">
        </form>
    </div>
    <?php
    if (isset($_GET['error']))
        echo "Creation échoué";
    else if (isset($_GET['creation=deja_existent']))
        echo "Identifiant déjà existant";
    else if (isset($_GET['creation=ok']))
        echo "Creation réussie";
    ?>
</div>
<?php
include("../fragments/footers.html");
?>
