<?php $title = 'Chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <ul> <!-- avec emmet: ul>li*5>a +[TAB]-->
        <li>
            <a href="index.php">Accueil</a>
        </li>
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
    </ul>

<?php $toggle_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2>Chapitre <?= htmlspecialchars($chapter['id']); ?></h2>

    <div class="news">
        <h3>
            <?= htmlspecialchars($chapter['title']); ?>
            <em>le <?= $chapter['creation_date_fr']; ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($chapter['content'])); ?> <br/>
        </p>
    </div>

<h3>Commentaires</h3>

<?php
while ($comment = $comments->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php
}

$comments->closeCursor();
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php');
