<?php $title = 'Dashbord Blog - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Bienvenue sur le dashbord <br/> <?= $_SESSION['pseudo']; ?></h2>

<?php $header = ob_get_clean(); ?>

<?php

while ($data = $chapter->fetch())
{
    ?>
    <div class="dashbord">
        <h4>Derniers chapitres du blog:</h4>
        <h5>
            <?= htmlspecialchars($data['title']); ?>
            <em>le <?= $data['creation_date_fr']; ?></em>
        </h5>

        <p>
            <?= nl2br(htmlspecialchars(substr($data['content'], 0, 80))); ?>...<br/>
            <em><a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></a></em>
        </p>
    </div>
    <?php
} // fin de la boucle des chapitres
$chapter->closeCursor();
?>
    <div class="dashbord">
        <h4>Derniers commentaires des visiteurs: </h4>

    <?php

    while ($data = $comment->fetch())
    {
        ?>
        <p><strong><?= htmlspecialchars($data['author']); ?></strong> le <?= $data['comment_date_fr']; ?></p>
        <p><?= nl2br(htmlspecialchars($data['comment'])); ?></p>
    </div>
    <?php
    }
$comment->closeCursor(); ?>

<div class="dashbord">
    <a class="nav-link" href="../V3/index.php?action=listChapters">
        <p>Vous avez actuellement <?= $chaptersTotal['total_chapters']?> chapitres dans votre Roman-Blog.</p>
    </a>
</div>
<div class="dashbord">
    <a class="nav-link" href="../V3/index.php?action=adminListComments">
        <p>Vous avez actuellement <?= $commentsTotal['total_comments']?> commentaires dans votre Roman-Blog.</p>
    </a>
</div>
<div class="dashbord">
    <a class="nav-link" href="../V3/index.php?action=adminCommentsReport">
        <p>Vous avez actuellement <?= $commentsReportTotal['total_comments_report']?> commentaires signalés sur votre Roman-Blog.</p>
    </a>
</div>
<div class="dashbord">
    <a class="nav-link" href="../V3/index.php?action=adminListUsers">
        <p>Vous avez actuellement <?= $usersTotal['total_users']?> utilisateurs inscrits sur votre site.</p>
    </a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>