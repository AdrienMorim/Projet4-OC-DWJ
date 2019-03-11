<?php $title = 'Chapitre ' . $chapter['id'] . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-page">
        <div class="nav col-lg-12">
            <?php include('view/inc/nav.php') ?>

            <?php if(isset($_SESSION['id'])) { ?>
                <p id="welcome">
                    <a href="../V3/index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>"><?= 'Bonjour ' . $_SESSION['pseudo']; ?>
                    </a>
                </p>
            <?php } ?>
        </div>
        <div id="banner-title" class="col-lg-8 col-md-10 col-8 offset-lg-2  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <!--<h2>Nouveau Roman - Jean Forteroche</h2>-->
            <h3>Chapitre <?= $chapter['id']; ?></h3>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <div id="overview" class="row align-items-center">
        <div class="image-overview col-lg-4 offset-lg-1 col-md-6 offset-md-3 align-self-center">
            <img src="public/images/alaska_3.jpg" alt="En route pour l'Alaska"/>
        </div>

        <div class="content-overview col-lg-6 align-self-center">
            <h3>
                <?= $chapter['title']; ?>
            </h3>
            <em class="text-muted">le <?= $chapter['creation_date_fr']; ?></em>
            <blockquote class="blockquote">
                <p>
                    <?= $chapter['content']; ?> <br/>
                </p>
                <footer class="blockquote-footer text-right">
                    <?= $chapter['author']; ?>
                </footer>
            </blockquote>
        </div>
    </div>

    <div id="inner" class="row justify-content-lg-center">
        <aside id="comment" class="card col-lg-8">
            <h3 class="card-header text-center align-item-center">
                <i class="fas fa-comments"></i> Commentaires
            </h3>
            <div class="card-body">

                <?php $countComments = 0;
                while ($comment = $comments->fetch()) {

                    $countComments++ ?>
                    <div class="row author-report-comments">
                        <p class="col-xl-6 col-lg-4 col-md-4 col-6"><strong><?= strip_tags(htmlspecialchars_decode($comment['author'])); ?></strong></p>
                    <?php if (!isset($_SESSION['id_group'])) { ?>
                        <p class="col-xl-6 col-lg-8 col-md-8 col-6 text-right">
                            <em>
                                <a href="../V3/index.php?action=report&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">
                                    <span class="admin">Signaler</span>
                                    <i class="fas fa-bell"></i>
                                </a>
                            </em>
                        </p>
                        <?php
                        } // fin du if
                        elseif (isset($_SESSION['id']) && $_SESSION['id_group'] == 2) {

                            if (($comment['author']) == $_SESSION['pseudo']) { ?>
                            <p class="col-xl-6 col-lg-8 col-md-8 col-6 text-right">
                                <em>
                                    <a href="../V3/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">
                                        <span class="admin">Éditer</span>
                                        <i class="fas fa-comment-dots"></i>
                                    </a>
                                </em><br/>
                            </p>
                            <?php }
                            else { ?>
                            <p class="col-xl-6 col-lg-8 col-md-8 col-6 text-right">
                                <em>
                                    <a href="../V3/index.php?action=report&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">
                                        <span class="admin">Signaler</span>
                                        <i class="fas fa-bell"></i>
                                    </a>
                                </em>
                            </p>
                            <?php }
                        } // fin du elseif
                        else { ?>
                        <p class="col-xl-6 col-lg-8 col-md-8 col-6 text-right">
                            <span class="row no-gutters">
                                <em class="col-lg-4 col-4">
                                    <a href="../V3/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">
                                        <span class="admin">Éditer</span>
                                        <i class="fas fa-comment-dots"></i>
                                    </a>
                                </em><br/>
                                <em class="col-lg-4 col-4">
                                    <a href="../V3/index.php?action=deleteComment&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">
                                        <span class="admin">Supprimer</span>
                                        <i class="fas fa-comment-slash"></i>
                                    </a>
                                </em><br/>
                                <em class="col-lg-4 col-4">
                                    <a href="../V3/index.php?action=approvedComment&amp;id_chapter=<?= $chapter['id']; ?>&amp;id=<?= $comment['id']; ?>">
                                        <span class="admin">Approuver</span>
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                </em>
                            </span>
                        </p>
                    <?php } // fin du else ?>
                    </div>
                    <div class="row date-comment-comments">
                        <?php if($comment['comment_date_fr'] == $comment['update_date_fr']){ ?>
                            <p class="col-lg-6 text-muted">le <?= $comment['comment_date_fr']; ?></p>
                        <?php }
                        else { ?>
                            <p class="col-lg-6 text-muted">modifié le <?= $comment['update_date_fr']; ?></p>
                        <?php } ?>
                        <p class="col-lg-8"><?= strip_tags(htmlspecialchars_decode($comment['comment'])); ?></p>
                    </div>
                    <hr>
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
            <form action="index.php?action=addComment&amp;id_chapter=<?= $chapter['id'];?>" method="POST">
                <div class="col-lg-12 card-header">
                    <h3 class="col-lg-6 offset-lg-4"> Ajouter votre commentaire:</h3>
                </div>
                <div class="col-lg-12 card-body">
                    <div class="form-group row">
                        <label for="author" class="col-lg-3">Auteur</label>
                        <div class="col-lg-9">
                            <input type="text" name="author" id="author" class="form-control" placeholder="Indiquez ici votre nom" value="<?php
                            if (isset($_SESSION['id']))
                            {
                                echo $_SESSION['pseudo'];
                            }
                            ?>"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comment" class="col-lg-3">Commentaire</label>
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

<?php require('view/inc/template.php'); ?>

