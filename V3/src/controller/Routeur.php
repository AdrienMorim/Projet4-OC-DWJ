<?php

namespace Alaska\Src\Controller;

require('Autoload.php');

/*
require('ChapterController.php');
require('CommentController.php');
require('DashbordController.php');
require('IndexController.php');
require('UserController.php');
require('ViewController.php');
*/

use \Exception;

/**
 * Class Routeur
 * @package Alaska\Src\Controller
 */
class Routeur
{
    /**
     * @var     ChapterController
     * @var     CommentController
     * @var     DashbordController
     * @var     IndexController
     * @var     UserController
     * @var     ViewController
     */
    private $_chapterCtrl, $_commentCtrl, $_dashbordCtrl, $_indexCtrl, $_userCtrl, $_viewCtrl;

    /**
     * Routeur constructor.
     * Méthode magique car automatiquement appelé dès l'instanciation de Routeur
     * Permet d'instancier automatiquement les controller
     */
    public function __construct()
    {
        Autoload::register();
        $this->_chapterCtrl = new ChapterController();
        $this->_commentCtrl = new CommentController();
        $this->_dashbordCtrl = new DashbordController();
        $this->_indexCtrl = new IndexController();
        $this->_userCtrl = new UserController();
        $this->_viewCtrl = new ViewController();
    }

    /**
     * Methode qui permet, si les conditions sont réunis, d'afficher l'url demandée.
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
                        $this->_dashbordCtrl->dashbord();
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
                        $this->_commentCtrl->adminUpdateComment($_GET['id_chapter'], $_GET['id']);
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
                    elseif ($_GET['action'] == 'updateGroup')
                    {
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0)
                        {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $id_group = $_POST['id_group'];
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['id_group'])) {
                                $this->_userCtrl->updateGroupUser($id, $id_group);
                            }
                            else{
                                throw new Exception('Aucun changement de niveau d\'administration');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updatePseudo'){
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $pseudo = htmlspecialchars($_POST['pseudo']);
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['pseudo'])) {
                                $this->_userCtrl->updatePseudoUser($id, $pseudo);
                            }else{
                                throw new Exception('Le champ doit être rempli !');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updatePass') {
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            // Hachage du mot de passe
                            $password_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['password']) && !empty($_POST['password_confirm'])) {
                                // On vérifie que les 2 mots de passe sont identiques.
                                if ($_POST['password'] == $_POST['password_confirm']) {
                                    $this->_userCtrl->updatePassUser($id, $password_hache);
                                } else {
                                    throw new Exception('Les 2 mots de passe ne sont pas identiques, recommencez !');
                                }
                            } else{
                                throw new Exception('Au moins un des deux champs est vide, veuillez remplir les deux, merci.');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updateName'){
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $firstname = htmlspecialchars($_POST['firstname']);
                            $surname = htmlspecialchars($_POST['surname']);
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['firstname']) && !empty($_POST['surname'])){
                                $this->_userCtrl->updateNameUser($id, $firstname, $surname);
                            } else{
                                throw new Exception('Au moins un des deux champs est vide, veuillez remplir les deux, merci.');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updateEmail'){
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $email = htmlspecialchars($_POST['email']);
                            // On vérifie la Regex pour l'adresse email
                            if (!empty($_POST['email'])) {
                                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
                                {
                                    $this->_userCtrl->updateEmailUser($id, $email);
                                }
                                else
                                {
                                    throw new Exception('L\'adresse email ' . $email . ' n\'est pas valide, recommencez !');
                                }
                            }else{
                                throw new Exception('Le champ doit être rempli !');
                            }

                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updateBirthday'){
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $birthday = htmlspecialchars($_POST['birthday_date']);
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['birthday_date'])){
                                $this->_userCtrl->updateBirthdayUser($id, $birthday);
                            }else{
                                throw new Exception('Le champ doit être rempli !');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
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

                    // Deconnexion
                    elseif ($_GET['action'] == 'logout')
                    {
                        $this->_userCtrl->logoutUser();
                    }
                }
                // Retourne au Dashbord.
                else
                {
                    $this->_dashbordCtrl->dashbord();
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
                                $this->_commentCtrl->reportingComment($_GET['id_chapter'], $_GET['id']);
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
                        $this->_commentCtrl->adminUpdateComment($_GET['id_chapter'], $_GET['id']);
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
                    // Profil de l'utilisateur
                    elseif ($_GET['action'] == 'adminUpdateUser')
                    {
                        $this->_userCtrl->adminUpdateUser();
                    }
                    // Editer le profil utilisateur
                    elseif ($_GET['action'] == 'updateGroup')
                    {
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0)
                        {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $id_group = $_POST['id_group'];
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['id_group'])) {
                                $this->_userCtrl->updateGroupUser($id, $id_group);
                            }
                            else{
                                throw new Exception('Aucun changement de niveau d\'administration');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updatePseudo'){
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $pseudo = htmlspecialchars($_POST['pseudo']);
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['pseudo'])) {
                                $this->_userCtrl->updatePseudoUser($id, $pseudo);
                            }else{
                                throw new Exception('Le champ doit être rempli !');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updatePass') {
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            // Hachage du mot de passe
                            $password_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['password']) && !empty($_POST['password_confirm'])) {
                                // On vérifie que les 2 mots de passe sont identiques.
                                if ($_POST['password'] == $_POST['password_confirm']) {
                                    $this->_userCtrl->updatePassUser($id, $password_hache);
                                } else {
                                    throw new Exception('Les 2 mots de passe ne sont pas identiques, recommencez !');
                                }
                            } else{
                                throw new Exception('Au moins un des deux champs est vide, veuillez remplir les deux, merci.');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updateName'){
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $firstname = htmlspecialchars($_POST['firstname']);
                            $surname = htmlspecialchars($_POST['surname']);
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['firstname']) && !empty($_POST['surname'])){
                                $this->_userCtrl->updateNameUser($id, $firstname, $surname);
                            } else{
                                throw new Exception('Au moins un des deux champs est vide, veuillez remplir les deux, merci.');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updateEmail'){
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $email = htmlspecialchars($_POST['email']);
                            // On vérifie la Regex pour l'adresse email
                            if (!empty($_POST['email'])) {
                                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
                                {
                                    $this->_userCtrl->updateEmailUser($id, $email);
                                }
                                else
                                {
                                    throw new Exception('L\'adresse email ' . $email . ' n\'est pas valide, recommencez !');
                                }
                            }else{
                                throw new Exception('Le champ doit être rempli !');
                            }

                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
                        }
                    }
                    elseif ($_GET['action'] == 'updateBirthday'){
                        if (isset($_GET['id_user']) && $_GET['id_user'] > 0) {
                            // Sécurité
                            $id = $_GET['id_user'];
                            $birthday = htmlspecialchars($_POST['birthday_date']);
                            //On vérifie que les champs ne sont pas vides
                            if (!empty($_POST['birthday_date'])){
                                $this->_userCtrl->updateBirthdayUser($id, $birthday);
                            }else{
                                throw new Exception('Le champ doit être rempli !');
                            }
                        }else{
                            throw new Exception('L\'utilisateur n\'existe pas !');
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
                                $this->_commentCtrl->reportingComment($_GET['id_chapter'], $_GET['id']);
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
                        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                            $this->_userCtrl->logUser($_POST['pseudo'], $_POST['password']);
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
     * @param $errorMessage         Renvoi un message d'erreur dans la vue
     */
    public function getErreur($errorMessage)
    {
        require('src/view/frontend/errorView.php');
    }
}