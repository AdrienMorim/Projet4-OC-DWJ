<?php
session_start();

if (isset($_COOKIE['id']) AND isset($_COOKIE['pseudo']))
{
    echo 'Hello ' . $_COOKIE['pseudo'] . ', tu es admin de niveau: ' . $_COOKIE['id_group'];
}

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'] . ', tu es admin de level: ' . $_SESSION['id_group'];
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="'Billet simple pour l'Alaska', est le nouveau Roman de Jean Forteroche. Écrivain, auteur de plusieurs bestsellers, décide d'écrire son nouveau roman avec plusieurs épisodes sous forme de blog."/>
        <meta name="keywords" content="Jean Forteroche, Blog, Roman, Billet simple pour l'Alaska"/>
        <meta name="author" content="Jean Forteroche">
        <link rel="stylesheet" type="text/css" href="../V2_MVC/public/css/style.css"/>
        <link rel="icon" type="image/ico" sizes="500X500" href="../V2_MVC/public/images/ico/favicon.png" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Audiowide|Orbitron:400,500" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
        <title> Admin - <?= $title ?></title>
    </head>

    <body>
        <nav>
            <?= $admin_menu ?>
        </nav>
        <?= $content ?>
    </body>
</html>