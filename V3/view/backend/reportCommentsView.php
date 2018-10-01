<?php $title = 'Commentaires signalés - Billet simple pour l\'Alaska'; ?>

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
        <div id="banner-title" class="col-lg-8 col-md-10 col-8 offset-lg-2  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Commentaires signalés</h2>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="inner" class="container col">
        <div id="admin" class="col-lg-10 offset-lg-1">
            <div class="text-right col-lg-3 offset-lg-9">
                <a class="nav-link" href="../V3/index.php?action=adminListComments"><i class="far fa-comments"></i> Voir tous les commentaires</a>
            </div>
            <div id="table-blog" class="table-responsive col-lg-12">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr class="table-primary">
                        <th class="align-baseline" scope="col">Auteur</th>
                        <th class="align-baseline" scope="col">Date</th>
                        <th class="align-baseline" scope="col">Commentaire</th>
                        <th class="align-baseline text-center" scope="col"><i class="fas fa-comment-dots"></i></th>
                        <th class="align-baseline text-center" scope="col"><i class="fas fa-bell-slash"></i></th>
                        <th class="align-baseline text-center" scope="col"><i class="fas fa-minus-circle"></i></th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php while ($comment = $reportComments->fetch())
                        {
                            ?>
                            <tr>
                                <th class="align-middle"><?= htmlspecialchars($comment['author']) ?></th>
                                <td class="align-middle">le <?= $comment['comment_date_fr'] ?></td>
                                <td class="align-middle"><?= nl2br(htmlspecialchars($comment['comment'])) ?></td>
                                <td class="align-middle text-center">
                                    <a href="../V3/index.php?action=adminUpdateComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Éditer</a>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="../V3/index.php?action=approvedComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Approuver</a>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="../V3/index.php?action=deleteComment&amp;id_chapter=<?= $comment['id_chapter'];?>&amp;id=<?= $comment['id'];?>">Supprimer</a>
                                </td>
                            </tr>
                            <?php
                        }
                        $reportComments->closeCursor(); ?>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $nbPages; $i++){
                            if ($i == $current_page){
                                echo '<li class="page-item disabled"><a class="page-link" href="#"> ' . $i . ' </a></li>';
                            }else{
                                echo '<li class="page-item"><a class="page-link" href="../V3/index.php?action=adminCommentsReport&page=' . $i . '"> ' . $i . ' </a></li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>