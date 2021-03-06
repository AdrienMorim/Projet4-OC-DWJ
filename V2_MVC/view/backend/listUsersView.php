<?php $title = 'Liste des membres - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V2_MVC/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Liste des membres</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php

while ($user = $users->fetch())
{
    ?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($user['id']); ?>
        </h3>
        <p>
            <?= htmlspecialchars($user['pseudo']); ?>
            <em><a href="../V2_MVC/index.php?action=adminUpdateUser&amp;id_user=<?= $user['id']; ?>">Éditer</a></em>
            <em><a href="../V2_MVC/index.php?action=deleteUser&amp;id_user=<?= $user['id']; ?>">Supprimer</a></em>
        </p>
        <p>
            <?= htmlspecialchars($user['pass']); ?>
        </p>
        <p>
            <?= htmlspecialchars($user['email']); ?>
        </p>
    </div>
    <?php
} // fin de la boucle des chapitres

$users->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); include('../V2_MVC/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>