<?php

// Récupérer le dernier chapitre
function getLastChapter()
{
    $db = dbConnect();

    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 1');
    return $req;
}

// Récupérer tous les chapitres
function getChapters()
{
    $db = dbConnect();

    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 5');
    return $req;
}

// Récupérer un chapitre via son id
function getChapter($id_chapter)
{
    $db = dbConnect();

    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters WHERE id = ?');
    $req->execute(array($id_chapter));
    $chapter = $req->fetch();

    return $chapter;
}

// Récupérer le dernier commentaire
function getLastComment()
{
    $db = dbConnect();

    $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 1');
    return $comment;
}

// Récupération des commentaires d'un chapitre
function getComments($id_chapter)
{
    $db = dbConnect();

    $comments = $db->prepare('SELECT id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id_chapter = ? ORDER BY comment_date DESC');
    $comments->execute(array($id_chapter));

    return $comments;
}

// Poster un commentaire
function postComment($id_chapter, $author, $comment)
{
    $db = dbConnect();

    $comments = $db->prepare('INSERT INTO comments (id_chapter, author, comment, comment_date) VALUES( ?, ?, ?, NOW())');
    $postComment = $comments->execute(array($id_chapter, $author, $comment));

    return $postComment;
}

// Connexion à la database
function dbConnect()
{
    $host = 'localhost';
    $database = 'projet4';
    $username = 'root';
    $password = 'root';
    $db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $db;
}
