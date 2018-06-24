<?php $title = 'Liste des Chapitres - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Liste des chapitres</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="table-primary">
                <th scope="col">Titre </th>
                <th scope="col">Date de création</th>
                <th scope="col">Aperçu</th>
                <th scope="col">Éditer</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = $chapters->fetch())
            {
                ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($data['title']); ?></th>
                    <td>le <?= $data['creation_date_fr']; ?></td>
                    <td>
                        <?= nl2br(htmlspecialchars(substr($data['content'], 0, 150))); ?>...
                        <?php if(!isset($_SESSION['id_group']) || isset($_SESSION) && $_SESSION['id_group'] == 2) { ?>
                            <em><a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></a></em>
                        <?php
                        }
                        else { ?>
                            <em><a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></a></em>
                    </td>

                    <td>
                        <a href="../V3/index.php?action=adminUpdateChapter&amp;id_chapter=<?= $data['id']; ?>"><i class="fas fa-pen-square"></i></a>
                    </td>
                    <td>
                        <a href="../V3/index.php?action=deleteChapter&amp;id_chapter=<?= $data['id']; ?>"><i class="fas fa-trash-alt"></i></a>
                    </td>
                        <?php
                        }
                        ?>

                </tr>
                <?php
            } // fin de la boucle des chapitres

            $chapters->closeCursor();
            ?>
        </tbody>
    </table>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>