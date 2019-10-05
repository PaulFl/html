<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bienvenue BG !</title>
<link href="minimal-table.css" rel="stylesheet" type="text/css">
<body>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$surnom = $_POST['user'];

//Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT surnom, password, nom, prenom, phone_number, mail_address, cat, id FROM users WHERE surnom = "' . $surnom . '"');
$req->execute(array(
    'user' => $surnom));
$resultat = $req->fetch();


//Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = $_POST['password'] == $resultat['password'];

if (!$resultat) {
    echo 'Il y a un problème, appelle Zynahpapa !';
} else {
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $resultat['surnom'];
        echo $resultat['prenom'] . ' ' . $resultat['nom'] . '  (' . $surnom . ') - ' . '  (Id: ' . $resultat['id'] . ') - ' . $resultat['cat'] . ' - ' . $resultat['phone_number'] . ' - ' . $resultat['mail_address'] . '<br /><br /><br />';
        echo 'Bienvenue BG ! <br><br>';

        echo "Tes dettes: <br>";
        echo "<table>";
        $reponse = $bdd->query('SELECT transactions.id as transacid, transactions.motif, transactions.date, transactions.montant, transactions.debiteur, users.id, users.surnom, users.phone_number FROM transactions JOIN users on transactions.creancier = users.id where transactions.debiteur = ' . $resultat['id']);

        echo "<tr>";
        echo "<td>";
        echo "Id";
        echo "</td>";
        echo "<td>";
        echo "DATE";
        echo "</td>";
        echo "<td>";
        echo "MOTIF";
        echo "</td>";
        echo "<td>";
        echo "MONTANT";
        echo "</td>";
        echo "<td>";
        echo "CREANCIER";
        echo "</td>";
        echo "<td>";
        echo "SON NUMERO";
        echo "</td>";
        echo "</tr>";

        while ($donnees = $reponse->fetch()) {
            echo "<tr>";
            echo "<td>";
            echo $donnees['transacid'];
            echo "</td>";
            echo "<td>";
            echo $donnees['date'];
            echo "</td>";
            echo "<td>";
            echo $donnees['motif'];
            echo "</td>";
            echo "<td>";
            echo $donnees['montant'] . "€";
            echo "</td>";
            echo "<td>";
            echo $donnees['surnom'];
            echo "</td>";
            echo "<td>";
            echo $donnees['phone_number'];
            echo "</td>";
            echo "</tr>";
        }
        echo "</table><br><br>";

        echo "Tes créances: <br>";
        echo "<table>";
        $reponse = $bdd->query('SELECT transactions.id as transacid, transactions.motif, transactions.date, transactions.montant, transactions.creancier, transactions.debiteur, users.id, users.surnom, users.phone_number FROM transactions JOIN users on transactions.debiteur = users.id where transactions.creancier = ' . $resultat['id']);

        echo "<tr>";
        echo "<td>";
        echo "Id";
        echo "</td>";
        echo "<td>";
        echo "DATE";
        echo "</td>";
        echo "<td>";
        echo "MOTIF";
        echo "</td>";
        echo "<td>";
        echo "MONTANT";
        echo "</td>";
        echo "<td>";
        echo "DEBITEUR";
        echo "</td>";
        echo "<td>";
        echo "SON NUMERO";
        echo "</td>";
        echo "<td>";
        echo "PAYÉ ?";
        echo "</td>";
        echo "</tr>";

        while ($donnees = $reponse->fetch()) {
            echo "<tr>";
            echo "<td>";
            echo $donnees['transacid'];
            echo "</td>";
            echo "<td>";
            echo $donnees['date'];
            echo "</td>";
            echo "<td>";
            echo $donnees['motif'];
            echo "</td>";
            echo "<td>";
            echo $donnees['montant'] . "€";
            echo "</td>";
            echo "<td>";
            echo $donnees['surnom'];
            echo "</td>";
            echo "<td>";
            echo $donnees['phone_number'];
            echo "</td>";
            echo "<td>";
            echo "<form action=\"delete_transaction.php\" method=\"post\"><input type=\"submit\" value=\"Payé ! Id: " . $donnees['transacid'] . "\" name=\"" . 6 . "\"/></form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";

    } else {
        echo 'Il y a un problème, appelle Zynahpapa !';
    }
}


?>
<form>
    <br>
    <input type="button" value="Deconnexion" onclick="window.location.href='login.php'"/>
</form>

</body>
</html>
