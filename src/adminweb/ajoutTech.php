<?php
require_once("../authen.php");
authentification("ADMIN_WEB");
include("../fragments/headers.html");
include("../accesDenied.php");
?>
<header>
    <h1>Création Technicien</h1>
</header>
<?php
include("../fragments/menuweb.html");
include("../connexion.php");
?>
<div class="tech">
    <div class="listetech connexion">
        <div class="pageConnexion">
            <div>
                <form method="POST" action="actionCreationTech.php">
                    <label >Creation de l'identifiants :<input name="login" id="login" type="text" placeholder="Identifiant"></label>
                    <label >Création du mot de passe : <input name="mdp" id="mdp" type="password" placeholder="Mot de passe"></label>
                    <label >Création du mot de passe : <input name="mdpVerif" id="mdpVerif" type="password" placeholder="Retaper le mot de passe"></label>
                    <input type="submit" value="Ajouter" name="Ajouter">
                </form>
            </div>
            <?php
            if (isset($_GET['error']))
                echo "Creation impossible";
            else if (isset($_GET['deja_existent']))
                echo "L'identifiant existe deja";
            else if (isset($_GET['mdp_trop_court']))
                echo "Le mot de passe choisi est trop court";
            else if (isset($_GET['mdp_correspond_pas']))
                echo "Les mots de passe ne correspondent pas";
            else if (isset($_GET['ajout_reussi']))
                echo "Creation réussie";
           ?>
       </div>
   </div>
   <div class="listetech connexion">
       <div id="pageConnexion">
           <div id="container">
               <div class="clinventaires">
                    <h3>Liste des techniciens</h3>
                    <?php
                    $sql = "SELECT login, password FROM user;";
                    $result = mysqli_query($connect, $sql);
                    ?>
                    <table id="techniciens">
                        <tr>
                            <th>Identifiant</th>
                            <th>Mot de Passe</th>
                            <th></th>
                       </tr>
                       <?php
                       while ($ligne= mysqli_fetch_row($result)){
                       echo "<tr>";
                       foreach ($ligne as $value){
                           echo "<td>".$value."</td>";
                       }
                       echo "<td><input type='button' name='supprimer' value='supprimer'></td>";
                       echo "</tr>";
                       }
                       ?>
                   </table>
               </div>
           </div>
       </div>
   </div>
</div>
<?php
include("../fragments/footers.html");
?>
