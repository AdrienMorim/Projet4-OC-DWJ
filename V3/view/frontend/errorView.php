<?php $title = 'Erreur: ' . $errorMessage ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-page">
        <div class="nav col-lg-12">
            <?php include('../V3/view/inc/nav.php') ?>

            <?php if(isset($_SESSION['id'])) { ?>
                <p id="welcome">
                    <a href="../V3/index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>">Bonjour <?= $_SESSION['pseudo']; ?>
                    </a>
                </p>
            <?php } ?>
        </div>
        <div id="banner-title" class="col-lg-8 offset-lg-2 banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Nouveau Roman - Jean Forteroche</h2>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <article id="overview" class="row align-items-start">
        <div id="error" class="col-lg-8 offset-lg-2">
            <div class="text-center">
                <i class="fas fa-exclamation-triangle fa-5x"></i>
            </div><br/>
            <h3 class="text-center">
                Attention <?php if(isset($_SESSION['id'])) { echo $_SESSION['pseudo']; } ?>
            </h3>
            <hr/>
            <p class="text-center"><strong>Erreur: </strong><?= $errorMessage ?></p>
            <hr/>
        </div>
    </article>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>