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
        <form method="POST" action="../actionCreationTech.php">
            <label >Creation de l'identifiants :<input name="login" id="login" type="text" placeholder="Identifiant"></label>
            <label >Création du mot de passe : <input name="mdp" id="mdp" type="password" placeholder="Mot de passe"></label>
            <input type="submit" value="Ajouter" name="Ajouter">
        </form>
    </div>
    <?php
    if (isset($_GET['error']))
        echo "Connexion échoué";
    else if (isset($_GET['creation=deja_existent']))
        echo "identifiant déjà existant";
    else if (isset($_GET['creation=ok']))
        echo "creation réussie";
    ?>
</div>
<?php
include("../fragments/footers.html");
?>
