<?php

namespace V3\Controller;

require('Autoload.php');

/*
require('ChapterController.php');
require('CommentController.php');
require('DashboardController.php');
require('IndexController.php');
require('UserController.php');
require('ViewController.php');
*/

use \Exception;

class Routeur
{
    /**
     * @var     ChapterController
     * @var     CommentController
     * @var     DashboardController
     * @var     IndexController
     * @var     UserController
     * @var     ViewController
     */
    private $_chapterCtrl, $_commentCtrl, $_dashboardCtrl, $_indexCtrl, $_userCtrl, $_viewCtrl;

    /**
     * Routeur constructor.
     * Méthode magique car automatiquement appelé dès l'instanciation de Routeur
     */
    public function __construct()
    {
        Autoload::register();
        $this->_chapterCtrl = new ChapterController();
        $this->_commentCtrl = new CommentController();
        $this->_dashboardCtrl = new DashboardController();
        $this->_indexCtrl = new IndexController();
        $this->_userCtrl = new UserController();
        $this->_viewCtrl = new ViewController();
    }

    /**
     *
     */
    public function getRequest()
    {
        try{
            // SI ADMIN
            if(isset($_SESSION['id']) && $_SESSION['id_group'] == 1)
            {
                if (isset($_GET['action']) && !empty($_GET['action']))
                {
                    // ADMIN - Dashbord
                    if ($_GET['action'] == 'dashbord')
                    {
                        $this->_dashboardCtrl->dashbord();
                    }
                    // ADMIN - Liste des commentaires
                    elseif ($_GET['action'] == 'adminListComments')
                    {
                        $this->_commentCtrl->adminListComments();
                    }
                    // ADMIN - Liste des commentaires signalés
                    elseif ($_GET['action'] == 'adminCommentsReport')
                    {
                        $this->_commentCtrl->adminCommentsReport();
                    }
                    // ADMIN - Creation d'un chapitre
                    elseif ($_GET['action'] == 'createChapter')
                    {
                        if ($_POST['author'] != NULL && $_POST['title'] != NULL && $_POST['content'] != NULL)
                        {
                            $this->_chapterCtrl->postChapter($_POST['author'], $_POST['title'], $_POST['content']);
                        }
                        else
                        {
                            throw new Exception('Tous les champs ne sont pas remplis..');
                        }
                    }
                    // ADMIN - page de MAJ d'un chapitre
                    elseif ($_GET['action'] == 'adminUpdateChapter')
                    {
                        $this->_chapterCtrl->adminUpdateChapter();
                    }
                    // ADMIN - Mise à jour d'un chapitre
                    elseif ($_GET['action'] == 'updateChapter')
                    {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                        {
                            if ($_POST['author'] != NULL && $_POST['title'] != NULL && $_POST['content'] != NULL)
                            {
                                $this->_chapterCtrl->updateChapter($_GET['id_chapter'], $_POST['author'], $_POST['title'], $_POST['content']);
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
                            $this->_chapterCtrl->deleteChapter($_GET['id_chapter']);
                        }
                        else
                        {
                            throw new Exception('Aucun identifiant de chapitre envoyé !');
                        }
                    }
                    // ADMIN - page de MAJ des commentaires
                    elseif ($_GET['action'] == 'adminUpdateComment')
                    {
                        $this->_commentCtrl->adminUpdateComment();
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
                                    $this->_commentCtrl->updateComment($_GET['id'], $_GET['id_chapter'], $_POST['author'], $_POST['comment']);
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
                            $this->_commentCtrl->deleteComment($_GET['id']);
                        }
                        else
                        {
                            throw new Exception('Aucun identifiant de commentaire envoyé !');
                        }
                    }
                    // ADMIN - Approuver un commentaire (retirer le signalement)
                    elseif ($_GET['action'] == 'approvedComment')
                    {
                        $this->_commentCtrl->approvedComment();
                    }
                    // ADMIN - Liste des utilisateurs
                    elseif ($_GET['action'] == 'adminListUsers')
                    {
                        $this->_userCtrl->adminListUsers();
                    }
                    // ADMIN - Page de MAJ du membre
                    elseif ($_GET['action'] == 'adminUpdateUser')
                    {
                        $this->_userCtrl->adminUpdateUser();
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
                                    $this->_userCtrl->updateUser($id, $id_group, $pseudo, $password_hache, $email, $firstname, $surname, $birthday);
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
                            $this->_userCtrl->deleteUser($_GET['id_user']);
                        }
                        else
                        {
                            throw new Exception('Aucun identifiant d\'utilisateur envoyé !');
                        }
                    }
                    // Accueil Visiteur
                    elseif ($_GET['action'] == 'home')
                    {
                        $this->_indexCtrl->home();
                    }
                    // ADMIN - Page pour créer un chapitre
                    elseif ($_GET['action'] == 'adminNewChapter')
                    {
                        $this->_viewCtrl->adminNewChapter();
                    }
                    // À propos de l'auteur
                    elseif ($_GET['action'] == 'about')
                    {
                        $this->_viewCtrl->aboutAuthor();
                    }
                    // Liste des chapitres
                    elseif ($_GET['action'] == 'listChapters')
                    {
                        $this->_chapterCtrl->listChapters();
                    }
                    // Affiche le chapitre avec ses commentaires
                    elseif ($_GET['action'] == 'chapter')
                    {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                        {
                            $this->_chapterCtrl->chapter($_GET['id_chapter']);
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
                                $this->_commentCtrl->addComment($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
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
                                $this->_commentCtrl->reportingComment();
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
                        $this->_viewCtrl->login();
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
                                    $this->_userCtrl->registerUser(2, $pseudo, $password_hache, $email);
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
                            $this->_userCtrl->logUser($_POST['pseudo'], $_POST['pass']);
                        }
                        else
                        {
                            throw new Exception('Tous les champs doivent être remplis !');
                        }
                    }
                    // Deconnexion
                    elseif ($_GET['action'] == 'logout')
                    {
                        $this->_userCtrl->logoutUser();
                    }
                }
                // Retourne au Dashbord.
                else
                {
                    $this->_dashboardCtrl->dashbord();
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
                        $this->_indexCtrl->home();
                    }
                    // À propos de l'auteur
                    elseif ($_GET['action'] == 'about') {
                        $this->_viewCtrl->aboutAuthor();
                    }
                    // Liste des chapitres
                    elseif ($_GET['action'] == 'listChapters') {
                        $this->_chapterCtrl->listChapters();
                    }
                    // Affiche le chapitre avec ses commentaires
                    elseif ($_GET['action'] == 'chapter')
                    {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                            $this->_chapterCtrl->chapter($_GET['id_chapter']);
                        } else {
                            throw new Exception('Aucun identifiant de chapitre envoyé !');
                        }
                    }
                    // Ajoute un commentaire dans le chapitre selectionné
                    elseif ($_GET['action'] == 'addComment')
                    {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                                $this->_commentCtrl->addComment($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
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
                                $this->_commentCtrl->reportingComment();
                            } else {
                                throw new Exception('Aucun identifiant de commentaire envoyé pour pouvoir le signaler!');
                            }
                        } else {
                            throw new Exception('Aucun identifiant de chapitre envoyé pour revenir sur la page précédente!');
                        }
                    }
                    // Page de MAJ des commentaires
                    elseif ($_GET['action'] == 'adminUpdateComment')
                    {
                        $this->_commentCtrl->adminUpdateComment();
                    }
                    // Mise à jour d'un commentaire
                    elseif ($_GET['action'] == 'updateComment')
                    {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
                        {
                            if (isset($_GET['id']) && $_GET['id'] > 0)
                            {
                                if ($_POST['author'] != NULL && $_POST['comment'] != NULL)
                                {
                                    $this->_commentCtrl->updateComment($_GET['id'], $_GET['id_chapter'], $_POST['author'], $_POST['comment']);
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
                        $this->_viewCtrl->login();
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
                                    $this->_userCtrl->registerUser(2, $pseudo, $password_hache, $email);
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
                            $this->_userCtrl->logUser($_POST['pseudo'], $_POST['pass']);
                        } else {
                            throw new Exception('Tous les champs doivent être remplis !');
                        }
                    }
                    // Deconnexion
                    elseif ($_GET['action'] == 'logout')
                    {
                        $this->_userCtrl->logoutUser();
                    }
                }
                // Retourne à l'index
                else
                {
                    $this->_indexCtrl->home();
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
                        $this->_indexCtrl->home();
                    }
                    // À propos de l'auteur
                    elseif ($_GET['action'] == 'about') {
                        $this->_viewCtrl->aboutAuthor();
                    }
                    // Liste des chapitres
                    elseif ($_GET['action'] == 'listChapters') {
                        $this->_chapterCtrl->listChapters();
                    }
                    // Affiche le chapitre avec ses commentaires
                    elseif ($_GET['action'] == 'chapter') {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                            $this->_chapterCtrl->chapter($_GET['id_chapter']);
                        } else {
                            throw new Exception('Aucun identifiant de chapitre envoyé !');
                        }
                    }
                    // Ajoute un commentaire dans le chapitre selectionné
                    elseif ($_GET['action'] == 'addComment') {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                                $this->_commentCtrl->addComment($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
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
                                $this->_commentCtrl->reportingComment();
                            } else {
                                throw new Exception('Aucun identifiant de commentaire envoyé pour pouvoir le signaler!');
                            }
                        } else {
                            throw new Exception('Aucun identifiant de chapitre envoyé pour revenir sur la page précédente!');
                        }
                    }
                    // Page de connexion
                    elseif ($_GET['action'] == 'login') {
                        $this->_viewCtrl->login();
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
                                    $this->_userCtrl->registerUser(2, $pseudo, $password_hache, $email);
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
                            $this->_userCtrl->logUser($_POST['pseudo'], $_POST['pass']);
                        } else {
                            throw new Exception('Tous les champs doivent être remplis !');
                        }
                    }
                    // Deconnexion
                    elseif ($_GET['action'] == 'logout') {
                        $this->_userCtrl->logoutUser();
                    }
                }
                // Retourne à l'index.
                else
                {
                    $this->_indexCtrl->home();
                }
            }

        }
        catch (Exception $e)
        {
            $this->getErreur($e->getMessage());

        }
    }

    /**
     * @param $errorMessage
     */
    public function getErreur($errorMessage)
    {
        require('view/frontend/errorView.php');
    }
}