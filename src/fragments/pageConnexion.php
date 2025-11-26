<?php
include("../headers.html");
?>
<title>Connexion</title>
</head>
<body>


<header>
    <h1>Connexion</h1>

</header>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="technicien.php">Gestion</a></li>
        <li><a href="pageConnexion.php">Connexion</a></li>
    </ul>
</nav>
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
</body>
</html>