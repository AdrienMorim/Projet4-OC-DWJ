<?php
/**
 * Created by PhpStorm.
 * User: morimadrien
 * Date: 14/06/2018
 * Time: 16:30
 */

namespace Alaska\Src\Controller;

/**
 * Class ViewController
 * @package Alaska\Src\Controller
 */
class ViewController
{
    // Page A propos de l'auteur
    public function aboutAuthor()
    {
        require('src/view/frontend/aboutView.php');
    }

    // Page de connexion  / inscription
    public function login()
    {
        require('src/view/frontend/loginView.php');
    }

    // Page nouveau chapitre
    public function adminNewChapter()
    {
        require('src/view/backend/newChapterView.php');
    }
}