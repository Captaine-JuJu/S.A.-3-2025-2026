<?php
include("fragments/headers.html");
?>
<header>
    <h1>Connexion</h1>
</header>
<?php
include("fragments/menu.html");
?>
    <div id="pageConnexion">
        <div id="connexion">
            <form method="POST" action="actionLogin.php">

                <label >Identifiants :<input name="login" id="login" type="text" placeholder="Identifiant"></label>
                <label >Mot de passe : <input name="mdp" id="mdp" type="password" placeholder="Mot de passe"></label>
                <input type="submit" value="Connexion" name="Connexion">
            </form>
        </div>
        <?php
        if (isset($_GET['error']))
            echo "Connexion échoué";
        ?>
    </div>
<?php
include("fragments/footers.html");
?>
