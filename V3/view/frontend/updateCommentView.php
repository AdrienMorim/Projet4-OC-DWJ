<?php $title = 'Mise à jour du commentaire ' . htmlspecialchars($comment['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Éditer le commentaire de: </h2>
    <p><?= htmlspecialchars($comment['author']); ?><em> du <?= htmlspecialchars($comment['comment_date_fr']); ?></em><br/>
        <?= htmlspecialchars($comment['comment']); ?> </p>

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

    <form action="../V3/index.php?action=editComment&amp;id_chapter=<?= $_GET['id_chapter']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST">
        <p>
            <label for="author">Auteur
                <input type="text" name="author" id="author" value="<?= htmlspecialchars($comment['author']); ?>"/>
            </label>
        </p>
        <p>
            <label for="comment">Commentaire
                <textarea name="comment" id="comment" placeholder="<?= htmlspecialchars($comment['comment']); ?>"></textarea>
            </label>
        </p>
        <button>
            <input type="submit" value="Mise à jour du commentaire"/>
        </button>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>