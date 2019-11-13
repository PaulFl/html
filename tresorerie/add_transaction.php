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
    <title>Trésorerie X3 - Nouvelle transaction</title>
</head>
<link href="minimal-table.css" rel="stylesheet" type="text/css">
<body>
<form>
    <br>
    <input type="button" value="Accueil" onclick="window.location.href='../index.php'"/>
</form>
<p><b>Nouvelle dépense: </b></p>
<form action="transaction_to_db.php" method="post">
    <p>
        <b>Date:</b>
        <input type="date" name="date" value="<?php date_default_timezone_set('Europe/Paris'); echo date('Y-m-d'); ?>"/>
        <br>
        <b>Motif:</b>
        <input type="text" name="title"/>
        <br>
        <b>Montant:</b>
        <input type="number" step="0.01" name="montant"/>
        <br><br>
        <b>Qui a payé:</b>
        <select name="creancier">
            <?php
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
            echo "<option disabled>--- 0As ---</option>";
            $reponse = $bdd->query('SELECT surnom, cat from users WHERE cat=\'0A\' order by surnom');
            while ($donnees = $reponse->fetch()) {
                echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
            }
            echo "<option disabled>--- 2As ---</option>";
            $reponse = $bdd->query('SELECT surnom, cat from users WHERE cat=\'2A\' order by surnom');
            while ($donnees = $reponse->fetch()) {
                echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
            }
            echo "<option disabled>--- AFFs ---</option>";
            $reponse = $bdd->query('SELECT surnom, cat from users WHERE cat=\'AFF\' order by surnom');
            while ($donnees = $reponse->fetch()) {
                echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
            }
            echo "<option disabled>--- nAs ---</option>";
            $reponse = $bdd->query('SELECT surnom, cat from users WHERE cat=\'nA\' order by surnom');
            while ($donnees = $reponse->fetch()) {
                echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
            }
            echo "</select><br><br><b>Qui a consommé:</b><br><br>";

            echo "<b>0As:   </b><br>";
            $reponse = $bdd->query("SELECT surnom, cat from users WHERE cat='0A' order by surnom");
            while ($donnees = $reponse->fetch()) {
                echo "<input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
                echo "<input type=\"number\" step=\"1\" name=\"coef_" . $donnees['surnom'] . "\" value='1' placeholder='Coeff' style=\"width: 3em;\"/>";
                echo "&nbsp; &nbsp;";
            }
            echo "<br><b>2As:  </b><br>";
            $reponse = $bdd->query("SELECT surnom, cat from users WHERE cat='2A' order by surnom");
            while ($donnees = $reponse->fetch()) {
                echo "<input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
                echo "<input type=\"number\" step=\"1\" name=\"coef_" . $donnees['surnom'] . "\" value='1' placeholder='Coeff' style=\"width: 3em;\"/>";
                echo "&nbsp; &nbsp;";
            }
            echo "<br><b>AFFs:  </b> <br>";
            $reponse = $bdd->query("SELECT surnom, cat from users WHERE cat='AFF' order by surnom");
            while ($donnees = $reponse->fetch()) {
                echo "<input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
                echo "<input type=\"number\" step=\"1\" name=\"coef_" . $donnees['surnom'] . "\" value='1' placeholder='Coeff' style=\"width: 3em;\"/>";
                echo "&nbsp; &nbsp;";
            }
            echo "<br><b>nAs: </b>  <br>";
            $reponse = $bdd->query("SELECT surnom, cat from users WHERE cat='nA' order by surnom");
            while ($donnees = $reponse->fetch()) {
                echo "<input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
                echo "<input type=\"number\" step=\"1\" name=\"coef_" . $donnees['surnom'] . "\" value='1' placeholder='Coeff' style=\"width: 3em;\"/>";
                echo "&nbsp; &nbsp;";
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
