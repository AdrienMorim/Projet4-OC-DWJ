<?php

    //Connexion DataBase
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=Projet4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        die('Erreur : ' .$e->getMessage());
    }

    $req = $db->prepare('DELETE FROM comments WHERE id= :id');
    $req->execute(array('id'=>$_GET['id']));

    $req->closeCursor();

    header('Location: moderate_comments.php?chapter=' . $_GET['chapter'] );