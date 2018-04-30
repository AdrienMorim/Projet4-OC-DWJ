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
        // Effectuer ici la requête qui met à jour le chapitre
        $req = $db->prepare('UPDATE chapters SET title= :title, author= :author, content= :content, creation_date= NOW() WHERE id= :chapter');
        $req->execute(array(
            'title'=>$_POST['title'],
            'author'=>$_POST['author'],
            'content'=>$_POST['content'],
            'chapter'=>$_GET['chapter']
        ));
    }
    // Puis rediriger vers index.php comme ceci :
    header('Location: ../index.php');
}
/*
var_dump($_POST['title']);
var_dump($_POST['author']);
var_dump($_POST['content']);
var_dump($_GET['chapter']); die('lol');*/