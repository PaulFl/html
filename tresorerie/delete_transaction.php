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
echo "Id de la transaction: ";
echo $id_a_supprimer;

echo "<form action=\"confirm_delete_transaction.php\" method=\"post\"><input type=\"submit\" value=\"Confirmer la suppression Id: " . $id_a_supprimer . "\" name=\"" . 6 . "\"/></form>";
//$bdd->exec("DELETE from transactions where id=" . $id_a_supprimer);



?>

</body>
</html>
