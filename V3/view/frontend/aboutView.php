<?php $title = 'À propos - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-page">
        <div class="nav col-lg-12">
            <?php include('view/inc/nav.php') ?>

            <?php if(isset($_SESSION['id'])) { ?>
                <p id="welcome">
                    <a href="index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>">Bonjour <?= $_SESSION['pseudo']; ?>
                    </a>
                </p>
            <?php } ?>
        </div>
        <div id="banner-title" class="col-lg-8 col-md-10 col-8 offset-lg-2  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <!--<h2>Nouveau Roman - Jean Forteroche</h2>-->
            <h3>À propos de l'auteur</h3>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

<article id="overview" class="row align-items-start">
    <div class="image-overview col-lg-3 offset-lg-1">
        <img src="public/images/jeanForteroche.jpg" alt="photo de baleine en Alaska"/>
    </div>

    <div class="content-overview col-lg-7 align-self-center">
        <h3>Écrivain, Auteur masi avant tout passionné</h3>
        <blockquote class="blockquote">
            <p>Quam ob rem vita quidem talis fuit vel fortuna vel gloria, ut nihil posset accedere, moriendi autem sensum celeritas abstulit; quo de genere mortis difficile dictu est; quid homines suspicentur, videtis; </p>
            <p>hoc vere tamen licet dicere, P. Scipioni ex multis diebus, quos in vita celeberrimos laetissimosque viderit, illum diem clarissimum fuisse, cum senatu dimisso domum reductus ad vesperum est a patribus conscriptis, populo Romano, sociis et Latinis. </p>
            <p>Pridie quam excessit e vita, ut ex tam alto dignitatis gradu ad superos videatur deos potius quam ad inferos pervenisse.
            <p>Quam ob rem vita quidem talis fuit vel fortuna vel gloria, ut nihil posset accedere, moriendi autem sensum celeritas abstulit; quo de genere mortis difficile dictu est; quid homines suspicentur, videtis; </p>
            <p>hoc vere tamen licet dicere, P. Scipioni ex multis diebus, quos in vita celeberrimos laetissimosque viderit, illum diem clarissimum fuisse, cum senatu dimisso domum reductus ad vesperum est a patribus conscriptis, populo Romano, sociis et Latinis. </p>
            <p>Pridie quam excessit e vita, ut ex tam alto dignitatis gradu ad superos videatur deos potius quam ad inferos pervenisse.
            </p>
            <footer class="blockquote-footer text-right">
                Jean Forteroche
            </footer>
        </blockquote>
    </div>
</article>

<?php $content = ob_get_clean(); ?>

<?php require('view/inc/template.php'); ?>
