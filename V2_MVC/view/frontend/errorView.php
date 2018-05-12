<?php $title = 'Erreur !'; ?>

<?php ob_start(); ?>

    <?php include('nav.php'); ?>

<?php $toggle_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2> Erreur :</h2>

<h3><?= $errorMessage ?></h3>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>