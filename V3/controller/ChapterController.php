<?php

namespace V3\Controller;

require_once ('model/ChapterManager.php');
require_once ('model/CommentManager.php');

use V3\Model\ChapterManager;
use V3\Model\CommentManager;

class ChapterController
{
    private $_chapter;
    private $_comment;

    public function __construct()
    {
        $this->_chapter = new ChapterManager();
        $this->_comment = new CommentManager();
    }

// Afficher un chapitre + ses commentaires
    public function chapter($id_chapter)
    {
        $chapter = $this->_chapter->getChapter($id_chapter);
        $comments = $this->_comment->getComments($id_chapter);
        require('view/frontend/chapterView.php');
    }

// Liste des chapitres
    public function listChapters()
    {
        $chapters = $this->_chapter->getAllChapters();
        require('view/frontend/listChaptersView.php');
    }

// Ajouter un chapitre
    public function postChapter($author, $title, $content)
    {
        $createChapter = $this->_chapter->createChapter($author, $title, $content);
        header('Location: ../V3/index.php?action=listChapters');
    }

// Page d'édition d'un chapitre
    public function adminUpdateChapter()
    {
        $chapter = $this->_chapter->getChapter($_GET['id_chapter']);
        require ('view/backend/updateChapterView.php');
    }

// Editer un chapitre
    public function updateChapter($id_chapter, $author, $title, $content)
    {
        $updateChapter = $this->_chapter->updateChapter($id_chapter, $author, $title, $content);

        if ($updateChapter === false) {
            throw new Exception('Impossible de mettre à jour le chapitre');
        } else {
            header('Location: ../V3/index.php?action=listChapters');
        }
    }

// Supprimer un chapitre
    public function deleteChapter($id_chapter)
    {
        $deleteChapter = $this->_chapter->deleteChapter($id_chapter);
        $deleteComments = $this->_comment->deleteAllComments($id_chapter);

        if ($deleteChapter === false) {
            throw new Exception('Impossible de supprimer le chapitre');
        } elseif ($deleteComments === false) {
            throw new Exception('Impossible de supprimer les commentaire du chapitre');
        } else {
            header('Location: ../V3/index.php?action=listChapters');
        }
    }
}

