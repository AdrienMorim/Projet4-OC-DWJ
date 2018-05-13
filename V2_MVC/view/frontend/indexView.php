<?php $title = 'Jean Forteroche - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <?php include('../V2_MVC/view/nav.php'); ?>

<?php $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2>Nouveau Roman - Jean Forteroche</h2>

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
            <em><a href="../V2_MVC/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Commentaires</a></em>
        </p>
    </div>
    <?php
} // fin de la boucle des chapitres

$chapter->closeCursor();

while ($data = $comment->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($data['author']); ?></strong> le <?= $data['comment_date_fr']; ?></p>
    <p><?= nl2br(htmlspecialchars($data['comment'])); ?></p>
    <?php
}
$comment->closeCursor();

?>

<?php $content = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>