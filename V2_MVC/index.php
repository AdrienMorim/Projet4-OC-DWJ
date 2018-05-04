<?php

require('controller/frontend.php');
require('controller/backend.php');

// Gestion des exception
try{
    if (isset($_GET['action']))
    {
        // Index
        if($_GET['action'] == '')
        {
            lastOne();
            //require('view/frontend/loginView.php');
        }
        // À propos de l'auteur
        elseif ($_GET['action'] == 'about')
        {
            aboutAuthor();
        }
        // Liste des chapitres
        elseif ($_GET['action'] == 'listChapters')
        {
            listChapters();
        }
        // Affiche le chapitre avec ses commentaires
        elseif ($_GET['action'] == 'chapter')
        {
            if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
            {
                chapter();
            }
            else
            {
                throw new Exception('Aucun identifiant de chapitre envoyé !');
            }
        }
        // Ajoute un commentaire dans le chapitre selectionné
        elseif ($_GET['action'] == 'addComment')
        {
            if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
            {
                if (!empty($_POST['author']) && !empty($_POST['comment']))
                {
                    addComment($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
                }
                else
                {
                    throw new Exception('Tous les champs doivent être remplis !');
                }
            }
            else
            {
                throw new Exception('Aucun identifiant de chapitre envoyé !');
            }
        }
        // Page de connexion
        elseif($_GET['action'] == 'login')
        {
            login();
            //require('view/frontend/loginView.php');
        }
        // Connexion
        elseif ($_GET['action'] == 'log')
        {
            if (!empty($_POST['pseudo']) && !empty($_POST['pass']))
            {
                logUser($_POST['pseudo'], $_POST['pass']);
            }
            else
            {
                throw new Exception('Tous les champs doivent être remplis !');
            }
        }
        // Inscription
        elseif ($_GET['action'] == 'register'){
            if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email']))
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
                        registerUser($pseudo, $password_hache, $email);
                    }
                    else
                    {
                        throw new Exception('Les 2 mots de passe ne sont pas identiques, recommencez !');
                    }
                }
                else
                {
                    throw new Exception('L\'adresse email ' . $email . ' n\'est pas valide, recommencez !');
                }
            }
            else
            {
                throw new Exception('Tous les champs doivent être remplis !');
            }
        }
    }
// Retourne à l'index.
    else
    {
        lastOne();
    }
}
catch (Exception $e)
{
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}
