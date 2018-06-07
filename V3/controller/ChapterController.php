<?php

namespace V3\Controller;

require_once ('model/backend/ChapterManager.php');
require_once ('model/backend/CommentManager.php');
require_once ('model/backend/UserManager.php');
require_once ('view/backend/chapterView.php');

use V3\Model\Backend\ChapterManager;
use V3\Model\Backend\CommentManager;
use V3\Model\Backend\UserManager;


class ChapterController
{
    private $_chapter;
    private $_comment;

    public function __construct()
    {
        $this->_chapter = new ChapterManager();
        $this->_comment = new CommentManager();
    }

    // Chapitre + commentaires
    public function adminChapter($id_chapter)
    {
        $chapter = $this->_chapter->getChapter($id_chapter);
        $comments = $this->_comment->getComments($id_chapter);
    }
}