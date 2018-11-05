<?php $title = 'Jean Forteroche - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-index">
        <div class="nav col-lg-12">
            <?php include('view/inc/nav.php') ?>

            <?php if(isset($_SESSION['id'])) { ?>
                <p id="welcome">
                    <a href="index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>">Bonjour <?= $_SESSION['pseudo']; ?>
                    </a>
                </p>
            <?php } ?>
        </div>
        <div id="banner-title" class="col-lg-8 col-md-10 col-8 offset-lg-2 banner-title-index">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Nouveau Roman - Jean Forteroche</h2>
        </div>
        <div id="teaser" class="col-lg-8 offset-lg-2">
            <h3>Venez plonger au coeur de mon Blog</h3>
            <div id="arrow">
                <a href="#overview"><i class="fas fa-arrow-circle-down fa-3x"></i></a>
            </div>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <article id="overview" class="row justify-content-center">
        <div class="image-overview col-lg-4 align-self-center">
            <img src="public/images/alaska_1.jpg" alt="photo de baleine en Alaska"/>
        </div>

        <div class="content-overview col-lg-8 align-self-center">
            <h3>Aperçu du Roman</h3>
            <blockquote class="blockquote">
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

    <article id="inner" class="row justify-content-lg-center">
        <aside id="chapter" class="card col-lg-5">
            <h3 class="card-header">Dernier chapitre du blog</h3>
            <div class="card-body">
                <?php while ($data = $chapter->fetch()) { ?>
                <h4 class="card-subtitle">
                    <?= htmlspecialchars($data['title']); ?>
                </h4>
                <p class="text-muted">
                    <em>Publié le <?= $data['creation_date_fr']; ?></em>
                </p>
                <p class="card-text content-inner">
                    <?= nl2br(htmlspecialchars(substr($data['content'], 0, 80))); ?> ...
                </p>
                <p class="card-link"><em><a class="btn btn-primary" href="index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></a></em>
                </p>
                <?php
                } // fin de la boucle des chapitres
                $chapter->closeCursor(); ?>
            </div>
        </aside>

        <aside id="comment" class="card col-lg-5 offset-lg-1">
            <h3 class="card-header">Dernier commentaire</h3>
            <div class="card-body">
                <?php while ($data = $comment->fetch()) { ?>
                <p class="card-text"><strong><?= htmlspecialchars($data['author']); ?></strong>
                </p>
                <p class="text-muted">
                    <em>le <?= $data['comment_date_fr']; ?></em>
                </p>
                <p class="card-text content-inner"><?= nl2br(htmlspecialchars($data['comment'])); ?>
                </p>
                <?php
                }
                $comment->closeCursor(); ?>
            </div>
        </aside>
    </article>

<?php $content = ob_get_clean(); ?>

<?php require('view/inc/template.php'); ?>