<?php
// On démarre la session avant d'écrire du HTML
session_start();

// On vérifie que les variables existent
if (isset($_POST['author'], $_POST['comment']))
{
    // On vérifie que l'une des 2 variables n'est pas vide
    if ($_POST['author'] != NULL && $_POST['comment'] != NULL)
    {
        // Connexion à la base de données
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        // Effectuer ici la requête qui insère le commentaire
        $req = $db->prepare('UPDATE comments SET reporting= :reporting WHERE id= :id');
        $req->bindValue(':reporting', 1, PDO::PARAM_INT);
        $req->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $req->execute();
        /*$req->execute(array(
            'reporting' => TRUE,
            'id'=>$_GET['id']));*/

    }

    // Puis rediriger vers comments.php comme ceci :
    header('Location: comments.php?chapter=' . $_GET['chapter']);
}