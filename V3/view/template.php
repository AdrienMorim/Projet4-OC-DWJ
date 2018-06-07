<?php

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'] . ', tu es admin de level: ' . $_SESSION['id_group'];
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="'Billet simple pour l'Alaska', est le nouveau Roman de Jean Forteroche. Écrivain, auteur de plusieurs bestsellers, décide d'écrire son nouveau roman avec plusieurs épisodes sous forme de blog."/>
        <meta name="keywords" content="Jean Forteroche, Blog, Roman, Billet simple pour l'Alaska"/>
        <meta name="author" content="Jean Forteroche">
        <!-- Link Style - public -->
        <link rel="stylesheet" type="text/css" href="../V3/public/css/style.css"/>
        <link rel="icon" type="image/ico" sizes="500X500" href="../V3/public/images/ico/favicon.png" />
        <!-- Fonteawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <!-- Bootstrap V4 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Audiowide|Orbitron:400,500" rel="stylesheet">
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title> <?= $title ?> </title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">

                <header id="header" class="container col-lg-12">
                    <div class="row">
                        <div class="col-lg-2">
                            <?= $menu ?>
                        </div>
                        <div class="col-lg-8">
                            <?= $header ?>
                        </div>
                    </div>
                </header>

                <section class="container col-lg-8 offset-lg-2">
                    <?= $content ?>
                </section>

                <footer id="footer" class="container col-lg-12">
                    <?= $footer ?>
                </footer>

            </div>
        </div>
    </body>
</html>