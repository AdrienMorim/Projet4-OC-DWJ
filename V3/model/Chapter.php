<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 21/05/2018
 * Time: 19:01
 */

namespace V3\Model;

Use \DateTime;

/**
 * Class Chapter
 * @package V3\Model
 */
class Chapter
{


    /**
     * @var int         $_id                     identifiant du chapitre (généré automatiquement par le SGBDR donc pas de setter)
     * @var string      $_title                  titre du chapitre
     * @var string      $_author                 auteur du chapitre
     * @var string      $_content                contenu du chapitre
     * @var string      $_creation_date          date de creation du chapitre
     */
    private $_id, $_title, $_author, $_content, $_creation_date;

    /**
     * Chapter constructor.
     * Methode magique car elle est automatiquement appelée lors de l'instanciation de Chapter
     */
    public function __construct()
    {
        $this->_creation_date = new DateTime('now');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @return string
     */
    public function getCreationDate()
    {
        return $this->_creation_date;
    }

    /**
     * @param string         $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @param string        $author
     */
    public function setAuthor($author)
    {
        $this->_author = $author;
    }

    /**
     * @param string         $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * @param string         $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->_creation_date = $creation_date;
    }

}