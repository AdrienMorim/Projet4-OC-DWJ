<?php $title = 'Chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Chapitre <?= htmlspecialchars($chapter['id']); ?></h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <div class="news">
        <h3>
            <?= htmlspecialchars($chapter['title']); ?>
            <em>le <?= $chapter['creation_date_fr']; ?></em>
        </h3>
        <p>
            <?= nl2br(htmlspecialchars($chapter['content'])); ?> <br/>
        </p>
    </div>
    <h3><i class="fas fa-comments"></i> Commentaires</h3>
<?php

    while ($comment = $comments->fetch())
    {
        ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <?php

        if(!isset($_SESSION['id_group'])) {
            ?>
                <em><a href="../V3/index.php?action=report&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Signaler <i class="fas fa-bell"></i></a></em>
            <?php
        }
        elseif(isset($_SESSION) && $_SESSION['id_group'] == 2){
            ?>
            <em><a href="../V3/index.php?action=report&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Signaler <i class="fas fa-bell"></i></a></em>
            <em><a href="../V3/index.php?action=userUpdateComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Éditer <i class="fas fa-comment-dots"></i></a></em>
            <?php
        }
        else{
        ?>
            <em><a href="../V3/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Éditer <i class="fas fa-comment-dots"></i></a></em>
            <em><a href="../V3/index.php?action=deleteComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Supprimer <i class="fas fa-comment-slash"></i></a></em>
            <em><a href="../V3/index.php?action=approvedComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Approuver <i class="fas fa-check-circle"></i></a></em>

        <?php
        }
    }

    $comments->closeCursor();
?>

    <h3> Ajouter votre commentaire:</h3>
    <form action="../V3/index.php?action=addComment&amp;id_chapter=<?= $_GET['id_chapter'];?>" method="POST">
        <div class="col-lg-12">
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
                <div class="col-lg-12">
                    <button type="submit" name="envoyer" class="btn btn-primary">Envoyer votre commentaire</button>
                </div>
            </div>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>

