<?php

namespace V3\Controller;

require_once ('model/backend/ChapterManager.php');
require_once ('model/backend/CommentManager.php');
require_once ('model/backend/UserManager.php');
require_once ('view/backend/indexView.php');

use V3\Model\Backend\ChapterManager;
use V3\Model\Backend\CommentManager;
use V3\Model\Backend\UserManager;
use V3\Model\Chapter;

class IndexController
{
    private $_chapter;

    public function __construct()
    {
        $this->_chapter = new ChapterManager();
    }

    // Dashbord
    public function dashbord()
    {
        $chapter = $this->_chapter->getLastChapter();
        //require('view/backend/indexView.php');
        return $chapter;

    }
}