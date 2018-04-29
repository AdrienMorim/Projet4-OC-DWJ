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
<h1>Billet simple pour l'Alaska</h1>
<h2>Nouveau Roman - Jean Forteroche</h2>
<nav class="menu">

    <ul> <!-- avec emmet: ul>li*4>a +[TAB]-->
        <li>
            <a href="about.php">À propos</a>
        </li>
        <li>
            <a href="chapters.php">Chapitres</a>
        </li>
        <li>
            <a href="register.php">Inscription</a>
        </li>
        <li>
            <a href="login.php">Connexion</a>
        </li>
        <li>
            <a href="admin/create_chapter.php">Créer un nouveau chapitre</a>
        </li>
    </ul>
</nav>

<?php

while ($data = $chapter->fetch())
{
    ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']); ?>
            <em>le <?= $data['creation_date_fr']; ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($data['content'])); ?> <br/>
            <em><a href="chapter.php?chapter=<?= $data['id']; ?>">Commentaires</a></em>
        </p>
    </div>
    <?php
} // fin de la boucle des chapitres

while ($data = $comment->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($data['author']); ?></strong> le <?= $data['comment_date_fr']; ?></p>
    <p><?= nl2br(htmlspecialchars($data['comment'])); ?></p>
    <?php
}
?>
</body>
</html>