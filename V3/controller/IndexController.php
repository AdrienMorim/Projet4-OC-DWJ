<?php

namespace V3\Controller;

require_once ('model/ChapterManager.php');
require_once ('model/CommentManager.php');
require_once ('model/UserManager.php');
require_once ('view/dashbordView.php');

use V3\Model\ChapterManager;
use V3\Model\CommentManager;
use V3\Model\UserManager;
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
        //require('view/backend/dashbordView.php');
        return $chapter;

    }
}