<?php $title = 'Admin - Chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <?php include('navAdmin.php'); ?>

<?php $admin_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Admin - Billet simple pour l'Alaska</h1>
    <h2>Chapitre <?= htmlspecialchars($chapter['id']); ?></h2>

    <div class="news">
        <h3>
            <?= htmlspecialchars($chapter['title']); ?>
            <em>le <?= $chapter['creation_date_fr']; ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($chapter['content'])); ?> <br/>
        </p>
    </div>

    <h3>Commentaires</h3>

<?php

    while ($comment = $comments->fetch())
    {
        ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <em><a href="../V2_MVC/index.php?action=adminUpdateComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Mettre à jour le commentaire</a></em>
        <em><a href="../V2_MVC/index.php?action=deleteComment&amp;id_chapter=<?= $chapter['id'];?>&amp;id=<?= $comment['id'];?>">Supprimer le commentaire</a></em>
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
                    <?php var_dump($_SESSION['pseudo']);
                    var_dump($_COOKIE['pseudo']); ?>
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

<?php require('template.php'); ?>

