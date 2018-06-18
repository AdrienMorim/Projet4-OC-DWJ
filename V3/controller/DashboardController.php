<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 14/06/2018
 * Time: 16:34
 */

namespace V3\Controller;

require_once ('model/ChapterManager.php');
require_once ('model/CommentManager.php');
require_once ('model/UserManager.php');

use V3\Model\ChapterManager;
use V3\Model\CommentManager;
use V3\Model\UserManager;

class DashboardController
{
    private $_chapter;
    private $_comment;
    private $_user;

    public function __construct()
    {
        $this->_chapter = new ChapterManager();
        $this->_comment = new CommentManager();
        $this->_user = new UserManager();
    }

    function dashbord()
    {
        $chapter = $this->_chapter->getLastChapter();
        $comment = $this->_comment->getLastComment();
        //$chapter = $this->_chapter->countChapter();
        //$comment = $this->_comment->countComment();
        //$commentReport = $this->_comment->countCommentReport();
        //$user = $this->_user->countUser();
        require('view/backend/dashbordView.php');
    }
}