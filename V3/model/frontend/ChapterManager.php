<?php

namespace V3\Model\Frontend;

require_once('model/frontend/Manager.php');

/**
 * Class ChapterManager
 * @package V3\Model\Frontend
 */
class ChapterManager extends Manager
{

    /**
     * @return bool|\PDOStatement
     */
    public function getLastChapter()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 1');
        return $req;
    }

    /**
     * @return bool|\PDOStatement
     */
    public function getChapters()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 5');
        return $req;
    }

    /**
     * @param $id_chapter
     * @return mixed
     */
    public function getChapter($id_chapter)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters WHERE id = ?');
        $req->execute(array($id_chapter));
        $chapter = $req->fetch();

        return $chapter;
    }
}