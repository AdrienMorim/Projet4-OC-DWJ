<?php $title = 'Dashbord Blog - Billet simple pour l\'Alaska'; ?>

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
            <h1 class="">Billet simple pour l'Alaska</h1>
            <h2>Bienvenue sur votre Dashbord</h2>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<div id="inner" class="container col">
    <div class="row col-lg-10 offset-lg-1">
        <div class="col-lg-6">

            <?php while ($data = $chapter->fetch()) { ?>
                <div id="last-chapter" class="card mb-3">
                    <div class="card-header">
                        <a class="btn" role="button" data-toggle="collapse" data-target="#collapseChapter" aria-expanded="true" aria-controls="collapseChapter">
                            <h5>Dernier chapitre</h5>
                            <!--<i class="fas fa-sort-up"></i>-->
                        </a>
                    </div>

                    <div id="collapseChapter" class="card-body collapse show">
                        <h5 class="card-title"> <?= htmlspecialchars($data['title']); ?><em> le <?= $data['creation_date_fr']; ?></em></h5>
                        <p class="card-text"> <?= nl2br(htmlspecialchars(substr($data['content'], 0, 80))); ?>...
                        </p>
                        <p class="card-link"><em><a class="btn btn-primary" href="index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></a></em>
                        </p>
                    </div>
                </div>
            <?php
            } // fin de la boucle des chapitres
            $chapter->closeCursor(); ?>

            <?php while ($data = $comment->fetch()) { ?>
                <div id="last-comment" class="card mb-3">
                    <div class="card-header">
                        <div class="btn" role="button" data-toggle="collapse" data-target="#collapseComment" aria-expanded="true" aria-controls="collapseComment">
                            <h5>Dernier commentaire </h5>
                            <!--<i class="fas fa-sort-up"></i>-->
                        </div>

                    </div>

                    <div id="collapseComment" class="card-body collapse show">
                        <h6 class="card-title"><strong><?= htmlspecialchars($data['author']); ?></strong> le <?= $data['comment_date_fr']; ?></h6>
                        <p class="card-text"><?= nl2br(htmlspecialchars($data['comment'])); ?></p>
                    </div>
                </div>
            <?php
            }
            $comment->closeCursor(); ?>
        </div> <!-- fin de la 1ere col-->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <a class="btn" role="button" data-toggle="collapse" data-target="#collapseNumber" aria-expanded="true" aria-controls="collapseNumber">
                        <h5>Votre Blog en quelques chiffres </h5>
                        <!--<i class="fas fa-sort-up"></i>-->
                    </a>
                </div>

                <div id="collapseNumber" class="card-body collapse show">
                    <ul class="card-text list-group list-group-flush">
                        <li class="list-group-item">
                            <a class="nav-link card-link" href="index.php?action=listChapters">
                                <p>Vous avez actuellement <?= $chaptersTotal['total_chapters']?> chapitres.</p>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a class="nav-link card-link " href="index.php?action=adminListComments">
                                <p>Vous avez actuellement <?= $commentsTotal['total_comments']?> commentaires.</p>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a class="nav-link card-link " href="index.php?action=adminCommentsReport">
                                <p>Vous avez actuellement <?= $commentsReportTotal['total_comments_report']?> commentaires signalés.</p>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a class="nav-link card-link " href="index.php?action=adminListUsers">
                                <p>Vous avez actuellement <?= $usersTotal['total_users']?> utilisateurs inscrits.</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> <!-- fin de la 2e col-->
    </div> <!-- fin de row-->
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/inc/template.php'); ?>