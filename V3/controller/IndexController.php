<?php

namespace V3\Controller;

require_once ('model/ChapterManager.php');
require_once ('model/CommentManager.php');

use V3\Model\ChapterManager;
use V3\Model\CommentManager;

class IndexController
{
    private $_chapter;
    private $_comment;

    public function __construct()
    {
        $this->_chapter = new ChapterManager();
        $this->_comment = new CommentManager();
    }

    // Home
    public function home()
    {
        $chapter = $this->_chapter->getLastChapter();
        $comment = $this->_comment->getLastComment();

        require ('view/frontend/indexView.php');
    }
}