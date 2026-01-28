<?php
    include("fragments/headers.html");
    include_once("");
?>
<header>
    <h1>Statistique du site</h1>
</header>
<?php
    include("fragments/menu.html");
?>
    <div id="container">
        <div id="statistiques">
            <h2>Statistiques des connexions</h2>
            <div id="connexions">
                <label>Moyenne de temp de connexion : 
                <?php
                    echo "6h";
                ?>
                </label>
                <label>Temps de connexion médian : 
                <?php
                    echo "4h";
                ?>
                </label>
		<label>Moyenne des temps de connexion:
		<?php
		    echo "3h";
		?>
		</label>
		<label> Cumule des connexions:
		<?php
		    echo "56h";
		?>
		</label>

		<label>
		</label>
            </div>
        </div>
    </div>
<?php
    include("fragments/footers.html");
?>
