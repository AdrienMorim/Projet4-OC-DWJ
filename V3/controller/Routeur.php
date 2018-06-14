<?php

namespace V3\Controller;

require('ChapterController.php');
require('CommentController.php');
require('DashboardController.php');
require('IndexController.php');
require('UserController.php');
require('ViewController.php');
/*
use V3\Controller\ChapterController;
use V3\Controller\CommentController;
use V3\Controller\DashboardController;
use V3\Controller\IndexController;
use V3\Controller\UserController;
use V3\Controller\ViewController;
*/
class Routeur
{
    private $_chapterCtrl;
    private $_commentCtrl;
    private $_dashboardCtrl;
    private $_indexCtrl;
    private $_userCtrl;
    private $_viewCtrl;

    public function __construct()
    {
        $this->setChapter(new ChapterController());
        $this->setComment(new CommentController());
        $this->setDashboard(new DashboardController());
        $this->setIndex(new IndexController());
        $this->setUser(new UserController());
        $this->setView(new ViewController());
    }

    private function setChapter($chapter)
    {
        $this->_chapterCtrl = $chapter;
    }

    private function setComment($comment)
    {
        $this->_commentCtrl = $comment;
    }

    private function setDashboard($dashboard)
    {
        $this->_dashboardCtrl = $dashboard;
    }

    private function setIndex($index)
    {
        $this->_indexCtrl = $index;
    }

    private function setUser($user)
    {
        $this->_userCtrl = $user;
    }

    private function setView($view)
    {
        $this->_viewCtrl = $view;
    }



    private function set


    public function getRequete()
    {
        try {
            // SI ADMIN
            if (isset($_SESSION['id']) && $_SESSION['id_group'] == 1) {
                if (isset($_GET['action']) && !empty($_GET['action'])) {
                    // ADMIN - Dashbord
                    if ($_GET['action'] == 'dashbord') {
                        $this->_dashboardCtrl->dashbord();
                    } // ADMIN - Chapitre avec ses commentaires
                    elseif ($_GET['action'] == 'adminChapter') {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                            $this->_chapterCtrl->adminChapter($_GET['id_chapter']);
                        } else {
                            throw new Exception('Aucun identifiant de chapitre envoyé !');
                        }
                    }
                }
            }
        }
        catch (Exception $e)
        {
            $this->getErreur($e->getMessage());

        }
    }

    public function getErreur($errorMessage)
    {
        require('view/frontend/errorView.php');
    }
}