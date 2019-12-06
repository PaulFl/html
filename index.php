<!DOCTYPE html>
<html>
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#de000a">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <title>X3 le sangg</title>
</head>
<link href="tresorerie/minimal-table.css" rel="stylesheet" type="text/css">

<body>
<p>
    <b>STR</b><br/><br>
<table>
    <tr>
        <td>
            <b>Espace de Zynahpapa: </b><br><br>
            <a href="tresorerie/add_transaction.php">Nouvelle dépenses</a><br><br>
            <a href="phpmyadmin">Données trésorerie</a><br><br>
            <a href="tresorerie/worst_debts.php">Dettes</a><br><br>
            <a href="tresorerie/connections.php">Stats</a>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $resultat = $bdd->query('SELECT COUNT(id) as qty from transactions');
            $transactions_qty = $resultat->fetch()['qty'];
            $resultat = $bdd->query('SELECT SUM(montant) as somme from transactions');
            $transactions_sum = $resultat->fetch()['somme'];
            $transactions_sum = round($transactions_sum, 2);
            echo $transactions_qty . ' dettes pour ' . $transactions_sum . '€';
            ?>
        </td>
    </tr>
</table>
<br><br>
<b> Cliques sur la photo pour parler business...</b> <br><br>
<?php
$i = 0;
$path = "x3_photos";
$ext = "jpeg";
$extra = "alt=\"Random Image\" float=\"left\"";
$imgs = [];
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if (substr($file, strlen($file) - 4, 4) == $ext) {
            $imgs[$i++] = $file;
        }
    }
    closedir($handle);
    $today = getdate();
    srand($today['mday'] + $today['mon']);

    $r = rand(0, $i - 1);

    echo "<a href=\"tresorerie/login.php\"><img src=\"x3_photos/{$imgs[$r]}\" style=\"max-width:100%;\" alt=\"Etage roi\"/>";

}
?>
<!--<a href="tresorerie/login.php"><img src="zahfy.jpg" style="max-width:100%;" alt="Etage roi"/>-->
</body>
</html>
