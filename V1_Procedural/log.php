<?php

    // Connexion à la base de données
    try
    {
        $host = 'localhost';
        $database = 'projet4';
        $username = 'root';
        $password = 'root';
        $db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        echo 'Veuillez patienter.. La base de données n\'est pas encore disponible. <br />';
        die('Erreur : ' . $e->getMessage());
    }

    $req = $db->prepare('SELECT id, pass FROM users WHERE pseudo= :pseudo');
    $req->execute(array(
        'pseudo'=> $_POST['pseudo']
    ));
    $data = $req->fetch();

    $proper_pass = password_verify($_POST['password'], $data['pass']);

    if(!$data)
    {
        echo 'Mauvais identifiant ou mot de passe';
    }
    else
    {
        if($proper_pass)
        {
            session_start();
            $_SESSION['id'] = $data['id'];
            $_SESSION['pseudo'] = $data['pseudo'];

            // redirection
            header( 'Location: index.php');
        }
        else
        {
            echo 'Mauvais identifiant ou mot de passe';
        }
    }