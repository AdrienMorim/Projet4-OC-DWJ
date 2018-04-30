<?php

require('controller/frontend.php');

// Gestion des exception
try{
    if (isset($_GET['action']))
    {
        // Index
        if($_GET['action'] == NULL)
        {
            lastOne();
        }
        // Liste des chapitres
        elseif ($_GET['action'] == 'listChapters')
        {
            listChapters();
        }
        // Affiche le chapitre avec ses commentaires
        elseif ($_GET['action'] == 'chapter')
        {
            if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
            {
                chapter();
            }
            else
            {
                throw new Exception('Aucun identifiant de chapitre envoyé !');
            }
        }
        // Ajoute un commentaire dans le chapitre selectionné
        elseif ($_GET['action'] == 'addComment')
        {
            if (isset($_GET['id_chapter']) && $_GET['id_chapter'] > 0)
            {
                if (!empty($_POST['author']) && !empty($_POST['comment']))
                {
                    addComment($_GET['id_chapter'], $_POST['author'], $_POST['comment']);
                }
                else
                {
                    throw new Exception('Tous les champs doivent être remplis !');
                }
            }
            else
            {
                throw new Exception('Aucun identifiant de chapitre envoyé !');
            }
        }
    }
// Retourne à l'index.
    else
    {
        lastOne();
    }
}
catch (Exception $e)
{
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}
