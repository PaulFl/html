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

echo intval(substr($_POST[6], 11));


?>

</body>
</html>
