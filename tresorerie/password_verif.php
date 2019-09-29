<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Bienvenue BG !</title>
 <body>
 <?php
     try
     {
         $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
     }
     catch(Exception $e)
     {
         die('Erreur : '.$e->getMessage());
     }
     
     $surnom = $_POST['user'];
     
     //Récupération de l'utilisateur et de son pass hashé
     $req = $bdd->prepare('SELECT surnom, password, nom, prenom FROM users WHERE surnom = "'. $surnom . '"');
     $req->execute(array(
                         'user' => $user));
     $resultat = $req->fetch();
     
     
     
     //Comparaison du pass envoyé via le formulaire avec la base
     $isPasswordCorrect = $_POST['password'] == $resultat['password'];
     
     if (!$resultat)
     {
         echo 'Il y a un problème, appelle Zynahpapa !';
     }
     else
     {
         if ($isPasswordCorrect) {
             session_start();
             $_SESSION['id'] = $resultat['id'];
             $_SESSION['pseudo'] = $pseudo;
             echo $resultat['prenom'] . ' ' . $resultat['nom'] . ', (' .  $surnom . ')' . '<br /><br /><br />';
             echo 'Bienvenue BG !';
         }
         else {
             echo 'Il y a un problème, appelle Zynahpapa !';
         }
     }
     

     
     ?>
    <form>
    <br>
    <input type="button" value="Deconnexion" onclick="window.location.href='login.php'" />
    </form>
 
 </body>
 </html>
