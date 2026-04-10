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
<div class="container">
    <div class="inventaires">
<h1>Journal d'activité 3</h1>
<?php
$logFile = '/var/log/auth.log';
$lines = file($logFile);
$rows = array_reverse($allLines = array_slice($lines, -80));
?>
    <table class="ssh-table">
	<thead>
            <tr>
                <th>Date / Heure</th>
                <th>Action & Méthode</th>
                <th>Utilisateur</th>
                <th>Source (IP)</th>
                <th>Port</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $line):
                if (strpos($line, 'sshd') === false) continue;

                $event = "";
		$method = "";
		$user = "-";
		$ip = "-";
		$port = "-";

                if (strpos($line, 'Accepted') !== false) {
                    $event = "Accepted";
                } elseif (strpos($line, 'Failed') !== false) {
                    $event = "Failed";
                } elseif (strpos($line, 'session closed') !== false) {
                    $event = "Closed";
                } else { continue; }

                if (preg_match('/(password|publickey)/', $line, $m)) {
		    $method = strtoupper($m[1]);
		}
                if (preg_match('/for (?:invalid user )?(\S+)/', $line, $m)) {
		    $user = $m[1];
		}
                if (preg_match('/from ([\d\.]+)/', $line, $m)) {
		    $ip = $m[1];
		}
                if (preg_match('/port (\d+)/', $line, $m)) {
		    $port = $m[1];
		}

                $date = str_replace('T', ' ', substr($line, 0, 16));
		$rowClass = ($event == "Accepted") ? "row-success" : (($event == "Failed") ? "row-danger" : "row-closed");
            ?>
            <tr class="<?php echo $rowClass; ?>">
                <td class="col-date"><?php echo $date; ?></td>
                <td class="col-action">
                    <div class="fusion-badge">
                        <span class="event-name"><?php echo $event; ?></span>
                        <?php if($method): ?>
                            <span class="method-name"><?php echo $method; ?></span>
                        <?php endif; ?>
                    </div>
                </td>
                <td class="col-user"><?php echo $user; ?></td>
                <td class="col-ip"><?php echo $ip; ?></td>
                <td class="col-port"><?php echo $port; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
</div>
</div>

<?php
include_once("../fragments/footers.html");
?>
