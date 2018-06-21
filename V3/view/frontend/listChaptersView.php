<?php $title = 'Liste des Chapitres - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Liste des chapitres</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start();

while ($data = $chapters->fetch())
{
    ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']); ?>
            <em>le <?= $data['creation_date_fr']; ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars(substr($data['content'], 0, 150))); ?>...<br/>
            <?php if(!isset($_SESSION['id_group']) || isset($_SESSION) && $_SESSION['id_group'] == 2) { ?>
                <em><a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></a></em>
            <?php
            }
            else { ?>
                <em><a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></a></em>
                <em><a href="../V3/index.php?action=adminUpdateChapter&amp;id_chapter=<?= $data['id']; ?>">Éditer <i class="fas fa-pen-square"></i></a></em>
                <em><a href="../V3/index.php?action=deleteChapter&amp;id_chapter=<?= $data['id']; ?>">Supprimer <i class="fas fa-trash-alt"></i></a></em>
            <?php
            }
            ?>
        </p>
    </div>
    <?php
} // fin de la boucle des chapitres

$chapters->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>