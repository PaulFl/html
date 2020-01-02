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
    <title>Trésorerie X3 - Banquiers</title>
</head>
<link href="style-bankers-responsive.css" rel="stylesheet" type="text/css">
<body>
<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='../index.php'"/>
</form>

<h3 style="margin-left: 30px">Créances</h3>
<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$response = $bdd->query('select surnom, round(sum(montant),2) as creances from users join transactions on transactions.creancier = users.Id where transactions.active=1 group by surnom order by creances desc');
echo "<table style='float: left; margin-left: 10px; margin-right: 5px;'>";
echo '<tr><td><b>Actives</b></td></tr>';
echo "<tr>";
echo "<td>";
echo "<b>Surnom</b>";
echo "</td>";
echo "<td>";
echo "<b>Créances</b>";
echo "</td>";
echo "</tr>";

while ($donnees = $response->fetch()) {
    echo "<tr>";
    echo "<td>";
    echo $donnees['surnom'];
    echo "</td>";
    echo "<td>";
    echo $donnees['creances'].'€';
    echo "</td>";
    echo "</tr>";
}
echo '</table>';


echo "<table style='float: left; margin-left: 10px'>";
echo '<tr><td><b>Toutes</b></td></tr>';
echo "<tr>";
echo "<td>";
echo "<b>Surnom</b>";
echo "</td>";
echo "<td>";
echo "<b>Créances</b>";
echo "</td>";
echo "</tr>";

$response = $bdd->query('select surnom, round(sum(montant),2) as creances from users join transactions on transactions.creancier = users.Id group by surnom order by creances desc');

while ($donnees = $response->fetch()) {
    echo "<tr>";
    echo "<td>";
    echo $donnees['surnom'];
    echo "</td>";
    echo "<td>";
    echo $donnees['creances'].'€';
    echo "</td>";
    echo "</tr>";
}
echo '</table>';
?>
</body>
</html>
