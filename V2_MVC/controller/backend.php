<?php

require_once ('model/backend/ChapterManager.php');
require_once ('model/backend/CommentManager.php');
require_once ('model/backend/UserManager.php');

use V2_MVC\Model\Backend\ChapterManager;
use V2_MVC\Model\Backend\CommentManager;
use V2_MVC\Model\Backend\UserManager;

// Dashbord
function dashbord()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getLastChapter();
    $comment = $commentManager->getLastComment();
    require('view/backend/indexView.php');
}
// Liste des Chapitres
function adminListChapters()
{
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getChapters();

    require('view/backend/listChaptersView.php');
}
// Liste des commentaires
function adminListComments()
{
    $commentManager = new CommentManager();

    $comments = $commentManager->getAllComments();
    require ('view/backend/ListCommentsView.php');
}
// Liste des commentaires signalés
function adminCommentsReport()
{
    $commentManager = new CommentManager();

    $reportComments = $commentManager->getReportComments();
    require ('view/backend/reportCommentsView.php');
}
// Chapitre + commentaires
function adminChapter()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $comments = $commentManager->getComments($_GET['id_chapter']);
    require ('view/backend/chapterView.php');
}
// Page nouveau chapitre
function adminNewChapter()
{
    require ('view/backend/newChapterView.php');
}
// Ajouter un chapitre
function postChapter($author, $title, $content)
{
    $chapterManager = new ChapterManager();
    $createChapter = $chapterManager->createChapter($author, $title, $content);

    header('Location: ../V2_MVC/index.php?action=adminListChapters');
}
// Page d'édition d'un chapitre
function adminUpdateChapter()
{
    $chapterManager = new ChapterManager();
    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    require ('view/backend/updateChapterView.php');
}
// Editer un chapitre
function updateChapter($id_chapter, $author, $title, $content)
{
    $chapterManager = new ChapterManager();
    $updateChapter = $chapterManager->updateChapter($id_chapter, $author, $title, $content);

    if($updateChapter === false)
    {
        throw new Exception('Impossible de mettre à jour le chapitre' );
    }
    else
    {
        header('Location: ../V2_MVC/index.php?action=adminListChapters');
    }
}
// Supprimer un chapitre
function deleteChapter($id_chapter)
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $deleteChapter = $chapterManager->deleteChapter($id_chapter);
    $deleteComments = $commentManager->deleteComments($id_chapter);

    if($deleteChapter === false)
    {
        throw new Exception('Impossible de supprimer le chapitre' );
    }
    elseif ($deleteComments === false)
    {
        throw new Exception('Impossible de supprimer les commentaire du chapitre' );
    }
    else
    {
        header('Location: ../V2_MVC/index.php?action=adminListChapters');
    }
}
// Page d'édition d'un commentaire
function adminUpdateComment()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $comment = $commentManager->getComment($_GET['id']);
    require ('view/backend/updateCommentView.php');
}
// Editer un commentaire
function updateComment($id_comment, $id_chapter, $author, $comment)
{

    $commentManager = new CommentManager();

    $updateComment = $commentManager->updateComment($id_comment, $id_chapter, $author, $comment);

    if($updateComment === false)
    {
        throw new Exception('Impossible de mettre à jour le commentaire' );
    }
    else
    {
        header('Location: ../V2_MVC/index.php?action=adminChapter&id_chapter=' . $id_chapter );
        //header('Location: ../V2_MVC/index.php?action=dashbord' );
    }
}
// Supprimer un commentaire
function deleteComment($id_comment)
{
    $commentManager = new CommentManager();

    $deleteComment = $commentManager->deleteComment($id_comment);

    if($deleteComment === false)
    {
        throw new Exception('Impossible de supprimer le commentaire' );
    }
    else
    {
        header('Location: ../V2_MVC/index.php?action=dashbord' );
    }
}
// Approuver un commentaire (retirer le signalement)
function approvedComment()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $reportComment = $commentManager->approvedComment($_GET['id']);

    header('Location: ../V2_MVC/index.php?action=adminCommentsReport');

}
// Modérer un commentaire signalé
function moderateComment()
{

}
// Liste des membres
function adminListUsers()
{
    $userManager = new UserManager();
    $users = $userManager->getAllUsers();
    require ('view/backend/listUsersView.php');
}
// Page d'ajout membre
function adminNewUser()
{
    require ('view/backend/newUserView.php');
}
// Ajouter un membre
function adminAddUser($id_group, $pseudo, $password_hache, $email)
{
    $userManager = new UserManager();
    $addUser = $userManager->createUser($id_group, $pseudo, $password_hache, $email);
    if($addUser === false)
    {
        throw new Exception('Impossible d\'inscrire le nouvel utilisateur');
    }
    else
    {
        header('Location: ../V2_MVC/index.php?action=adminListUsers');
    }
}
// Editer un membre
function adminUpdateUser()
{
    $userManager = new UserManager();
    $user = $userManager->getUser($_GET['id_user']);
    require ('view/backend/updateUserView.php');
}

function updateUser($id, $id_group, $pseudo, $pass, $email, $firstname, $surname, $birthday)
{
    $userManager = new UserManager();
    $updateUser = $userManager->updateUser($id, $id_group, $pseudo, $pass, $email, $firstname, $surname, $birthday);
    if($updateUser === false)
    {
        throw new Exception('Impossible d\'éditer l\'utilisateur');
    }
    else
    {
        header('Location: ../V2_MVC/index.php?action=adminListUsers');
    }
}
// Supprimer un membre
function deleteUser($id)
{
    $userManager = new UserManager();
    $deleteUser = $userManager->deleteUser($id);
    if($deleteUser === false)
    {
        throw new Exception('Impossible de supprimer l\'utilisateur' );
    }
    else
    {
        header('Location: ../V2_MVC/index.php?action=adminListUsers');
    }
}