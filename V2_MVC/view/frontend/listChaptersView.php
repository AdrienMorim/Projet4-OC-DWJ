<?php $title = 'Liste des Chapitres - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <?php include('nav.php'); ?>

<?php $toggle_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Liste des chapitres</h2>

<?php

while ($data = $chapters->fetch())
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

$chapters->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>