<!DOCTYPE html>
<html lang="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trésorerie X3 - Confirmation suppression</title>
<body>

<?php
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
    <input type="button" value="Retour" onclick="window.location.href='login.php'"/>
</form>





</body>
</html>
