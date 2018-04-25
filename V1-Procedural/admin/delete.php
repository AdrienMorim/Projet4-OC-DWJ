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

    $req = $db->prepare('DELETE FROM chapters WHERE id= :chapter');
    $req->execute(array('chapter'=>$_GET['chapter']));

    $req->closeCursor();

    $req = $db->prepare('DELETE FROM comments WHERE id_chapter= :chapter');
    $req->execute(array('chapter'=>$_GET['chapter']));

    $req->closeCursor();

    header('Location: ../index.php');