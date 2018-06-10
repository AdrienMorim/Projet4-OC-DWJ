<?php $title = 'Commentaires signalés - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Commentaires signalés</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <div>

        <?php

        while ($comment = $reportComments->fetch())
        {
            ?>
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?><br/>
                <em><a href="../V3/index.php?action=adminUpdateComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Éditer <i class="fas fa-comment-dots"></i></a></em>
                <!--<em><a href="../V3/index.php?action=moderateComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Modérer <i class="fas fa-comment-slash"></i></a></em>-->
                <em><a href="../V3/index.php?action=approvedComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Approuver <i class="fas fa-bell-slash"></i></a></em>
                <em><a href="../V3/index.php?action=deleteComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Supprimer <i class="fas fa-minus-circle"></i></a></em>
            </p>
            <?php
        }
        $reportComments->closeCursor(); ?>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>