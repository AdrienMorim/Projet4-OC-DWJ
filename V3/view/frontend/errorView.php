<?php $title = 'Erreur: ' . $errorMessage ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Attention <?php if(isset($_SESSION['id'])) { echo $_SESSION['pseudo']; } ?></h2>
    <h3><i class="fas fa-exclamation-triangle fa-2x"></i></h3>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

<h3>Erreur: <?= $errorMessage ?></h3>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>