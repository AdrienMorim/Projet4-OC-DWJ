<?php

//require('model/frontend.php');
require_once('model/ChapterManager.php');
require_once('model/CommentManager.php');

use V2_MVC\Model\ChapterManager;
use V2_MVC\Model\CommentManager;

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