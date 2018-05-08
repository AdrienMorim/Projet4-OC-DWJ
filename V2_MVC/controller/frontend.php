<?php

//require('model/frontend.php');
require_once('model/frontend/ChapterManager.php');
require_once('model/frontend/CommentManager.php');
require_once('model/frontend/UsersManager.php');

use V2_MVC\Model\Frontend\ChapterManager;
use V2_MVC\Model\Frontend\CommentManager;
use V2_MVC\Model\Frontend\UsersManager;

function lastOne()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getLastChapter();
    $comment = $commentManager->getLastComment();
    require('view/frontend/indexView.php');
}

function listChapters()
{
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getChapters();
    require('view/frontend/listChaptersView.php');
}

function aboutAuthor()
{
    require('view/frontend/aboutView.php');
}

function chapter()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $comments = $commentManager->getComments($_GET['id_chapter']);
    require('view/frontend/chapterView.php');
}

function addComment($id_chapter, $author, $comment)
{
    $commentManager = new CommentManager();

    $postComment = $commentManager->postComment($id_chapter, $author, $comment);
    if($postComment === false)
    {
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else{
        header('Location: ../V2_MVC/index.php?action=chapter&id_chapter=' . $id_chapter);
    }
}

function reportingComment()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $reportComment = $commentManager->reportComment($_GET['id']);

    if($reportComment === true)
    {
        throw new Exception('Le commentaire a déjà été signalé, merci.');
    }
    else
    {
        header('Location: ../V2_MVC/index.php?action=chapter&id_chapter=' . $id_chapter);
    }
}

function login()
{
    require('view/frontend/loginView.php');
}

function logUser($pseudo, $pass)
{
    $userManager = new UsersManager();

    $user = $userManager->getUser($pseudo);
    $proper_pass = password_verify($_POST['pass'], $user['pass']);

    if(!$user)
    {
        throw new Exception('Wrong username or password');
    }
    else{
        if($proper_pass)
        {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];

            header('Location: ../V2_MVC/index.php');
        }
        else
        {
            throw new Exception('Wrong username or password');
        }
    }
}

function registerUser($pseudo, $password_hache, $email){

    $userManager = new UsersManager();
    $registerUser = $userManager->createUser($pseudo, $password_hache, $email);
    if($registerUser === false)
    {
        throw new Exception('Impossible d\'inscrire le nouvel utilisateur');
    }
    else
    {
        header('Location: ../V2_MVC/index.php');
    }
}