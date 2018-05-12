<?php $title = 'Liste des Commentaires - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <ul> <!-- avec emmet: ul>li*5>a +[TAB]-->
        <li>
            <a href="../V2_MVC/index.php?action=dashbord">Tableau de bord</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=adminListChapters">Administration des chapitres</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=adminListComments">Administration des commentaires</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=logout">Déconnexion</a>
        </li>
    </ul>

<?php $admin_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Liste des commentaires</h2>

<?php

while ($comment = $comments->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <em><a href="../V2_MVC/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Mettre à jour le commentaire</a></em>
    <em><a href="../V2_MVC/index.php?action=deleteComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Supprimer le commentaire</a></em>
    <?php
}

$comments->closeCursor();
?>

    <h2>Liste des commentaires signalés</h2>

<?php

while ($comment = $reportComments->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <em><a href="../V2_MVC/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Mettre à jour le commentaire</a></em>
    <em><a href="../V2_MVC/index.php?action=deleteComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Supprimer le commentaire</a></em>
    <?php
}

$reportComments->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>