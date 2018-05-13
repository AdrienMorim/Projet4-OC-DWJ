<?php $title = 'À propos - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <?php include('../V2_MVC/view/nav.php'); ?>

<?php $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2>À propos de l'auteur</h2>

<p> Lorem Ipsum </p>

<?php $content = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>
