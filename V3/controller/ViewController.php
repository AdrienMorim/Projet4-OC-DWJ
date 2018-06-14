<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 14/06/2018
 * Time: 16:30
 */

namespace V3\Controller;


class ViewController
{
    // Page A propos de l'auteur
    public function aboutAuthor()
    {
        require('view/frontend/aboutView.php');
    }

    // Page de connexion  / inscription
    function login()
    {
        require('view/frontend/loginView.php');
    }

    // Page nouveau chapitre
    function adminNewChapter()
    {
        require ('view/backend/newChapterView.php');
    }
}