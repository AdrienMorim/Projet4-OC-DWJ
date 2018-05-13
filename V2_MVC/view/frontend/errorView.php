<?php $title = 'Erreur !'; ?>

<?php ob_start(); ?>

    <?php include('../V2_MVC/view/nav.php'); ?>

<?php $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2> Erreur <?= $_SESSION['pseudo']?> :</h2>

<h3><?= $errorMessage ?></h3>

<?php $content = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>