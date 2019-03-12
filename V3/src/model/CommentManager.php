<?php

namespace Alaska\Src\Model;

require_once ('src/model/Manager.php');

use \DateTime;
use \PDO;

/**
 * Class CommentManager
 * @package Alaska\Src\Model
 */
class CommentManager extends Manager
{
    /**
     * @var int             $_id_comment         identifiant du commentaire (généré automatiquement par le SGBDR donc pas de setter)
     * @var int             $_id_chapter         identifiant du chapitre de référence
     * @var string          $_author             auteur du commentaire
     * @var string          $_comment            contenu du commentaire
     * @var string          $_comment_date       date de creation du commentaire
     * @var bool||int       $_reporting          signalement d'un commentaire (True || INT(1) / False || 0 par defaut)
     */
    private $_id_comment, $_id_chapter, $_author, $_comment, $_comment_date, $_reporting;

    /**
     * CommentManager constructor.
     * Methode magique car elle est automatiquement appelée lors de l'instanciation de CommentManager
     */
    public function __construct()
    {
        $this->_comment_date = new DateTime('now');
        //$this->_reporting = 1;
    }

    /******************************************************* GETTERS ***************************************************/

    /**
     * @return int              $id_comment
     */
    public function getIdComment()
    {
        return $this->_id_comment;
    }

    /**
     * @return int              $id_chapter
     */
    public function getIdChapter()
    {
        return $this->_id_chapter;
    }

    /**
     * @return string           $author
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * @return string           $comment
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @return string           $comment_date
     */
    public function getCommentDate()
    {
        return $this->_comment_date;
    }

    /**
     * @return bool||int        $reporting
     */
    public function getReporting()
    {
        return $this->_reporting;
    }

    /**************************************************** SETTERS ******************************************************/

    /**
     * @param int           $id_comment
     */
    public function setIdComment($id_comment)
    {
        $id_comment = (int) $id_comment;

        if ($id_comment > 0) {
            $this->_id_comment = $id_comment;
        }
    }

    /**
     * @param int           $id_chapter
     */
    public function setIdChapter($id_chapter)
    {
        $id_chapter = (int) $id_chapter;

        if ($id_chapter > 0) {
            $this->_id_chapter = $id_chapter;
        }
    }

    /**
     * @param string         $author
     */
    public function setAuthor($author)
    {
        if(is_string($author)) {
            $this->_author = $author;
        }
    }

    /**
     * @param string         $comment
     */
    public function setComment($comment)
    {
        if(is_string($comment)) {
            $this->_comment = $comment;
        }
    }

    /**
     * @param string         $comment_date
     */
    public function setCommentDate(DateTime $comment_date)
    {
        $this->_comment_date = $comment_date;
    }

    /**
     * @param bool||int      $reporting
     */
    public function setReporting($reporting)
    {
        $this->_reporting = $reporting;
    }

    /*********************************************** METHODES *********************************************************/

    /**
     * @return bool|\PDOStatement       Récupère les 3 derniers commentaires
     */
    public function getLastComment()
    {
        $db = $this->dbConnect();
        $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 0, 1');
        return $comment;
    }

    /**
     * @return bool|\PDOStatement       Récupère tous les commentaires
     */
    public function getAllComments($start, $comment_per_page)
    {
        $db = $this->dbConnect();
        $allComments = $db->prepare('SELECT id, id_chapter, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT ?, ?');
        $allComments->bindParam(1,$start, PDO::PARAM_INT);
        $allComments->bindParam(2,$comment_per_page, PDO::PARAM_INT);
        $allComments->execute();
        return $allComments;
    }

    /**
     * @return int                      Compte le nombre de commentaires
     */
    public function countComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) AS total_comments FROM comments');
        $req->execute();
        $commentsTotal = $req->fetch();
        return $commentsTotal;
    }

    /**
     * @return bool|\PDOStatement       Récupère tous les commentaires signalés
     */
    public function getReportComments($start, $comment_per_page)
    {
        $db = $this->dbConnect();
        $reportComments = $db->prepare('SELECT id, id_chapter, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments WHERE reporting= ? ORDER BY reporting DESC LIMIT ?, ?');
        $reportComments->bindValue(1, 1,PDO::PARAM_INT);
        $reportComments->bindParam(2,$start, PDO::PARAM_INT);
        $reportComments->bindParam(3,$comment_per_page, PDO::PARAM_INT);
        $reportComments->execute();
        return $reportComments;
    }

    /**
     * @return int                      Compte le nombre de commentaires signalés
     */
    public function countCommentsReport()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS total_comments_report FROM comments WHERE reporting = 1');
        $req->execute();
        $commentsReportTotal = $req->fetch();
        return $commentsReportTotal;
    }

    /**
     * @param int                       $id_chapter
     * @return bool|\PDOStatement       Récupère les commentaires d'un chapitre via son identifiant
     */
    public function getComments($id_chapter)
    {
        $this->setIdChapter($id_chapter);

        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H h %i min %s s\') AS comment_date_fr, DATE_FORMAT(update_date, \'%d/%m/%Y à %H h %i min %s s\') AS update_date_fr FROM comments WHERE id_chapter = ? ORDER BY comment_date DESC');
        $comments->execute(array($this->getIdChapter()));

        return $comments;
    }

    /**
     * @param int                       $id_comment
     * @return mixed                    Récupère un commentaire via son identifiant
     */
    public function getCommentById($id_comment)
    {
        $this->setIdComment($id_comment);

        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments WHERE id= ?');
        $comments->execute(array($this->getIdComment()));
        $comment = $comments->fetch();

        return $comment;
    }

    /**
     * @param                           $id_chapter
     * @param                           $author
     * @param                           $comment
     * @return bool                     Poster un commentaire
     */
    public function createComment($id_chapter, $author, $comment)
    {
        $this->setIdChapter($id_chapter);
        $this->setAuthor($author);
        $this->setComment($comment);

        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments (id_chapter, author, comment, comment_date, update_date) VALUES( ?, ?, ?, NOW(), NOW())');
        $createComment = $comments->execute(array(
            $this->getIdChapter(),
            $this->getAuthor(),
            $this->getComment()
        ));

        return $createComment;
    }

    /**
     * @param                           $id_comment
     * @param                           $id_chapter
     * @param                           $author
     * @param                           $comment
     * @return bool                     Mettre à jour un commentaire via son identifiant
     */
    public function updateComment($id_comment, $id_chapter, $author, $comment)
    {
        $this->setIdComment($id_comment);
        $this->setIdChapter($id_chapter);
        $this->setAuthor($author);
        $this->setComment($comment);

        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET id_chapter= :id_chapter, author= :author, comment= :comment, update_date= NOW() WHERE id= :id_comment');
        $comments->bindParam('id_chapter', $this->getIdChapter(), PDO::PARAM_INT);
        $comments->bindParam('author',$this->getAuthor(), PDO::PARAM_STR);
        $comments->bindParam('comment',$this->getComment(), PDO::PARAM_STR);
        $comments->bindParam('id_comment', $this->getIdComment(), PDO::PARAM_INT);
        $updateComment = $comments->execute();

        return $updateComment;
    }

    /**
     * @param                           $id_comment
     * @return bool                     Supprime un comment via son identifiant
     */
    public function deleteComment($id_comment)
    {
        $this->setIdComment($id_comment);

        $db = $this->dbConnect();
        $comment = $db->prepare('DELETE FROM comments WHERE id= ?');
        $deleteComment = $comment->execute(array($this->getIdComment()));

        return $deleteComment;
    }

    /**
     * @param                           $id_chapter
     * @return bool                     Supprime tous les commentaires d'un chapitre
     */
    public function deleteAllComments($id_chapter)
    {
        $this->setIdChapter($id_chapter);

        $db = $this->dbConnect();
        $comments = $db->prepare('DELETE FROM comments WHERE id_chapter= ?');
        $deleteComments = $comments->execute(array($this->getIdChapter()));

        return $deleteComments;
    }

    /**
     * @param                           $id_comment
     * @return bool                     Signale un commentaire via son identifiant
     */
    public function reportComment($id_comment)
    {
        $this->setIdComment($id_comment);

        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE comments SET reporting= :reporting WHERE id= :id_comment');
        $comments->bindValue(':reporting', 1, \PDO::PARAM_INT);
        $comments->bindParam(':id_comment', $this->getIdComment(), \PDO::PARAM_INT);
        $report = $comments->execute();
        //$comments = $db->prepare('UPDATE comments SET reporting= ? WHERE id= ?');
        //$report = $comments->execute(array($reporting, $id_comment));

        return $report;
    }

    /**
     * @param                       $id_comment
     * @return bool                 Valide un commentaire en retirant son signalement
     */
    public function approvedComment($id_comment)
    {
        $this->setIdComment($id_comment);

        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET reporting= :reporting WHERE id= :id_comment');
        $comments->bindValue(':reporting', 0, \PDO::PARAM_INT);
        $comments->bindParam(':id_comment', $this->getIdComment(), \PDO::PARAM_INT);
        $report = $comments->execute();
        //$comments = $db->prepare('UPDATE comments SET reporting= ? WHERE id= ?');
        //$report = $comments->execute(array($reporting, $this->getIdComment()));

        return $report;
    }
}