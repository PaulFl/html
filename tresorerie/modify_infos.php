<!DOCTYPE html>
<html lang="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trésorerie X3 - Mes infos</title>
<body>
<form>
    <br>
    <input type="button" value="Retour" onclick="window.location.href='login.php'"/>
</form>
<p><b>Tes infos</b><br></p>

<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$user_id = intval(substr($_POST[6], 25));


$reponse = $bdd->query('SELECT id, nom, prenom, surnom, password, mail_address, phone_number, cat FROM users  where Id = ' . $user_id);

$donnees  = $reponse->fetch();
echo "<form action=\"submit_modify_infos.php\" method=\"post\">";
echo "<b>Ton Id: </b>";
echo "<input type=\"text\" name=\"user_id\" value='" . $user_id . "' readonly/>";
echo "<br>";
echo "<b>Prénom: </b>";
echo "<input type=\"text\" name=\"prenom\" value='" . $donnees['prenom'] . "'/>";
echo "<br>";
echo "<b>Nom: </b>";
echo "<input type=\"text\" name=\"nom\" value='" . $donnees['nom'] . "'/>";
echo "<br>";
echo "<b>Surnom: </b>";
echo "<input type=\"text\" name=\"surnom\" value='" . $donnees['surnom'] . "' readonly/>";
echo "<br>";
echo "<b>Adresse mail: </b>";
echo "<input type=\"text\" name=\"mail_address\" value='" . $donnees['mail_address'] . "'/>";
echo "<br>";
echo "<b>Numéro de tel: </b>";
echo "<input type=\"text\" name=\"phone_number\" value='" . $donnees['phone_number'] . "'/>";
echo "<br>";
echo "<b>Catégorie: </b>";
echo "<input type=\"text\" name=\"cat\" value='" . $donnees['cat'] . "' readonly/>";
echo "<br>";
echo "<b>Mot de passe: </b>";
echo "<input type=\"text\" name=\"password\" value='" . $donnees['password'] . "'/>";
echo "  /!\ Il sera stocké en clair /!\\";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"Ça part\"/>";
echo "</form>";




?>

</body>
</html>
