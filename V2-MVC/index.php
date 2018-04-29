<?php

require('controller/frontend.php');

if (isset($_GET['action']))
{
    if($_GET['action'] == '')
    {
        lastOne();
    }
    elseif ($_GET['action'] == 'listChapters')
    {
        listChapters();
    }
    elseif ($_GET['action'] == 'chapter')
    {
        if (isset($_GET['chapter']) && $_GET['chapter'] > 0)
        {
            chapter();
        }
        else
        {
            echo 'Erreur : aucun identifiant de chapitre envoyé !';
        }
    }
}
else
{
    lastOne();
}