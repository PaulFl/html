<!DOCTYPE html>
<html lang="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trésorerie X3 - Suppression transaction</title>
<body>
<p><b>Récapitulatif</b><br></p>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$id_a_supprimer = intval(substr($_POST[6], 11));
echo "<b>Id de la transaction: </b>";
echo $id_a_supprimer;

$reponse = $bdd->query('SELECT transactions.id as transacid, transactions.motif, transactions.date, transactions.montant, transactions.creancier, transactions.debiteur, users.id, users.surnom, users.phone_number FROM transactions JOIN users on transactions.debiteur = users.id where transactions.id = ' . $id_a_supprimer);
$donnees  = $reponse->fetch();
echo "<br>";
echo "<b>Motif: </b>";
echo $donnees['motif'];
echo "<br>";
echo "<b>Montant: </b>";
echo $donnees['montant'];
echo "<br>";
echo "<b>Surnom: </b>";
echo $donnees['surnom'];
echo "<br>";
echo "<br>";

echo "<form action=\"confirm_delete_transaction.php\" method=\"post\"><input type=\"submit\" value=\"Confirmer la suppression Id: " . $id_a_supprimer . "\" name=\"" . 6 . "\"/></form>";
//$bdd->exec("DELETE from transactions where id=" . $id_a_supprimer);



?>

</body>
</html>
