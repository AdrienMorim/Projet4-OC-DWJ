<?php $title = 'À propos - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V3/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2>À propos de l'auteur</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

<h3> Lorem Ipsum </h3>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); include('../V3/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V3/view/template.php'); ?>
