<?php

require('model/frontend.php');

function lastOne()
{
    $chapter = getLastChapter();
    $comment = getLastComment();
    require('view/frontend/indexView.php');
}

function listChapters()
{
    $chapters = getChapters();
    require('view/frontend/listChaptersView.php');
}

function chapter()
{
    $chapter = getChapter($_GET['id_chapter']);
    $comments = getComments($_GET['id_chapter']);
    require('view/frontend/chapterView.php');
}

function addComment($id_chapter, $author, $comment)
{
    $postComment = postComment($id_chapter, $author, $comment);
    if($postComment === false)
    {
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else{
        header('Location: ../V2-MVC/index.php?action=chapter&id_chapter=' . $id_chapter);
    }
}