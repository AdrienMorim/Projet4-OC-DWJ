<?php

namespace V3\Model;

require_once ('model/Manager.php');

use \DateTime;
use \PDO;

/**
 * Class ChapterManager
 * @package V3\Model\Backend
 */
class ChapterManager extends Manager
{
    /**
     * @var int         $_id                     identifiant du chapitre (généré automatiquement par le SGBDR donc pas de setter)
     * @var string      $_title                  titre du chapitre
     * @var string      $_author                 auteur du chapitre
     * @var string      $_content                contenu du chapitre
     * @var string      $_creation_date          date de creation du chapitre
     */
    private $_id_chapter, $_title, $_author, $_content, $_creation_date;

    /**
     * Chapter constructor.
     * Methode magique car elle est automatiquement appelée lors de l'instanciation de ChapterManager
     */
    public function __construct()
    {
        $this->_creation_date = new DateTime('now');
    }

    /******************************************************* GETTERS ***************************************************/
    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id_chapter;
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

    /******************************************************* SETTERS ***************************************************/

    /**
     * @param int           $id_chapter
     */
    private function setId($id_chapter)
    {
        $id_chapter = (int) $id_chapter;
        if($id_chapter > 0){
            $this->_id_chapter = $id_chapter;
        }
    }

    /**
     * @param string         $title
     */
    public function setTitle($title)
    {
        if(is_string($title)) {
            $this->_title = $title;
        }
    }

    /**
     * @param string        $author
     */
    public function setAuthor($author)
    {
        if(is_string($author)) {
            $this->_author = $author;
        }
    }

    /**
     * @param string         $content
     */
    public function setContent($content)
    {
        if(is_string($content)) {
            $this->_content = $content;
        }
    }

    /**
     * @param string         $creation_date
     */
    public function setCreationDate(DateTime $creation_date)
    {
        $this->_creation_date = $creation_date;
    }

    /*********************************************** METHODES *********************************************************/

    /**
     * @return bool|\PDOStatement           Récupère le dernier chapitre
     */
    public function getLastChapter()
    {
        $db = $this->dbConnect();

        $chapter = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 1');
        return $chapter;
    }

    /**
     * @return bool|\PDOStatement           Récupère tous les chapitres
     */
    public function getAllChapters($start, $chapter_per_page)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT ?, ?');
        $req->bindParam(1,$start, PDO::PARAM_INT);
        $req->bindParam(2,$chapter_per_page, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }

    /**
     * @return int                          Compte le nombre de commentaires
     */
    public function countChapters()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) AS total_chapters FROM chapters');
        $req->execute();
        $chaptersTotal = $req->fetch();
        return $chaptersTotal;

    }

    /**
     * @param                               $id_chapter
     * @return mixed                        Récupère un chapitre via son identifiant
     */
    public function getChapter($id_chapter)
    {
        $this->setId($id_chapter);

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters WHERE id = ?');
        $req->execute(array($this->getId()));
        $chapter = $req->fetch();

        return $chapter; var_dump($chapter);
    }

    /**
     * @param                               $author
     * @param                               $title
     * @param                               $content
     * @return bool                         Créer un chapitre du blog
     */
    public function createChapter($author, $title, $content)
    {
        $this->setAuthor($author);
        $this->setTitle($title);
        $this->setContent($content);

        $db = $this->dbConnect();
        $chapter = $db->prepare('INSERT INTO chapters (author, title, content, creation_date) VALUES ( ?, ?, ?, NOW())');
        $createChapter = $chapter->execute(array(
            $this->getAuthor(),
            $this->getTitle(),
            $this->getContent()
            ));

        return $createChapter;
    }

    /**
     * @param                               $id_chapter
     * @param                               $author
     * @param                               $title
     * @param                               $content
     * @return bool                         Met à jour un chapitre via son identifiant
     */
    public function updateChapter($id_chapter, $author, $title, $content)
    {
        $this->setId($id_chapter);
        $this->setAuthor($author);
        $this->setTitle($title);
        $this->setContent($content);

        $db = $this->dbConnect();
        $chapter = $db->prepare('UPDATE chapters SET title= :title, author= :author, content= :content, creation_date= NOW() WHERE id= :id_chapter');
        $chapter->bindParam('title',$this->getTitle(), PDO::PARAM_STR);
        $chapter->bindParam('author', $this->getAuthor(), PDO::PARAM_STR);
        $chapter->bindParam('content',$this->getContent(), PDO::PARAM_STR);
        $chapter->bindParam('id_chapter', $this->getId(), PDO::PARAM_INT);
        $updateChapter = $chapter->execute();

        return $updateChapter;
    }

    /**
     * @param                               $id_chapter
     * @return bool                         Supprimer un chapitre via son identifiant
     */
    public function deleteChapter($id_chapter)
    {
        $this->setId($id_chapter);

        $db = $this->dbConnect();
        $chapter = $db->prepare('DELETE FROM chapters WHERE id= ?');
        $deleteChapter = $chapter->execute(array($this->getId()));

        return $deleteChapter;
    }
}