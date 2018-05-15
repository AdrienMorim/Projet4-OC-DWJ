<?php $title = 'Chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V2_MVC/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Chapitre <?= htmlspecialchars($chapter['title']); ?></h2>

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
    <h3><i class="fas fa-comments"></i> Commentaires: </h3>
<?php

    while ($comment = $comments->fetch())
    {
        ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?><br/>
        ( <em><a href="../V2_MVC/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Éditer <i class="fas fa-comment-dots"></i></a></em>,
        <em><a href="../V2_MVC/index.php?action=deleteComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Supprimer <i class="fas fa-comment-slash"></i></a></em> )
        </p>
        <?php
    }

    $comments->closeCursor();
?>

    <div class="news">
        <form action="../V2_MVC/index.php?action=addComment&amp;id_chapter=<?= $_GET['id_chapter'];?>" method="POST">
            <h3> Ajouter votre commentaire:</h3>
            <p>
                <label for="author">Auteur
                    <input type="text" name="author" id="author" placeholder="Indiquez ici votre nom" value="<?php
                    if (isset($_COOKIE['pseudo']))
                    {
                        echo htmlspecialchars($_COOKIE['pseudo']);
                    }
                    ?>"
                    />
                </label>
            </p>
            <p>
                <label for="comment">Commentaire
                    <textarea name="comment" id="comment" placeholder="Indiquez ici votre commentaire"></textarea>
                </label>
            </p>
            <button>
                <input type="submit" value="Envoyer votre commentaire"/>
            </button>
        </form>
    </div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); include('../V2_MVC/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>

