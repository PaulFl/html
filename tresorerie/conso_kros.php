<!DOCTYPE html>
<html>
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#de000a">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trésorerie X3 - Consommation kros</title>
</head>
<link href="add-transaction.css" rel="stylesheet" type="text/css">
<body>
<form>
    <br>
    <input type="button" value="Accueil" onclick="window.location.href='../index.php'"/>
</form>
<br>
<b>Consommation kros: </b>
<form action="conso_kros_to_db.php" method="post">

    <label><span><b>Date: </b></span><input type="date" name="date"
                                            value="<?php date_default_timezone_set('Europe/Paris');
                                            echo date('Y-m-d'); ?>"/></label>
    <br>
    <label><span><b>Motif: </b></span><input type="text" name="title" value="Kro"/></label>
    <br>
    <label><span><b>Kros consommées: </b></span><input type="number" step="1" name="kros_consommees"/></label>
    <br><br>


    <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $reponse = $bdd->query('SELECT sum(nb_kros) as stock from achats_kro');
    echo "<b>Kros en stock: ";
    $stock_kros = $reponse->fetch();
    $stock_kros = $stock_kros['stock'];
    echo $stock_kros;
    //   echo "</b><br><br>";
//    echo " <b>Qui a payé:</b>
//        <select name=\"creancier\">";
//    echo "<option disabled>--- 0As ---</option>";
//    $reponse = $bdd->query('SELECT surnom, cat from users WHERE cat=\'0A\' order by surnom');
//    while ($donnees = $reponse->fetch()) {
//        echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
//    }
//    echo "<option disabled>--- 2As ---</option>";
//    $reponse = $bdd->query('SELECT surnom, cat from users WHERE cat=\'2A\' order by surnom');
//    while ($donnees = $reponse->fetch()) {
//        echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
//    }
//    echo "<option disabled>--- AFFs ---</option>";
//    $reponse = $bdd->query('SELECT surnom, cat from users WHERE cat=\'AFF\' order by surnom');
//    while ($donnees = $reponse->fetch()) {
//        echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
//    }
//    echo "<option disabled>--- nAs ---</option>";
//    $reponse = $bdd->query('SELECT surnom, cat from users WHERE cat=\'nA\' order by surnom');
//    while ($donnees = $reponse->fetch()) {
//        echo "<option value='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "</option>";
//    }
    echo "</select><br><br><b>Qui a bu:</b><br><br>";

    echo "<b>0As:   </b><br><table>";
    $reponse = $bdd->query("SELECT surnom, cat from users WHERE cat='0A' order by surnom");
    while ($donnees = $reponse->fetch()) {
        echo "<div class=\"item\">";
        echo "<tr><td><input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
        echo "</td><td><input type=\"number\" step=\"0.01\" name=\"coef_" . $donnees['surnom'] . "\" value='1' placeholder='Coeff' style=\"width: 3em;\"/></td></tr>";
        echo "</div>";
    }
    echo "</table><br><b>2As:  </b><br><table>";
    $reponse = $bdd->query("SELECT surnom, cat from users WHERE cat='2A' order by surnom");
    while ($donnees = $reponse->fetch()) {
        echo "<div class=\"item\">";
        echo "<tr><td><input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
        echo "</td><td><input type=\"number\" step=\"0.01\" name=\"coef_" . $donnees['surnom'] . "\" value='1' placeholder='Coeff' style=\"width: 3em;\"/></td></tr>";
        echo "</div>";
    }
    echo "</table><br><b>AFFs:  </b> <br><table>";
    $reponse = $bdd->query("SELECT surnom, cat from users WHERE cat='AFF' order by surnom");
    while ($donnees = $reponse->fetch()) {
        echo "<div class=\"item\">";
        echo "<tr><td><input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
        echo "</td><td><input type=\"number\" step=\"0.01\" name=\"coef_" . $donnees['surnom'] . "\" value='1' placeholder='Coeff' style=\"width: 3em;\"/></td></tr>";
        echo "</div>";
    }
    echo "</table><br><b>nAs: </b>  <br><table>";
    $reponse = $bdd->query("SELECT surnom, cat from users WHERE cat='nA' order by surnom");
    while ($donnees = $reponse->fetch()) {
        echo "<div class=\"item\">";
        echo "<tr><td><input type='checkbox' name='" . $donnees['surnom'] . "' id='" . $donnees['surnom'] . "'/> <label for='" . $donnees['surnom'] . "'>" . $donnees['surnom'] . "  </label>";
        echo "</td><td><input type=\"number\" step=\"0.01\" name=\"coef_" . $donnees['surnom'] . "\" value='1' placeholder='Coeff' style=\"width: 3em;\"/></td></tr>";
        echo "</div>";
    }
    echo "</table>"
    ?>
    </select>
    <br>
    <br>
    <input onclick="function display_mail_info() {
                document.getElementById('mail_info').textContent = ' Envoi des mails en cours...';
        }
        display_mail_info()" type="submit" value="Ça part"/><br><br>
    <div id="mail_info"></div>
</form>
<br><br><br><br>
</body>
</html>
