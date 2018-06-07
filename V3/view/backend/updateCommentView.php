<?php $title = 'Editer le commentaire ' . htmlspecialchars($comment['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V3/view/nav.php'); $menu = ob_get_clean(); ?>

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

<form action="../V3/index.php?action=updateComment&amp;id_chapter=<?= $_GET['id_chapter']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST">
    <div class="col-lg-12">
        <div class="form-group row">
            <label for="author" class="col-lg-3">Auteur</label>
            <div class="col-lg-9">
                <input type="text" name="author" id="author" class="form-control" placeholder="Indiquez ici votre nom" value="<?= htmlspecialchars($comment['author']); ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-lg-3">Commentaire</label>
            <div class="col-lg-9">
                <textarea name="comment" id="comment" class="form-control" placeholder="<?= htmlspecialchars($comment['comment']); ?>"></textarea>
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

<?php ob_start(); include('../V3/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V3/view/template.php'); ?>