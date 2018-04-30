<?php
// On vérifie que les variables existent
if (isset($_POST['author'], $_POST['title'], $_POST['content']))
{
    // On vérifie que l'une des 2 variables n'est pas vide
    if ($_POST['author'] != NULL && $_POST['title'] != NULL && $_POST['content'] != NULL)
    {
        //Connexion DataBase
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=Projet4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }
        // Effectuer ici la requête qui insère le message
        $req = $db->prepare('INSERT INTO chapters (title, author, content, creation_date) VALUES (:title, :author, :content, NOW())');
        $req->execute(array(
            'title'=>$_POST['title'],
            'author'=>$_POST['author'],
            'content'=>$_POST['content']
        ));
    }
    // Puis rediriger vers index.php comme ceci :
    header('Location: ../index.php');
}