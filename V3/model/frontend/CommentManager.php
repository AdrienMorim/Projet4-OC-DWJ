<?php

namespace V3\Model\Frontend;

require_once('model/frontend/Manager.php');

/**
 * Class CommentManager
 * @package V3\Model\Frontend
 */
class CommentManager extends Manager
{
    /**
     * @return bool|\PDOStatement
     */
    public function getLastComment()
    {
        $db = $this->dbConnect();

        $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 1');
        return $comment;
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

    /**
     * @param $id_chapter
     * @param $author
     * @param $comment
     * @return bool
     */

    public function getComment($id_comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments WHERE id= ?');
        $comments->execute(array($id_comment));
        $comment = $comments->fetch();

        return $comment;
    }

    public function postComment($id_chapter, $author, $comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('INSERT INTO comments (id_chapter, author, comment, comment_date) VALUES( ?, ?, ?, NOW())');
        $postComment = $comments->execute(array($id_chapter, $author, $comment));

        return $postComment;
    }

    public function reportComment($id_comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE comments SET reporting= :reporting WHERE id= :id_comment');
        $comments->bindValue(':reporting', 1, \PDO::PARAM_INT);
        $comments->bindParam(':id_comment', $id_comment, \PDO::PARAM_INT);
        $report = $comments->execute();
        //$comments = $db->prepare('UPDATE comments SET reporting= ? WHERE id= ?');
        //$report = $comments->execute(array($reporting, $id_comment));

        return $report;
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
}