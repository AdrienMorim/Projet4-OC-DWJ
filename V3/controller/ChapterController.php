<?php

namespace V3\Controller;

require_once ('model/ChapterManager.php');
require_once ('model/CommentManager.php');

use V3\Model\ChapterManager;
use V3\Model\CommentManager;

class ChapterController
{

// Ajouter un chapitre
    public function postChapter($author, $title, $content)
    {
        $chapterManager = new ChapterManager();
        $createChapter = $chapterManager->createChapter($author, $title, $content);

        header('Location: ../V3/index.php?action=listChapters');
    }

// lire un chapitre + ses commentaires
    public function chapter($id_chapter)
    {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();

        $chapter = $chapterManager->getChapter($id_chapter);
        $comments = $commentManager->getComments($id_chapter);
        require('view/frontend/chapterView.php');
    }

// Editer un chapitre
    public function updateChapter($id_chapter, $author, $title, $content)
    {
        $chapterManager = new ChapterManager();
        $updateChapter = $chapterManager->updateChapter($id_chapter, $author, $title, $content);

        if ($updateChapter === false) {
            throw new Exception('Impossible de mettre à jour le chapitre');
        } else {
            header('Location: ../V3/index.php?action=listChapters');
        }
    }

// Supprimer un chapitre
    public function deleteChapter($id_chapter)
    {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();

        $deleteChapter = $chapterManager->deleteChapter($id_chapter);
        $deleteComments = $commentManager->deleteComments($id_chapter);

        if ($deleteChapter === false) {
            throw new Exception('Impossible de supprimer le chapitre');
        } elseif ($deleteComments === false) {
            throw new Exception('Impossible de supprimer les commentaire du chapitre');
        } else {
            header('Location: ../V3/index.php?action=listChapters');
        }
    }

}

