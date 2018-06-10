<?php

require_once('model/ChapterManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

use V3\Model\ChapterManager;
use V3\Model\CommentManager;
use V3\Model\UserManager;

// Home
function home()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getLastChapter();
    $comment = $commentManager->getLastComment();
    require('view/frontend/indexView.php');
}
// liste des chapitres
function listChapters()
{
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getChapters();
    require('view/frontend/listChaptersView.php');
}
// A propos de l'auteur
function aboutAuthor()
{
    require('view/frontend/aboutView.php');
}
// lire un chapitre + ses commentaires
function chapter($id_chapter)
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($id_chapter);
    $comments = $commentManager->getComments($id_chapter);
    require('view/frontend/chapterView.php');
}
// Ajouter un commentaire
function addComment($id_chapter, $author, $comment)
{
    $commentManager = new CommentManager();

    $postComment = $commentManager->createComment($id_chapter, $author, $comment);
    if($postComment === false)
    {
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else{
        header('Location: ../V3/index.php?action=chapter&id_chapter=' . $id_chapter);
    }
}
// Page pour modifier un commentaire
function userUpdateComment()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $comment = $commentManager->getCommentById($_GET['id']);
    require ('view/frontend/updateCommentView.php');
}
// Editer un commentaire
function editComment($id_comment, $id_chapter, $author, $comment)
{

    $commentManager = new CommentManager();

    $updateComment = $commentManager->updateComment($id_comment, $id_chapter, $author, $comment);

    if($updateComment === false)
    {
        throw new Exception('Impossible de mettre à jour le commentaire' );
    }
    else
    {
        header('Location: ../V3/index.php?action=chapter&id_chapter=' . $id_chapter );
        //header('Location: ../V3/index.php?action=dashbord' );
    }
}
// Signaler un commentaire
function reportingComment()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $reportComment = $commentManager->reportComment($_GET['id']);

    header('Location: ../V3/index.php?action=chapter&id_chapter=' . $_GET['id_chapter']);
}
// Page de connexion / inscription
function login()
{
    require('view/frontend/loginView.php');
}
// Connexion
function logUser($pseudo, $pass)
{
    $userManager = new UserManager();

    $user = $userManager->getUser($pseudo);
    $proper_pass = password_verify($_POST['pass'], $user['pass']);

    if(!$user)
    {
        throw new Exception('Wrong username or/and password');
    }
    else{
        if($proper_pass && $user['id_group'] == 2)
        {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['pass'] = $user['pass'];
                $_SESSION['id_group'] = $user['id_group'];

                $id = $user['id'];
                $pseudo = $user['pseudo'];
                $pass_hash = $user['pass'];
                $group = $user['id_group'];

                setcookie('id', $id, time() + 1800, null, null, false, true);
                setcookie('pseudo', $pseudo, time() + 1800, null, null, false, true);
                setcookie('pass', $pass_hash, time() + 1800, null, null, false, true);
                setcookie('id_group', $group, time() + 1800, null, null, false, true);

                header('Location: ../V3/index.php');
        }
        elseif($proper_pass && $user['id_group'] == 1)
            {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['pass'] = $user['pass'];
                $_SESSION['id_group'] = $user['id_group'];

                $id = $user['id'];
                $pseudo = $user['pseudo'];
                $pass_hash = $user['pass'];
                $group = $user['id_group'];

                setcookie('id', $id, time() + 1800, null, null, false, true);
                setcookie('pseudo', $pseudo, time() + 1800, null, null, false, true);
                setcookie('pass', $pass_hash, time() + 1800, null, null, false, true);
                setcookie('id_group', $group, time() + 1800, null, null, false, true);

                header('Location: ../V3/index.php?action=dashbord');
            }
        else
        {
            throw new Exception('Wrong Username or Password');
        }
    }
}
// Inscription
function registerUser($id_group, $pseudo, $password_hache, $email){

    $userManager = new UserManager();
    $registerUser = $userManager->createUser($id_group, $pseudo, $password_hache, $email);
    if($registerUser === false)
    {
        throw new Exception('Impossible d\'inscrire le nouvel utilisateur');
    }
    else
    {
        header('Location: ../V3/index.php');
    }
}
// Deconnexion
function logoutUser()
{
    session_start();
    // Suppression des variables de session et de la session
    $_SESSION = array();
    session_destroy();

    // Suppression des cookies de connexion automatique
    setcookie('id', '');
    setcookie('pseudo', '');
    setcookie('pass', '');
    setcookie('id_group', '');


    header('Location: ../V3/index.php');
}