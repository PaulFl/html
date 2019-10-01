<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT surnom FROM users LIMIT 0, 10');

echo '<p>Voici les 10 premières entrées de la table users :</p>';
while ($donnees = $reponse->fetch()) {
    echo $donnees['surnom'] . '<br />';
}

$reponse->closeCursor();

?>
