<?php

namespace V2_MVC\Model\Backend;

require_once ('model/backend/Manager.php');

class CommentManager extends Manager
{
    public function getLastComment()
    {
        $db = $this->dbConnect();

        $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 0, 3');
        return $comment;
    }

    public function getAllComments()
    {
        $db = $this->dbConnect();

        $comments = $db->query('SELECT id, id_chapter, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC');
        return $comments;
    }

    public function getReportComments()
    {
        $db = $this->dbConnect();

        $reportComments = $db->query('SELECT id, id_chapter, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments WHERE reporting= 1 ORDER BY reporting DESC');
        return $reportComments;
    }
    /**
     * @param $id_chapter
     * @return bool|\PDOStatement
     */
    public function getComments($id_chapter)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id_chapter = ? ORDER BY comment_date DESC');
        $comments->execute(array($id_chapter));

        return $comments;
    }

    public function getComment($id_comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments WHERE id= ?');
        $comments->execute(array($id_comment));
        $comment = $comments->fetch();

        return $comment;
    }

    public function createComment($id_chapter, $author, $comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('INSERT INTO comments (id_chapter, author, comment, comment_date) VALUES( ?, ?, ?, NOW())');
        $createComment = $comments->execute(array($id_chapter, $author, $comment));

        return $createComment;
    }

    public function updateComment($id_comment, $id_chapter, $author, $comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE comments SET id_chapter= :id_chapter, author= :author, comment= :comment, comment_date= NOW() WHERE id= :id_comment');
        $comments->bindParam('id_chapter', $id_chapter, \PDO::PARAM_INT);
        $comments->bindParam('author',$author, \PDO::PARAM_STR);
        $comments->bindParam('comment',$comment, \PDO::PARAM_STR);
        $comments->bindParam('id_comment', $id_comment, \PDO::PARAM_INT);
        $updateComment = $comments->execute();

        return $updateComment;
    }

    public function approvedComment($id_comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE comments SET reporting= :reporting WHERE id= :id_comment');
        $comments->bindValue(':reporting', 0, \PDO::PARAM_INT);
        $comments->bindParam(':id_comment', $id_comment, \PDO::PARAM_INT);
        $report = $comments->execute();
        //$comments = $db->prepare('UPDATE comments SET reporting= ? WHERE id= ?');
        //$report = $comments->execute(array($reporting, $id_comment));

        return $report;
    }

    public function deleteComment($id_comment)
    {
        $db = $this->dbConnect();

        $comment = $db->prepare('DELETE FROM comments WHERE id= ?');
        $deleteComment = $comment->execute(array($id_comment));

        return $deleteComment;
    }

    public function deleteComments($id_chapter)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('DELETE FROM comments WHERE id_chapter= ?');
        $deleteComments = $comment->execute(array($id_chapter));

        return $deleteComments;
    }
}