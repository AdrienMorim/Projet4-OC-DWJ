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

    // Vérification de la validité des informations
    if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['email']))
    {
        // Sécurité
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        // Hachage du mot de passe
        $password_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // On vérifie la Regex pour l'adresse email
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
        {
            // On vérifie que les 2 mots de passe sont identiques.
            if ($_POST['password'] == $_POST['password_confirm'])
            {
                //insertion DB
                $req = $db->prepare('INSERT INTO users(pseudo, pass, email, registration_date) VALUES(:pseudo, :pass, :email, NOW())');
                $req->execute(array(
                    'pseudo' => $pseudo,
                    'pass' => $password_hache,
                    'email' => $email
                ));
            } else {
                echo 'Les 2 mots de passe ne sont pas identiques, recommencez !';
            }

        } else {
            echo 'L\'adresse email ' . $email . ' n\'est pas valide, recommencez !';
        }

        // redirection
        header( 'Location: index.php');
    }