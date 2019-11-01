<!DOCTYPE html>
<html>
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#de000a">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trésorerie X3 - Infos modifiées</title>
</head>
<link href="minimal-table.css" rel="stylesheet" type="text/css">
<body>
<p>Récapitulatif<br></p>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

echo "<b>Ton Id: </b>";
echo "<input type=\"text\" name=\"user_id\" value='" . $_POST['user_id'] . "' readonly/>";
echo "<br>";
echo "<b>Prénom: </b>";
echo "<input type=\"text\" name=\"prenom\" value='" . $_POST['prenom'] . "'readonly/>";
echo "<br>";
echo "<b>Nom: </b>";
echo "<input type=\"text\" name=\"nom\" value='" . $_POST['nom'] . "'readonly/>";
echo "<br>";
echo "<b>Surnom: </b>";
echo "<input type=\"text\" name=\"surnom\" value='" . $_POST['surnom'] . "' readonly/>";
echo "<br>";
echo "<b>Adresse mail: </b>";
echo "<input type=\"text\" name=\"mail_address\" value='" . $_POST['mail_address'] . "'readonly/>";
echo "<br>";
echo "<b>Numéro de tel: </b>";
echo "<input type=\"text\" name=\"phone_number\" value='" . $_POST['phone_number'] . "'readonly/>";
echo "<br>";
echo "<b>Catégorie: </b>";
echo "<input type=\"text\" name=\"cat\" value='" . $_POST['cat'] . "' readonly/>";
echo "<br>";
echo "<b>Mot de passe: </b>";
echo "<input type=\"text\" name=\"password\" value='" . $_POST['password'] . "'readonly/>";
echo "<br>";


$bdd->exec("UPDATE users SET nom = '" . $_POST['nom'] . "', prenom = '" . $_POST['prenom'] . "', mail_address = '" . $_POST['mail_address'] . "', phone_number = '" . $_POST['phone_number'] . "', password = '" . $_POST['password'] . "' WHERE Id = '" . $_POST['user_id'] . "'");

?>

<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='login.php'"/>
</form>



</body>
</html>
