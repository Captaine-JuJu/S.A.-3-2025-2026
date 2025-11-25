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
        <li><a href="login.php">Connexion</a></li>
    </ul>
</nav>
    <div id="pageConnexion">
        <div id="connexion">
            <form method="post" action="">

                <label >Identifiants :
                    <input type="text" placeholder="Identifiant"></label>
                <label >Mot de passe : <input type="password" placeholder="Mot de passe"></label>
                <input type="submit" value="Connexion">
            </form>
        </div>
    </div>
</body>
</html>