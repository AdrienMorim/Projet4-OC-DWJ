<?php
//Connexion DataBase
try
{
    $db = new PDO('mysql:host=localhost;dbname=Projet4;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}

