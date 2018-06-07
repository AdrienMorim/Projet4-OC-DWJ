<?php

namespace V3\Controller;

//require_once ('controller/ChapterController.php');
require_once ('controller/IndexController.php');

class Routeur
{
    private $_chapterCtrl;
    private $_indexCtrl;

    public function __construct()
    {
        //$this->_chapterCtrl = new ChapterController();
        $this->_indexCtrl = new IndexController();
    }

    public function getRequete()
    {
        try {
            // SI ADMIN
            if (isset($_SESSION['id']) && $_SESSION['id_group'] == 1) {
                if (isset($_GET['action']) && !empty($_GET['action'])) {
                    // ADMIN - Dashbord
                    if ($_GET['action'] == 'dashbord') {
                        dashbord();
                    } // ADMIN - Chapitre avec ses commentaires
                    elseif ($_GET['action'] == 'adminChapter') {
                        if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0) {
                            adminChapter($_GET['id_chapter']);
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