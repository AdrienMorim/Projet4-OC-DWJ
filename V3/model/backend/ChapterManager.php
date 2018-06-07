<?php

namespace V3\Model\Backend;

require_once ('model/backend/Manager.php');

/**
 * Class ChapterManager
 * @package V3\Model\Backend
 */
class ChapterManager extends Manager
{
    public function getLastChapter()
    {
        $db = $this->dbConnect();

        $chapter = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 1');
        return $chapter;
    }

    public function getChapters()
    {
        $db = $this->dbConnect();

        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 100');
        return $req;
    }

    public function getChapter($id_chapter)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters WHERE id = ?');
        $req->execute(array($id_chapter));
        $chapter = $req->fetch();

        return $chapter;
    }

    public function createChapter($author, $title, $content)
    {
        $db = $this->dbConnect();

        $chapter = $db->prepare('INSERT INTO chapters (author, title, content, creation_date) VALUES ( ?, ?, ?, NOW())');
        $createChapter = $chapter->execute(array($author, $title, $content));

        return $createChapter;
    }

    public function updateChapter($id_chapter, $author, $title, $content)
    {
        $db = $this->dbConnect();

        $chapter = $db->prepare('UPDATE chapters SET title= :title, author= :author, content= :content, creation_date= NOW() WHERE id= :id_chapter');
        $chapter->bindParam('title',$title, \PDO::PARAM_STR);
        $chapter->bindParam('author', $author, \PDO::PARAM_STR);
        $chapter->bindParam('content',$content, \PDO::PARAM_STR);
        $chapter->bindParam('id_chapter', $id_chapter, \PDO::PARAM_INT);
        $updateChapter = $chapter->execute();

        return $updateChapter;
    }

    public function deleteChapter($id_chapter)
    {
        $db = $this->dbConnect();

        $chapter = $db->prepare('DELETE FROM chapters WHERE id= ?');
        $deleteChapter = $chapter->execute(array($id_chapter));

        return $deleteChapter;
    }
}