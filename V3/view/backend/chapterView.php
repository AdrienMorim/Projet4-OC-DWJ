<?php $title = 'Chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V3/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Chapitre <?= htmlspecialchars($chapter['title']); ?></h2>

<?php $header = ob_get_clean(); ?>

    <div class="news">
        <h3>
            <?= htmlspecialchars($chapter['title']); ?>
            <em>le <?= $chapter['creation_date_fr']; ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($chapter['content'])); ?> <br/>
        </p>
    </div>
    <h3><i class="fas fa-comments"></i> Commentaires: </h3>
<?php

    while ($comment = $comments->fetch())
    {
        ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?><br/>
        <em><a href="../V3/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Éditer <i class="fas fa-comment-dots"></i></a></em>
        <em><a href="../V3/index.php?action=deleteComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Supprimer <i class="fas fa-comment-slash"></i></a></em>
        </p>
        <?php
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

<?php ob_start(); include('../V3/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V3/view/template.php'); ?>

