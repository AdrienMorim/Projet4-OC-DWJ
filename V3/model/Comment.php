<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 21/05/2018
 * Time: 19:08
 */

namespace V3\Model;


class Comment
{
    /**
     * @var int             $id                 identifiant du commentaire (généré automatiquement par le SGBDR donc pas de setter)
     * @var int             $id_chapter         identifiant du chapitre de référence
     * @var string          $author             auteur du commentaire
     * @var string          $comment            contenu du commentaire
     * @var string          $comment_date       date de creation du commentaire
     * @var bool||int       $reporting          signalement d'un commentaire (True || INT / False || 0 par defaut)
     */
    private $id, $id_chapter, $author, $comment, $comment_date, $reporting;

    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdChapter()
    {
        return $this->id_chapter;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getCommentDate()
    {
        return $this->comment_date;
    }

    /**
     * @return bool
     */
    public function getReporting()
    {
        return $this->reporting;
    }

    /**
     * @param int           $id_chapter
     */
    public function setIdChapter($id_chapter)
    {
        $this->id_chapter = $id_chapter;
    }

    /**
     * @param string         $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @param string         $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param string         $comment_date
     */
    public function setCommentDate($comment_date)
    {
        $this->comment_date = $comment_date;
    }

    /**
     * @param bool||int      $reporting
     */
    public function setReporting($reporting)
    {
        $this->reporting = $reporting;
    }
}