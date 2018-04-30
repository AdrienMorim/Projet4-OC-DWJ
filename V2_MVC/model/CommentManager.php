<?php

namespace V2_MVC\Model;

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getLastComment()
    {
        $db = $this->dbConnect();

        $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 1');
        return $comment;
    }

    public function getComments($id_chapter)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id_chapter = ? ORDER BY comment_date DESC');
        $comments->execute(array($id_chapter));

        return $comments;
    }

    public function postComment($id_chapter, $author, $comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('INSERT INTO comments (id_chapter, author, comment, comment_date) VALUES( ?, ?, ?, NOW())');
        $postComment = $comments->execute(array($id_chapter, $author, $comment));

        return $postComment;
    }
}