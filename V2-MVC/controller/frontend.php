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
    $chapter = getChapter($_GET['chapter']);
    $comments = getComments($_GET['chapter']);
    require('view/frontend/chapterView.php');
}