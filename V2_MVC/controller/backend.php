<?php

require_once ('model/backend/ChapterManager.php');
require_once ('model/backend/CommentManager.php');

use V2_MVC\Model\Backend\ChapterManager;
use V2_MVC\Model\Backend\CommentManager;

function dashbord()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getLastChapter();
    $comment = $commentManager->getLastComment();
    require('view/backend/indexView.php');
}

function adminListChapters()
{
    $chapterManager = new ChapterManager();
    $chapters = $chapterManager->getChapters();

    require('view/backend/listChaptersView.php');
}

function adminListComments()
{
    $commentManager = new CommentManager();

    $comments = $commentManager->getAllComments();
    require ('view/backend/ListCommentsView.php');
}

function adminCommentsReport()
{
    $commentManager = new CommentManager();

    $reportComments = $commentManager->getReportComments();
    require ('view/backend/reportCommentsView.php');
}

function adminChapter()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $comments = $commentManager->getComments($_GET['id_chapter']);
    require ('view/backend/chapterView.php');
}

function adminNewChapter()
{
    require ('view/backend/newChapterView.php');
}

function postChapter($author, $title, $content)
{
    $chapterManager = new ChapterManager();
    $createChapter = $chapterManager->createChapter($author, $title, $content);

    header('Location: ../V2_MVC/index.php?action=adminListChapters');
}

function adminUpdateChapter()
{
    $chapterManager = new ChapterManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    require ('view/backend/updateChapterView.php');
}

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

function adminUpdateComment()
{
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = $chapterManager->getChapter($_GET['id_chapter']);
    $comment = $commentManager->getComment($_GET['id']);
    require ('view/backend/updateCommentView.php');
}

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