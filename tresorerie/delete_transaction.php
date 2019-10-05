<!DOCTYPE html>
<html lang="">
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
$id_a_supprimer = intval(substr($_POST[6], 11))
echo $id_a_supprimer;
$bdd->exec("DELETE from transactions where id=" . $id_a_supprimer);



?>

</body>
</html>
