<?php

namespace Alaska\Src\Controller;

require_once ('src/model/ChapterManager.php');
require_once ('src/model/CommentManager.php');

use Alaska\Src\Model\ChapterManager;
use Alaska\Src\Model\CommentManager;

/**
 * Class IndexController
 * @package Alaska\Src\Controller
 */
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

        require('src/view/frontend/indexView.php');
    }
}