<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trésorerie X3 - Nouvelle transaction</title>
<body>
<p>Récapitulatif<br></p>
<?php
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
        $nombre_consommateurs++;
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
        $bdd->exec("INSERT INTO transactions (creancier, debiteur, montant, motif) values (" . $creancier . ", " . $donnees['id'] . ', ' . $prix_personne . ", '" . $_POST['title'] . "')");
    }
}
echo "<br>";
echo "ENREGISTRÉ, NE PAS RAFRAICHIR LA PAGE";
?>

<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='../index.html'"/>
</form>



</body>
</html>
