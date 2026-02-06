<?php
include("fragments/headers.html");
?>
    <header>
        <h1>Accueil</h1>
    </header>
    <?php
    include("fragments/menu.html");
    ?>
<div class="pagePresentation">
    <div class="presentation">
        <h2>Présentation de la platforme : </h2>
        <video controls>
            <source src="video.mp4" type="video/mp4">
        </video>
        (placeholder de la vidéo de présentation de la platforme)

        <h3>Gestion</h3>
        <p>
            Page permettant la visualisation de l'inventaire ainsi que l'ajout et le retrait de matériel.
        </p>
        <h3>Connexion</h3>
        <p>
            Page permettant l'identification de l'utilisateur.
        </p>
    </div>
</div>
<?php
include("fragments/footers.html");
?>
