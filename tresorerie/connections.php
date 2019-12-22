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
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trésorerie X3 - Bienvenue BG !</title>
</head>
<link href="minimal-table.css" rel="stylesheet" type="text/css">
<body>
<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='../index.php'"/>
</form>
<br>
<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$response = $bdd->query('SELECT datetime, user_id, users.surnom as surnom_connection from connections join users on connections.user_id = users.Id order by datetime desc limit 100');
echo "<table>";
echo "<tr>";
echo "<td>";
echo "<b>Time stamp</b>";
echo "</td>";
echo "<td>";
echo "<b>ID</b>";
echo "</td>";
echo "<td>";
echo "<b>Surnom</b>";
echo "</td>";
echo "</tr>";

while ($donnees = $response->fetch()) {
    echo "<tr>";
    echo "<td>";
    echo $donnees['datetime'];
    echo "</td>";
    echo "<td>";
    echo $donnees['user_id'];
    echo "</td>";
    echo "<td>";
    echo $donnees['surnom_connection'];
    echo "</td>";
    echo "</tr>";
}
echo '</table>';
?>
</body>
</html>
