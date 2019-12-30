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
    <title>Trésorerie X3 - Confirmation suppression</title>
</head>
<link href="minimal-table.css" rel="stylesheet" type="text/css">
<body>

<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
echo "Transaction (Id: ";
$id_a_supprimer = intval(substr($_POST[6], 29));
echo $id_a_supprimer;
echo ") supprimée";

$bdd->exec("DELETE from transactions where id=" . $id_a_supprimer);

?>

<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='password_verif.php'"/>
</form>





</body>
</html>
