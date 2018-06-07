<?php session_start() ?>

<?php

require_once ('controller/Routeur.php');

use \V3\Controller\Routeur;

$_routeur = new Routeur();
$_routeur->getRequete();

/*
require('controller/frontend.php');
require('controller/backend.php');

// Gestion des exception
try{
    // SI ADMIN
    if(isset($_SESSION['id']) && $_SESSION['id_group'] == 1)
    {
        if (isset($_GET['action']) && !empty($_GET['action']))
        {
            // ADMIN - Dashbord
            if ($_GET['action'] == 'dashbord')
            {
                dashbord();
            }
            // ADMIN - Liste des chapitres
            elseif ($_GET['action'] == 'adminListChapters')
            {
                adminListChapters();
            }
            // ADMIN - Liste des commentaires
            elseif ($_GET['action'] == 'adminListComments')
            {
                adminListComments();
            }
            // ADMIN - Commentaires signalés
            elseif ($_GET['action'] == 'adminCommentsReport')
            {
                adminCommentsReport();
            }
            // ADMIN - Chapitre avec ses commentaires
            elseif ($_GET['action'] == 'adminChapter')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                {
                    adminChapter($_GET['id_chapter']);
                }
                else
                {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // ADMIN - Page pour créer un chapitre
            elseif ($_GET['action'] == 'adminNewChapter')
            {
                adminNewChapter();
            }
            // ADMIN - Creation d'un chapitre
            elseif ($_GET['action'] == 'createChapter')
            {
                if ($_POST['author'] != NULL && $_POST['title'] != NULL && $_POST['content'] != NULL)
                {
                    postChapter($_POST['author'], $_POST['title'], $_POST['content']);
                }
                else
                {
                    throw new Exception('Tous les champs ne sont pas remplis..');
                }
            }
            // ADMIN - page de MAJ d'un chapitre
            elseif ($_GET['action'] == 'adminUpdateChapter')
            {
                adminUpdateChapter();
            }
            // ADMIN - Mise à jour d'un chapitre
            elseif ($_GET['action'] == 'updateChapter')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                {
                    if ($_POST['author'] != NULL && $_POST['title'] != NULL && $_POST['content'] != NULL)
                    {
                        updateChapter($_GET['id_chapter'], $_POST['author'], $_POST['title'], $_POST['content']);
                    }
                    else
                    {
                        throw new Exception('Tous les champs ne sont pas remplis..');
                    }
                }
                else
                {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // ADMIN - suppression d'un chapitre
            elseif ($_GET['action'] == 'deleteChapter')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                {
                    deleteChapter($_GET['id_chapter']);
                }
                else
                {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // ADMIN - page de MAJ des commentaires
            elseif ($_GET['action'] == 'adminUpdateComment')
            {
                adminUpdateComment();
            }
            // ADMIN - Mise à jour d'un commentaire
            elseif ($_GET['action'] == 'updateComment')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                {
                    if (isset($_GET['id']) && $_GET['id'] > 0)
                    {
                        if ($_POST['author'] != NULL && $_POST['comment'] != NULL)
                        {
                            updateComment($_GET['id'], $_GET['id_chapter'], $_POST['author'], $_POST['comment']);
                        }
                        else
                        {
                            throw new Exception('Tous les champs ne sont pas remplis..');
                        }
                    }
                    else
                    {
                        throw new Exception('Aucun identifiant de commentaire envoyé !');
                    }

                }
                else
                {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // ADMIN - Supprimer un commentaire
            elseif ($_GET['action'] == 'deleteComment')
            {
                if (isset($_GET['id']) && $_GET['id'] > 0)
                {
                    deleteComment($_GET['id']);
                }
                else
                {
                    throw new Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
            // ADMIN - Approuver un commentaire signaler
            elseif ($_GET['action'] == 'approvedComment')
            {
                approvedComment();
            }
            // ADMIN - Liste des utilisateurs
            elseif ($_GET['action'] == 'adminListUsers')
            {
                adminListUsers();
            }
            // ADMIN - Page d'ajout d'un membre
            elseif ($_GET['action'] == 'adminNewUser')
            {
                adminNewUser();
            }
            // ADMIN - Ajouter un utilisateur
            elseif ($_GET['action'] == 'newUser')
            {
                if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email']) && !empty($_POST['id_group']))
                {
                    // Sécurité
                    $id_group = $_POST['id_group'];
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
                            adminAddUser($id_group, $pseudo, $password_hache, $email);
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
            // ADMIN - Page de MAJ du membre
            elseif ($_GET['action'] == 'adminUpdateUser')
            {
                adminUpdateUser();
            }
            // ADMIN - Editer un utilisateur
            elseif ($_GET['action'] == 'updateUser')
            {
                if (isset($_GET['id_user']) && $_GET['id_user'] > 0)
                {
                    // Sécurité
                    $id = $_GET['id_user'];
                    $id_group = $_POST['id_group'];
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $firstname = htmlspecialchars($_POST['firstname']);
                    $surname = htmlspecialchars($_POST['surname']);
                    $birthday = htmlspecialchars($_POST['birthday_date']);
                    $email = htmlspecialchars($_POST['email']);
                    // Hachage du mot de passe
                    $password_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    // On vérifie la Regex pour l'adresse email
                    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
                    {
                        // On vérifie que les 2 mots de passe sont identiques.
                        if ($_POST['password'] == $_POST['password_confirm']) {
                            updateUser($id, $id_group, $pseudo, $password_hache, $email, $firstname, $surname, $birthday);
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
            }
            // ADMIN - Supprimer un utilisateur
            elseif ($_GET['action'] == 'deleteUser')
            {

                if (isset($_GET['id_user']) && $_GET['id_user'] > 0)
                {
                    deleteUser($_GET['id_user']);
                }
                else
                {
                    throw new Exception('Aucun identifiant d\'utilisateur envoyé !');
                }
            }
            // Accueil Visiteur
            elseif ($_GET['action'] == 'home')
            {
                home();
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
                    chapter($_GET['id_chapter']);
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
            // Signaler un commentaire
            elseif ($_GET['action'] == 'report')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                {
                    if (isset($_GET['id']) && $_GET['id'] > 0)
                    {
                        reportingComment();
                    }
                    else
                    {
                        throw new Exception('Aucun identifiant de commentaire envoyé pour pouvoir le signaler!');
                    }
                }
                else
                {
                    throw new Exception('Aucun identifiant de chapitre envoyé pour revenir sur la page précédente!');
                }
            }
            // Page de connexion
            elseif ($_GET['action'] == 'login')
            {
                login();
            }
            // Inscription
            elseif ($_GET['action'] == 'register')
            {
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
                            registerUser(2, $pseudo, $password_hache, $email);
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
            // Deconnexion
            elseif ($_GET['action'] == 'logout')
            {
                logoutUser();
            }
        }
        // Retourne au Dashbord.
        else
        {
            dashbord();
        }
    }
    // SI USER
    elseif (isset($_SESSION['id']) && $_SESSION['id_group'] == 2)
    {
        if (isset($_GET['action']) && !empty($_GET['action']))
        {
            // Accueil Visiteur
            if ($_GET['action'] == 'home')
            {
                home();
            }
            // À propos de l'auteur
            elseif ($_GET['action'] == 'about') {
                aboutAuthor();
            }
            // Liste des chapitres
            elseif ($_GET['action'] == 'listChapters') {
                listChapters();
            }
            // Affiche le chapitre avec ses commentaires
            elseif ($_GET['action'] == 'chapter')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                    chapter($_GET['id_chapter']);
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // Ajoute un commentaire dans le chapitre selectionné
            elseif ($_GET['action'] == 'addComment')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addComment($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
                    } else {
                        throw new Exception('Tous les champs doivent être remplis !');
                    }
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // Signaler un commentaire
            elseif ($_GET['action'] == 'report')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        reportingComment();
                    } else {
                        throw new Exception('Aucun identifiant de commentaire envoyé pour pouvoir le signaler!');
                    }
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé pour revenir sur la page précédente!');
                }
            }
            // Page de MAJ des commentaires
            elseif ($_GET['action'] == 'userUpdateComment')
            {
                userUpdateComment();
            }
            // Mise à jour d'un commentaire
            elseif ($_GET['action'] == 'editComment')
            {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                {
                    if (isset($_GET['id']) && $_GET['id'] > 0)
                    {
                        if ($_POST['author'] != NULL && $_POST['comment'] != NULL)
                        {
                            editComment($_GET['id'], $_GET['id_chapter'], $_POST['author'], $_POST['comment']);
                        }
                        else
                        {
                            throw new Exception('Tous les champs ne sont pas remplis..');
                        }
                    }
                    else
                    {
                        throw new Exception('Aucun identifiant de commentaire envoyé !');
                    }

                }
                else
                {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // Page de connexion
            elseif ($_GET['action'] == 'login') {
                login();
            }
            // Inscription
            elseif ($_GET['action'] == 'register')
            {
                if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email'])) {
                    // Sécurité
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $email = htmlspecialchars($_POST['email']);
                    // Hachage du mot de passe
                    $password_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    // On vérifie la Regex pour l'adresse email
                    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                        // On vérifie que les 2 mots de passe sont identiques.
                        if ($_POST['password'] == $_POST['password_confirm']) {
                            registerUser(2, $pseudo, $password_hache, $email);
                        } else {
                            throw new Exception('Les 2 mots de passe ne sont pas identiques, recommencez !');
                        }
                    } else {
                        throw new Exception('L\'adresse email ' . $email . ' n\'est pas valide, recommencez !');
                    }
                } else {
                    throw new Exception('Tous les champs doivent être remplis !');
                }
            }
            // Connexion
            elseif ($_GET['action'] == 'log')
            {
                if (!empty($_POST['pseudo']) && !empty($_POST['pass'])) {
                    logUser($_POST['pseudo'], $_POST['pass']);
                } else {
                    throw new Exception('Tous les champs doivent être remplis !');
                }
            }
            // Deconnexion
            elseif ($_GET['action'] == 'logout')
            {
                logoutUser();
            }
        }
        // Retourne à l'index
        else
        {
            home();
        }
    }
    // SI VISITOR
    else
    {
        if (isset($_GET['action']) && !empty($_GET['action']))
        {
            // Accueil Visiteur
            if ($_GET['action'] == 'home')
            {
                home();
            }
            // À propos de l'auteur
            elseif ($_GET['action'] == 'about') {
                aboutAuthor();
            }
            // Liste des chapitres
            elseif ($_GET['action'] == 'listChapters') {
                listChapters();
            }
            // Affiche le chapitre avec ses commentaires
            elseif ($_GET['action'] == 'chapter') {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                    chapter($_GET['id_chapter']);
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // Ajoute un commentaire dans le chapitre selectionné
            elseif ($_GET['action'] == 'addComment') {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addComment($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
                    } else {
                        throw new Exception('Tous les champs doivent être remplis !');
                    }
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé !');
                }
            }
            // Signaler un commentaire
            elseif ($_GET['action'] == 'report') {
                if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        reportingComment();
                    } else {
                        throw new Exception('Aucun identifiant de commentaire envoyé pour pouvoir le signaler!');
                    }
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé pour revenir sur la page précédente!');
                }
            }
            // Page de connexion
            elseif ($_GET['action'] == 'login') {
                login();
            }
            // Inscription
            elseif ($_GET['action'] == 'register') {
                if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email'])) {
                    // Sécurité
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $email = htmlspecialchars($_POST['email']);
                    // Hachage du mot de passe
                    $password_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    // On vérifie la Regex pour l'adresse email
                    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                        // On vérifie que les 2 mots de passe sont identiques.
                        if ($_POST['password'] == $_POST['password_confirm']) {
                            registerUser(2, $pseudo, $password_hache, $email);
                        } else {
                            throw new Exception('Les 2 mots de passe ne sont pas identiques, recommencez !');
                        }
                    } else {
                        throw new Exception('L\'adresse email ' . $email . ' n\'est pas valide, recommencez !');
                    }
                } else {
                    throw new Exception('Tous les champs doivent être remplis !');
                }
            }
            // Connexion
            elseif ($_GET['action'] == 'log') {
                if (!empty($_POST['pseudo']) && !empty($_POST['pass'])) {
                    logUser($_POST['pseudo'], $_POST['pass']);
                } else {
                    throw new Exception('Tous les champs doivent être remplis !');
                }
            }
            // Deconnexion
            elseif ($_GET['action'] == 'logout') {
                logoutUser();
            }
        }
        // Retourne à l'index.
        else
        {
            home();
        }
    }

}
catch (Exception $e)
{
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}
*/
