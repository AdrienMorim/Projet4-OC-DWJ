<?php $title = 'Liste des Commentaires - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V2_MVC/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Commentaires</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

<div>
    <h2>Liste des commentaires signalés</h2>

<?php

while ($comment = $reportComments->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?><br/>
        <em><a href="../V2_MVC/index.php?action=adminUpdateComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Éditer <i class="fas fa-comment-dots"></i></a></em>
        <em><a href="../V2_MVC/index.php?action=deleteComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Supprimer <i class="fas fa-comment-slash"></i></a></em>
        <em><a href="../V2_MVC/index.php?action=approved&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Approuver <i class="fas fa-bell-slash"></i></a></em>
    </p>
    <?php
}
$reportComments->closeCursor(); ?>
</div>

<div>
    <h2>Liste des commentaires</h2>

<?php

while ($comment = $comments->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?><br/>
        <em><a href="../V2_MVC/index.php?action=adminUpdateComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Éditer <i class="fas fa-comment-dots"></i></a></em>
        <em><a href="../V2_MVC/index.php?action=deleteComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Supprimer <i class="fas fa-comment-slash"></i></a></em>
        <em><a href="../V2_MVC/index.php?action=report&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Signaler <i class="fas fa-bell"></i></a></em>
    </p>
    <?php
}
$comments->closeCursor(); ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); include('../V2_MVC/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>