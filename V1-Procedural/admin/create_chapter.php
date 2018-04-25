<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="Roman 'Billet simple pour l'Alaska', nouveau Roman de Jean Forteroche"/>
        <meta name="keywords" content="Jean Forteroche, Blog, Roman, Billet simple pour l'Alaska"/>
        <meta name="author" content="Jean Forteroche">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <link rel="icon" type="image/ico" sizes="500X500" href="images/ico/favicon.png" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Audiowide|Orbitron:400,500" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
        <title>Billet simple Pour l'Alaska</title>
    </head>

    <body>
        <h1>Administration - Créer un chapitre</h1>
        <h2>Nouveau Roman - Jean Forteroche</h2>
        <p>
            <a href="../index.php">Retour à la page d'Accueil</a>
        </p>
        <p>
            <a href="../chapters.php">Voir la liste des chapitres</a>
        </p>


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
?>
        <h3>Création d'un nouveau chapitre</h3>

        <form action="post.php" method="POST">
            <p>
                <label for="author"> Auteur
                    <input type="text" name="author" id="author"/>
                </label>
            </p>
            <p>
                <label for="title"> Titre
                    <input type="text" name="title" id="title"/>
                </label>
                <label for="content">Chapitre
                    <textarea name="content" id="content" placeholder="Indiquez ici votre chapitre"></textarea>
                </label>
            </p>
            <button>
                <input type="submit" value="Envoyer"/>
            </button>
            <button>
                <input type="button" value="Rafraîchir"/>
            </button>
        </form>
    </body>
</html>