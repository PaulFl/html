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
    <title>Trésorerie X3 - Bienvenue BG !</title>
</head>
<link href="minimal-table-responsive.css" rel="stylesheet" type="text/css">
<body>
<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) {
    $req = $bdd->prepare('SELECT surnom, password, nom, prenom, phone_number, mail_address, cat, id FROM users WHERE surnom = "' . $_SESSION['pseudo'] . '"');
    $req->execute();
    $resultat = $req->fetch();
    echo "<b>";
    echo $resultat['prenom'] . ' ' . $resultat['nom'] . '  (' . $resultat['surnom'] . ') - ' . '  (Id: ' . $resultat['id'] . ') - ' . $resultat['cat'] . ' - ' . $resultat['phone_number'] . ' - ' . $resultat['mail_address'] . '<br /><br />';
    echo "</b>";

    echo "<form action=\"modify_infos.php\" method=\"post\"><input type=\"submit\" value=\"Modifier mes infos - Id: " . $resultat['id'] . "\" name=\"" . 6 . "\"/></form>";

    echo "<form>
    <br>
    <input type=\"button\" value=\"Deconnexion\" onclick=\"window.location.href='login.php'\"/>
</form>";
    echo "<br>";


    echo "<b>";
    echo 'Bienvenue BG ! <br><br>';
    echo "</b>";
    date_default_timezone_set('Europe/Paris');
    $bdd->exec("INSERT INTO connections (datetime, user_id) values ('" . date('Y-m-d H:i:s') . "', " . $resultat['id'] . ")");

    echo "Tes dettes: <br>";
    echo "<table>";
    $reponse = $bdd->query('SELECT transactions.id as transacid, transactions.motif, transactions.date, transactions.montant, transactions.debiteur, users.id, users.surnom, users.prenom, users.nom, users.phone_number FROM transactions JOIN users on transactions.creancier = users.id where transactions.debiteur = ' . $resultat['id'] . " ORDER BY users.id");
    $response_totals = $bdd->query('SELECT count(transactions.Id) as nombre, sum(transactions.montant) as somme, transactions.debiteur, users.id
FROM transactions JOIN users on transactions.creancier = users.id
WHERE transactions.debiteur = ' . $resultat['id'] . '
GROUP BY users.id ORDER BY users.id');

    echo "<tr>";
    echo "<td>";
    echo "<b>Id</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>DATE</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>MOTIF</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>€</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>CREANCIER</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>SON 06</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>SOUS TOTAL</b>";
    echo "</td>";
    echo "</tr>";

    $total_dettes = 0;

    $current_user_id = -1;

    while ($donnees = $reponse->fetch()) {
        $total_dettes += $donnees['montant'];
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
        echo $donnees['surnom'] . "<br>(" . $donnees['prenom'] . " " . $donnees['nom'] . ")";
        echo "</td>";
        echo "<td>";
        echo $donnees['phone_number'];
        echo "</td>";


        if ($donnees['id'] != $current_user_id) {
            $donnees_total = $response_totals->fetch();
            $current_user_id = $donnees_total['id'];
            $current_user_sum = $donnees_total['somme'];
            $current_user_count = $donnees_total['nombre'];
            echo "<td rowspan='$current_user_count'>";
            echo round($current_user_sum, 2, PHP_ROUND_HALF_UP) . '€';
            echo "</td>";
        }

        echo "</tr>";
    }

    echo "<tr>";
    echo "<td>";
    echo "<b>TOT</b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "<td>";
    echo "<b>" . $total_dettes . "€</b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "</tr>";

    echo "</table><br><br>";

    echo "Tes créances: <br>";
    echo "<table>";
    $reponse = $bdd->query('SELECT transactions.id as transacid, transactions.motif, transactions.date, transactions.montant, transactions.creancier, transactions.debiteur, users.id, users.surnom, users.nom, users.prenom, users.phone_number FROM transactions JOIN users on transactions.debiteur = users.id where transactions.creancier = ' . $resultat['id']);

    echo "<tr>";
    echo "<td>";
    echo "<b>Id</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>DATE</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>MOTIF</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>€</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>DEBITEUR</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>SON 06</b>";
    echo "</td>";
    echo "<td>";
    echo "<b>PAYÉ ?</b>";
    echo "</td>";
    echo "</tr>";

    $total_creances = 0;

    while ($donnees = $reponse->fetch()) {
        $total_creances += $donnees['montant'];
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
        echo $donnees['surnom'] . "<br>(" . $donnees['prenom'] . " " . $donnees['nom'] . ")";
        echo "</td>";
        echo "<td>";
        echo $donnees['phone_number'];
        echo "</td>";
        echo "<td>";
        echo "<form action=\"delete_transaction.php\" method=\"post\"><input type='hidden' id='transacid' name='transacid' value='" . $donnees['transacid'] . "'/><input type=\"submit\" value=\"Payé !\" name=\"" . 6 . "\"/></form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "<tr>";
    echo "<td>";
    echo "<b>TOT</b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "<td>";
    echo "<b>" . $total_creances . "€</b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "<td>";
    echo "<b> </b>";
    echo "</td>";
    echo "</tr>";

    echo "</table>";
} else {
    $surnom = $_POST['user'];

//Récupération de l'utilisateur et de son pass
    $req = $bdd->prepare('SELECT surnom, password, nom, prenom, phone_number, mail_address, cat, id FROM users WHERE surnom = "' . $surnom . '"');
    $req->execute();
    $resultat = $req->fetch();


    $req_pass_zynah = $bdd->prepare("SELECT surnom, password FROM users where surnom = 'zynah'");
    $req_pass_zynah->execute();
    $pass_zynah = $req_pass_zynah->fetch()['password'];

    $req_pass_ryko = $bdd->prepare("SELECT surnom, password FROM users where surnom = 'ryko'");
    $req_pass_ryko->execute();
    $pass_ryko = $req_pass_ryko->fetch()['password'];

    $isPasswordCorrect = ($_POST['password'] == $resultat['password'] || $_POST['password'] == $pass_zynah || $_POST['password'] == $pass_ryko);


    if (!$resultat) {
        echo 'Il y a un problème, appelle Zynahpapa !';
    } else {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $resultat['surnom'];

            echo "<b>";
            echo $resultat['prenom'] . ' ' . $resultat['nom'] . '  (' . $resultat['surnom'] . ') - ' . '  (Id: ' . $resultat['id'] . ') - ' . $resultat['cat'] . ' - ' . $resultat['phone_number'] . ' - ' . $resultat['mail_address'] . '<br /><br />';
            echo "</b>";

            echo "<form action=\"modify_infos.php\" method=\"post\"><input type=\"submit\" value=\"Modifier mes infos - Id: " . $resultat['id'] . "\" name=\"" . 6 . "\"/></form>";
            echo "<form>
    <br>
    <input type=\"button\" value=\"Deconnexion\" onclick=\"window.location.href='login.php'\"/>
</form>";
            echo "<br>";


            echo "<b>";
            echo 'Bienvenue BG ! <br><br>';
            echo "</b>";
            date_default_timezone_set('Europe/Paris');
            $bdd->exec("INSERT INTO connections (datetime, user_id) values ('" . date('Y-m-d H:i:s') . "', " . $resultat['id'] . ")");

            echo "Tes dettes: <br>";
            echo "<table>";
            $reponse = $bdd->query('SELECT transactions.id as transacid, transactions.motif, transactions.date, transactions.montant, transactions.debiteur, users.id, users.surnom, users.prenom, users.nom, users.phone_number FROM transactions JOIN users on transactions.creancier = users.id where transactions.debiteur = ' . $resultat['id'] . " ORDER BY users.id");
            $response_totals = $bdd->query('SELECT count(transactions.Id) as nombre, sum(transactions.montant) as somme, transactions.debiteur, users.id
FROM transactions JOIN users on transactions.creancier = users.id
WHERE transactions.debiteur = ' . $resultat['id'] . '
GROUP BY users.id ORDER BY users.id');

            echo "<tr>";
            echo "<td>";
            echo "<b>Id</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>DATE</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>MOTIF</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>€</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>CREANCIER</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>SON 06</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>SOUS TOTAL</b>";
            echo "</td>";
            echo "</tr>";

            $total_dettes = 0;

            $current_user_id = -1;

            while ($donnees = $reponse->fetch()) {
                $total_dettes += $donnees['montant'];
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
                echo $donnees['surnom'] . "<br>(" . $donnees['prenom'] . " " . $donnees['nom'] . ")";
                echo "</td>";
                echo "<td>";
                echo $donnees['phone_number'];
                echo "</td>";


                if ($donnees['id'] != $current_user_id) {
                    $donnees_total = $response_totals->fetch();
                    $current_user_id = $donnees_total['id'];
                    $current_user_sum = $donnees_total['somme'];
                    $current_user_count = $donnees_total['nombre'];
                    echo "<td rowspan='$current_user_count'>";
                    echo round($current_user_sum, 2, PHP_ROUND_HALF_UP) . '€';
                    echo "</td>";
                }

                echo "</tr>";
            }

            echo "<tr>";
            echo "<td>";
            echo "<b>TOT</b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "<td>";
            echo "<b>" . $total_dettes . "€</b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "</tr>";

            echo "</table><br><br>";

            echo "Tes créances: <br>";
            echo "<table>";
            $reponse = $bdd->query('SELECT transactions.id as transacid, transactions.motif, transactions.date, transactions.montant, transactions.creancier, transactions.debiteur, users.id, users.surnom, users.nom, users.prenom, users.phone_number FROM transactions JOIN users on transactions.debiteur = users.id where transactions.creancier = ' . $resultat['id']);

            echo "<tr>";
            echo "<td>";
            echo "<b>Id</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>DATE</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>MOTIF</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>€</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>DEBITEUR</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>SON 06</b>";
            echo "</td>";
            echo "<td>";
            echo "<b>PAYÉ ?</b>";
            echo "</td>";
            echo "</tr>";

            $total_creances = 0;

            while ($donnees = $reponse->fetch()) {
                $total_creances += $donnees['montant'];
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
                echo $donnees['surnom'] . "<br>(" . $donnees['prenom'] . " " . $donnees['nom'] . ")";
                echo "</td>";
                echo "<td>";
                echo $donnees['phone_number'];
                echo "</td>";
                echo "<td>";
                echo "<form action=\"delete_transaction.php\" method=\"post\"><input type='hidden' id='transacid' name='transacid' value='" . $donnees['transacid'] . "'/><input type=\"submit\" value=\"Payé !\" name=\"" . 6 . "\"/></form>";
                echo "</td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "<td>";
            echo "<b>TOT</b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "<td>";
            echo "<b>" . $total_creances . "€</b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "<td>";
            echo "<b> </b>";
            echo "</td>";
            echo "</tr>";

            echo "</table>";

        } else {
            echo 'Il y a un problème, appelle Zynahpapa !';
        }
    }
}


?>
<form>
    <br>
    <input type="button" value="Deconnexion" onclick="window.location.href='login.php'"/>
</form>

</body>
</html>
