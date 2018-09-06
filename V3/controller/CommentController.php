<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 08/06/2018
 * Time: 11:29
 */

namespace V3\Controller;

require_once ('model/ChapterManager.php');
require_once ('model/CommentManager.php');

use V3\Model\ChapterManager;
use V3\Model\CommentManager;

class CommentController
{
    private $_comment;
    private $_chapter;

    public function __construct()
    {
        $this->_comment = new CommentManager();
        $this->_chapter = new ChapterManager();
    }

// Liste des commentaires
    public function adminListComments()
    {
        $comment_per_page = 10;
        $commentsTotal = $this->_comment->countComments();
        $nbPages = ceil($commentsTotal['total_comments']/$comment_per_page);
        $current_page = 1;
        if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages){
            $_GET['page'] = intval($_GET['page']);
            $current_page = $_GET['page'];
        }

        $start = ($current_page-1) * $comment_per_page;
        $allComments = $this->_comment->getAllComments($start, $comment_per_page);
        require ('view/backend/ListCommentsView.php');
    }

// Ajouter un commentaire
    public function addComment($id_chapter, $author, $comment)
    {
        $postComment = $this->_comment->createComment($id_chapter, $author, $comment);
        if($postComment === false)
        {
            throw new Exception('Impossible d\'ajouter le commentaire');
        }
        else{
            header('Location: ../V3/index.php?action=chapter&id_chapter=' . $id_chapter);
        }
    }

// Page d'édition d'un commentaire
    public function adminUpdateComment()
    {
        $chapter = $this->_chapter->getChapter($_GET['id_chapter']);
        $comment = $this->_comment->getCommentById($_GET['id']);
        require ('view/backend/updateCommentView.php');
    }

// Editer un commentaire
    public function updateComment($id_comment, $id_chapter, $author, $comment)
    {
        $updateComment = $this->_comment->updateComment($id_comment, $id_chapter, $author, $comment);

        if($updateComment === false)
        {
            throw new Exception('Impossible de mettre à jour le commentaire' );
        }
        else
        {
            header('Location: ../V3/index.php?action=chapter&id_chapter=' . $id_chapter );
        }
    }

// Signaler un commentaire
    public function reportingComment()
    {
        $chapter = $this->_chapter->getChapter($_GET['id_chapter']);
        $reportComment = $this->_comment->reportComment($_GET['id']);

        header('Location: ../V3/index.php?action=chapter&id_chapter=' . $_GET['id_chapter']);
    }

// Approuver un commentaire (retirer le signalement)
    public function approvedComment()
    {
        $chapter = $this->_chapter->getChapter($_GET['id_chapter']);
        $reportComment = $this->_comment->approvedComment($_GET['id']);

        header('Location: ../V3/index.php?action=adminCommentsReport');
    }

// Liste des commentaires signalés
    public function adminCommentsReport()
    {
        $comment_per_page = 10;
        $commentsReportTotal = $this->_comment->countCommentsReport();
        $nbPages = ceil($commentsReportTotal['total_comments_report']/$comment_per_page);
        $current_page = 1;
        if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages){
            $_GET['page'] = intval($_GET['page']);
            $current_page = $_GET['page'];
        }

        $start = ($current_page-1) * $comment_per_page;
        $reportComments = $this->_comment->getReportComments($start, $comment_per_page);
        require ('view/backend/reportCommentsView.php');
    }

// Supprimer un commentaire
    public function deleteComment($id_comment)
    {
        $deleteComment = $this->_comment->deleteComment($id_comment);

        if($deleteComment === false)
        {
            throw new Exception('Impossible de supprimer le commentaire' );
        }
        else
        {
            header('Location: ../V3/index.php?action=dashbord' );
        }
    }
}