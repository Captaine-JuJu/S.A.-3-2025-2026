<?php
require_once("../authen.php");
authentification("ADMIN_SYS");
include_once("../fragments/headers.html");
include("../accesDenied.php");
?>
<header>
	<h1>Administrateur Système</h1>
</header>
<?php
include_once("../fragments/menuSys.html");
?>
<h1>Journal d'activité 2</h1>


<?php
include_once("../fragments/footers.html");
?>
