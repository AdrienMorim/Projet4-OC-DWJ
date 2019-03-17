<?php

namespace Alaska\Src\Controller;

require_once ('src/model/ChapterManager.php');
require_once ('src/model/CommentManager.php');

use Alaska\Src\Model\ChapterManager;
use Alaska\Src\Model\CommentManager;

/**
 * Class ChapterController
 * @package Alaska\Src\Controller
 */
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

        require('src/view/frontend/chapterView.php');
    }

// Liste des chapitres
    public function listChapters()
    {
        if(isset($_SESSION['id']) && $_SESSION['id_group'] == 1){
            $chapter_per_page = 10;
        }else{
            $chapter_per_page = 4;
        }

        $chaptersTotal = $this->_chapter->countChapters();
        $nbPages = ceil($chaptersTotal['total_chapters']/$chapter_per_page); // ceil recupère le resultat à l'entier supérieur
        $current_page = 1;
        if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages){
            $_GET['page'] = intval($_GET['page']);
            $current_page = $_GET['page'];
        }

        $start = ($current_page-1) * $chapter_per_page;
        $chapters = $this->_chapter->getAllChapters($start, $chapter_per_page);
        if(isset($_SESSION['id']) && $_SESSION['id_group'] == 1){
            require('src/view/backend/listChaptersView.php');
        }
        else{
            require('src/view/frontend/listChaptersView.php');
        }
    }


// Ajouter un chapitre
    public function postChapter($author, $title, $content)
    {
        $createChapter = $this->_chapter->createChapter($author, $title, $content);
        header('Location: index.php?action=listChapters');
        exit();
    }

// Page d'édition d'un chapitre
    public function adminUpdateChapter()
    {
        $chapter = $this->_chapter->getChapter($_GET['id_chapter']);
        require('src/view/backend/updateChapterView.php');
    }

// Editer un chapitre
    public function updateChapter($id_chapter, $author, $title, $content)
    {
        $updateChapter = $this->_chapter->updateChapter($id_chapter, $author, $title, $content);

        if ($updateChapter === false) {
            throw new Exception('Impossible de mettre à jour le chapitre');
        } else {
            header('Location: index.php?action=listChapters');
            exit();
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
            header('Location: index.php?action=listChapters');
            exit();
        }
    }
}

