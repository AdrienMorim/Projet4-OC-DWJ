<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 14/06/2018
 * Time: 16:34
 */

namespace Alaska\Src\Controller;

require_once ('src/model/ChapterManager.php');
require_once ('src/model/CommentManager.php');
require_once ('src/model/UserManager.php');

use Alaska\Src\Model\ChapterManager;
use Alaska\Src\Model\CommentManager;
use Alaska\Src\Model\UserManager;

/**
 * Class DashbordController
 * @package Alaska\Src\Controller
 */
class DashbordController
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

    public function dashbord()
    {
        $chapter = $this->_chapter->getLastChapter();
        $comment = $this->_comment->getLastComment();
        $chaptersTotal = $this->_chapter->countChapters();
        $commentsTotal = $this->_comment->countComments();
        $commentsReportTotal = $this->_comment->countCommentsReport();
        $usersTotal = $this->_user->countUsers();
        require('src/view/backend/dashbordView.php');
    }
}