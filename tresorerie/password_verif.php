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
    
    echo $resultat['prenom'] . ' ' . $resultat['nom'] . ', (' .  $surnom . ')' . '<br /><br /><br />';
    
    //Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = $_POST['password'] == $resultat['password'];
    
    if (!$resultat)
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }
    else
    {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $pseudo;
            echo 'Bienvenue BG !';
        }
        else {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    }
    
//    <form>
//    <input type="button" value="Put Your Text Here" onclick="window.location.href='http://www.hyperlinkcode.com/button-links.php'" />
//    </form>
    
    ?>
