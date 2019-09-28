<?php
    
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=x3_tresorerie;charset=utf8', 'x3_tresorerie_website', 'x3trezsafe');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    
    $reponse = $bdd->query('SELECT surnom FROM users LIMIT 0, 10');
    
    echo '<p>Voici les 10 premières entrées de la table users :</p>';
    while ($donnees = $reponse->fetch())
    {
        echo $donnees['nom'] . '<br />';
    }
    
    $reponse->closeCursor();
    
    //  Récupération de l'utilisateur et de son pass hashé
    $req = $bdd->prepare('SELECT surnom, password FROM users WHERE surnom = :user');
    $req->execute(array(
                        'user' => $user));
    $resultat = $req->fetch();

    echo $resultat['password'];
    // Comparaison du pass envoyé via le formulaire avec la base
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
            echo 'Vous êtes connecté !';
        }
        else {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    }
