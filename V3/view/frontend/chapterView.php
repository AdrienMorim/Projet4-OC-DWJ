<?php $title = 'Chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

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
        <div id="banner-title" class="col-lg-6 offset-lg-3  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Nouveau Roman - Jean Forteroche</h2>
            <h3>Chapitre <?= htmlspecialchars($chapter['id']); ?></h3>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <div id="overview" class="row align-items-center">
        <div class="image-overview col-lg-4 offset-lg-1 align-self-center">
            <img src="../V3/public/images/alaska_3.jpg" alt="En route pour l'Alaska"/>
        </div>

        <div class="content-overview col-lg-6 align-self-center">
            <h3>
                <?= htmlspecialchars($chapter['title']); ?>
            </h3>
            <em class="text-muted">le <?= $chapter['creation_date_fr']; ?></em>
            <blockquote class="blockquote">
                <p>
                    <?= nl2br($chapter['content']); ?> <br/>
                </p>
                <footer class="blockquote-footer text-right">
                    <?= nl2br(htmlspecialchars($chapter['author'])); ?>
                </footer>
            </blockquote>
        </div>
    </div>

    <div id="inner" class="row justify-content-lg-center">
        <aside id="comment" class="card col-lg-8">
            <h3 class="card-header text-center align-item-center">
                <i class="fas fa-comments"></i> Commentaires
            </h3>
            <div class="row card-body">

                <?php $countComments = 0;
                while ($comment = $comments->fetch()) {

                    $countComments++ ?>

                    <p class="col-lg-12"><strong><?= htmlspecialchars($comment['author']) ?></strong></p>
                    <?php if($comment['comment_date_fr'] == $comment['update_date_fr']){ ?>
                            <p class="col-lg-6 text-muted">le <?= htmlspecialchars($comment['comment_date_fr']) ?></p>
                        <?php }
                        else { ?>
                            <p class="col-lg-6 text-muted">modifié le <?= htmlspecialchars($comment['update_date_fr']) ?></p>
                        <?php } ?>
                    <p class="col-lg-8"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                    <?php if (!isset($_SESSION['id_group'])) { ?>
                    <p class="col-lg-3 offset-lg-1 text-right">
                        <em>
                            <a href="../V3/index.php?action=report&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">Signaler
                                <i class="fas fa-bell"></i>
                            </a>
                        </em>
                    </p>
                        <?php
                        } // fin du if
                        elseif (isset($_SESSION) && $_SESSION['id_group'] == 2) {

                            if (($comment['author']) == $_SESSION['pseudo']) { ?>
                            <p class="col-lg-3 offset-lg-1">
                                <em class="">
                                    <a href="../V3/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">Éditer <i class="fas fa-comment-dots"></i>
                                    </a>
                                </em><br/>
                                <em class="">
                                    <a href="../V3/index.php?action=report&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">Signaler
                                        <i class="fas fa-bell"></i>
                                    </a>
                                </em>
                            </p>
                            <?php }
                            else { ?>
                            <p class="col-lg-3 offset-lg-1">
                                <em>
                                    <a href="../V3/index.php?action=report&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">Signaler
                                        <i class="fas fa-bell"></i>
                                    </a>
                                </em>
                            </p>
                            <?php }
                        } // fin du elseif
                        else { ?>
                        <p class="col-lg-3 offset-lg-1">
                            <em>
                                <a href="../V3/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">Éditer <i class="fas fa-comment-dots"></i>
                                </a>
                            </em><br/>
                            <em>
                                <a href="../V3/index.php?action=deleteComment&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">Supprimer <i class="fas fa-comment-slash"></i>
                                </a>
                            </em><br/>
                            <em>
                                <a href="../V3/index.php?action=approvedComment&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">Approuver <i class="fas fa-check-circle"></i>
                                </a>
                            </em>
                        </p>
                    <?php } // fin du else ?>
                <?php } //fin de la boucle while

                $comments->closeCursor();

                if($countComments == 0) { ?>
                    <p>
                        Aucun commentaire n'a été posté pour le moment...<br/>
                        Soyez le premier à en écrire un !
                    </p>
                <?php } ?>
                </div>
            </aside>

        <aside id="post" class="card col-lg-8">
            <form action="../V3/index.php?action=addComment&amp;id_chapter=<?= $_GET['id_chapter'];?>" method="POST">
                <div class="col-lg-12 card-header">
                    <h3 class="col-lg-6 offset-lg-4"> Ajouter votre commentaire:</h3>
                </div>
                <div class="col-lg-12 card-body">
                    <div class="form-group row">
                        <label for="author" class="col-lg-3">Auteur</label>
                        <div class="col-lg-9">
                            <input type="text" name="author" id="author" class="form-control" placeholder="Indiquez ici votre nom" value="<?php
                            if (isset($_SESSION['pseudo']))
                            {
                                echo htmlspecialchars($_SESSION['pseudo']);
                            }
                            ?>"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-lg-3">Commentaire</label>
                        <div class="col-lg-9">
                            <textarea name="comment" id="comment" class="form-control" placeholder="Indiquez ici votre commentaire"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 offset-lg-4">
                            <button type="submit" name="envoyer" class="btn btn-primary">Envoyer votre commentaire</button>
                        </div>
                    </div>
                </div>
            </form>
        </aside>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>

