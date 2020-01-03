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
    <title>Trésorerie X3 - Nouvelle transaction</title>
</head>
<link href="minimal-table.css" rel="stylesheet" type="text/css">
<body>
<p>Récapitulatif<br></p>
<?php
date_default_timezone_set('Europe/Paris');
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

echo "Motif: " . $_POST['title'] . "<br>";

echo "Date: " . $_POST['date'] . "<br>";

$reponse = $bdd->query('SELECT surnom FROM users order by surnom');
$nombre_consommateurs = 0;
$prix_personne = 0.0;


while ($donnees = $reponse->fetch()) {
    if (isset($_POST[$donnees['surnom']])) {
        $nombre_consommateurs = $nombre_consommateurs + $_POST["coef_" . $donnees['surnom']];
    }
}
$reponse = $bdd->query("SELECT id from users where surnom = '" . $_POST['creancier'] . "'");
$creancier = $reponse->fetch()['id'];
echo "Nom du créancier: ";
echo $_POST['creancier'];
echo "<br>";
echo "Id du créancier: ";
echo $creancier;
echo "<br>";
echo "Nombre de consommateurs: ";
echo $nombre_consommateurs;
echo "<br>";
echo "Consommateurs: ";
$reponse = $bdd->query('SELECT surnom, id FROM users order by surnom');
while ($donnees = $reponse->fetch()) {
    if (isset($_POST[$donnees['surnom']])) {
        echo $donnees['surnom'];
        echo " (Id: ";
        echo $donnees['id'];
        echo ")";
        echo " (Coef: ";
        echo $_POST["coef_" . $donnees['surnom']];
        echo ") - ";
    }
}
echo "<br>";
echo "Montant total: ". $_POST['montant'] .'€<br>';
$prix_personne = $_POST['montant'] / $nombre_consommateurs;
$prix_personne = round($prix_personne, 2, PHP_ROUND_HALF_UP);
echo "Montant par personne: " . $prix_personne . "€<br>";


$reponse = $bdd->query('SELECT surnom, id FROM users');
while ($donnees = $reponse->fetch()) {
    if (isset($_POST[$donnees['surnom']]) && $donnees['id'] != $creancier) {
        $prix_a_payer = $prix_personne * $_POST["coef_" . $donnees['surnom']];
        $prix_a_payer = round($prix_a_payer, 2, PHP_ROUND_HALF_UP);
        $bdd->exec("INSERT INTO transactions (creancier, debiteur, montant, motif, date) values (" . $creancier . ", " . $donnees['id'] . ', ' . $prix_a_payer . ", '" . $_POST['title'] . "', '" . $_POST['date'] .  "')");

        $response = $bdd->query('Select transactions.Id from transactions order by  transactions.Id desc limit 1');
        $last_transac = $response->fetch();
        $bdd->exec("INSERT INTO logs (datetime, user_id, transaction_id, action) values ('" . date('Y-m-d H:i:s') . "', " . 0 . ", " . $last_transac['Id'] . ", 'add')");

    }
}
echo "<br>";
echo "ENREGISTRÉ, NE PAS RAFRAICHIR LA PAGE";

?>

<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='../index.php'"/>
</form>



</body>
</html>
