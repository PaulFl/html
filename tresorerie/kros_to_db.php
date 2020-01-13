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
    <title>Trésorerie X3 - Achat kros</title>
</head>
<link href="minimal-table-responsive.css" rel="stylesheet" type="text/css">
<body>
<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='../index.php'"/>
</form>
<br>
ENREGISTRÉ, NE PAS RAFRAICHIR LA PAGE
<br><br>
<?php
date_default_timezone_set('Europe/Paris');
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$nombre_kros = $_POST['nb_kros'];
$prix_tot = $_POST['montant'];
$prix_unite = round($prix_tot/$nombre_kros, 6, PHP_ROUND_HALF_UP);


$reponse = $bdd->query("SELECT id from users where surnom = '" . $_POST['creancier'] . "'");
$creancier = $reponse->fetch()['id'];



echo '<table><tr><td><b>Récapitulatif</b></td></tr>
<tr><td><b>Date</b></td><td>' . $_POST['date'] . '</td></tr>
<tr><td><b>Créancier</b></td><td>' . $_POST['creancier'] . '</td></tr>
<tr><td><b>Nombre kros</b></td><td>' .$nombre_kros . '</td></tr>
<tr><td><b>Prix total</b></td><td>' .$prix_tot . '€</td></tr>
<tr><td><b>Prix kro</b></td><td>' .$prix_unite . '€</td></tr>';
echo '</table><br><br>';

$bdd->exec("INSERT INTO achats_kro (creancier, nb_kros, prix_kro, datetime) values (" . $creancier . ", " . $nombre_kros . ", " . $prix_unite . ", '" . $_POST['date'] .  "')");

//echo '<table>
//<tr><td><b>Consommateur</b></td><td><b>Coef</b></td><td><b>Montant</b></td><td><b>Id</b></td></tr>';
//
//
//
//
//while ($donnees = $reponse->fetch()) {
//    if (isset($_POST[$donnees['surnom']]) && $donnees['id'] == $creancier) {
//        $prix_a_payer = $prix_personne * $_POST["coef_" . $donnees['surnom']];
//        $prix_a_payer = round($prix_a_payer, 2, PHP_ROUND_HALF_UP);
//        echo '<tr><td>' . $donnees['surnom'] . '</td><td>' . $_POST["coef_" . $donnees['surnom']] . '</td><td>' . $prix_a_payer . '€</td></tr>';
//    }
//}
//
//
//$reponse = $bdd->query('SELECT surnom, id, mail_address FROM users');
//while ($donnees = $reponse->fetch()) {
//    if (isset($_POST[$donnees['surnom']]) && $donnees['id'] != $creancier) {
//        $prix_a_payer = $prix_personne * $_POST["coef_" . $donnees['surnom']];
//        $prix_a_payer = round($prix_a_payer, 2, PHP_ROUND_HALF_UP);
//        $bdd->exec("INSERT INTO transactions (creancier, debiteur, montant, motif, date) values (" . $creancier . ", " . $donnees['id'] . ', ' . $prix_a_payer . ", '" . $_POST['title'] . "', '" . $_POST['date'] .  "')");
//
//        $response = $bdd->query('Select transactions.Id from transactions order by  transactions.Id desc limit 1');
//        $last_transac = $response->fetch();
//        $bdd->exec("INSERT INTO logs (datetime, user_id, transaction_id, action) values ('" . date('Y-m-d H:i:s') . "', " . 0 . ", " . $last_transac['Id'] . ", 'add')");
//
//        $transacid = $last_transac['Id'];
//
//        echo '<tr><td>' . $donnees['surnom'] . '</td><td>' . $_POST["coef_" . $donnees['surnom']] . '</td><td>' . $prix_a_payer . '€</td><td>' . "<form action=\"transaction_recap.php\" method=\"post\"><input type='hidden' name='transacid' value='$transacid'><input disabled type=\"submit\" value=$transacid></form></td></tr>";
//
//        if ($donnees['mail_address'] != ''){
//            $destinataires_mail = $destinataires_mail . $donnees['mail_address'] . ', ';
//        }
//    }
//}
//
//echo '</table>';


//echo '<br>Mails envoyés pour: ' . $destinataires_mail;
//
//$subject = 'Dette trésorerie X3 - Mail auto';
//$message = 'Salut bg, tu as une nouvelle dette à régler envers ' . $_POST['creancier'] . ' (' . $_POST['title'] . '), go sur x3lesang.fleury.io';
//$headers = 'From: paul.fleuryp@gmail.com';
//mail($destinataires_mail,$subject,$message,$headers);

?>





</body>
</html>
