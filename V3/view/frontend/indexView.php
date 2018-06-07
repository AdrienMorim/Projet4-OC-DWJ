<?php $title = 'Jean Forteroche - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V3/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Nouveau Roman - Jean Forteroche</h2>
    <h3>Bienvenue <?php if(isset($_SESSION['id']))
        {
            echo $_SESSION['pseudo'];
        } ?>
    </h3>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

<h3>Dernier chapitre du blog:</h3>

<?php

while ($data = $chapter->fetch())
{
    ?>
    <div class="news">
        <h4>
            <?= htmlspecialchars($data['title']); ?>
            <em>le <?= $data['creation_date_fr']; ?></em>
        </h4>

        <p>
            <?= nl2br(htmlspecialchars(substr($data['content'], 0, 80))); ?> ...<br/>
            <em><a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></a></em>
        </p>
    </div>
    <?php
} // fin de la boucle des chapitres
 $chapter->closeCursor();
?>

<h3>Dernier commentaire: </h3>

<?php

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

<?php ob_start(); include('../V3/view/footer.php'); $footer = ob_get_clean(); ?>


<?php require('../V3/view/template.php'); ?>