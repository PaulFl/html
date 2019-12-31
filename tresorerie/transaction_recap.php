<!DOCTYPE html>
<html lang="">
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#de000a">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trésorerie X3 - Transaction</title>
</head>
<link href="minimal-table.css" rel="stylesheet" type="text/css">
<body>

<?php
session_start();
date_default_timezone_set('Europe/Paris');
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$transacid = intval($_POST['transacid']);

$response = $bdd->query('SELECT transactions.id, active, motif, date, debiteur, creancier, montant, users_creancier.surnom as surnom_creancier, users_debiteur.surnom as surnom_debiteur from transactions join users as users_creancier on creancier = users_creancier.Id join users as users_debiteur on debiteur = users_debiteur.Id where transactions.Id=' . $transacid);

$donnees = $response->fetch();


echo '<table><tr><td><b>Transaction</b></td></tr><tr><td><b>ID</b></td><td>' . $transacid . '</td></tr>
<tr><td><b>Date</b></td><td>' . $donnees['date'] . '</td></tr>
<tr><td><b>Motif</b></td><td>' . $donnees['motif'] . '</td></tr>
<tr><td><b>Montant</b></td><td>' .$donnees['montant'] . '€</td></tr>
<tr><td><b>Active</b></td><td>' .$donnees['active'] . '</td></tr>
<tr><td><b>Debiteur</b></td><td>' .$donnees['surnom_debiteur'] . '</td></tr>
<tr><td><b>Creancier</b></td><td>' .$donnees['surnom_creancier'] . '</td></tr>'
;
echo '</table>';





?>

<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='activity_log.php'"/>
</form>





</body>
</html>
