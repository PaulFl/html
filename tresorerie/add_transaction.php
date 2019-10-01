<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trésorerie X3 - Nouvelle transaction</title>
</head>
<body>
<p>Nouvelle dépense: </p>
<form action="transaction_to_db.php" method="post">
    <p>
        Date:
        <input type="date" name="date"/>
        <br>
        Motif:
        <input type="text" name="title"/>
        <br>
        Montant:
        <input type="number" step="0.01" name="montant"/>
        <br><br>
        Qui a payé:
        <select name="creancier">
            <?php
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            $reponse = $bdd->query('SELECT surnom FROM users order by surnom');
            while ($donnees = $reponse->fetch()) {
                echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
            }
            echo "</select><br><br>";

            $reponse = $bdd->query('SELECT surnom FROM users order by surnom');
            while ($donnees = $reponse->fetch()) {
                echo "<input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
            }
            ?>
        </select>
        <br>
        <br>
        <input type="submit" value="Ça part"/>
    </p>
</form>
</body>
</html>
