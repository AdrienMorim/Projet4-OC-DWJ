<?php $title = 'Mise à jour du chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V3/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2>Éditer le chapitre: <?= htmlspecialchars($chapter['title']); ?></h2>

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

<form action="../V3/index.php?action=updateChapter&amp;id_chapter=<?= $_GET['id_chapter']; ?>" method="POST">
    <div class="col-lg-12">
        <div class="form-group row">
            <label for="author" class="col-lg-3">Auteur</label>
            <div class="col-lg-9">
                <input type="text" name="author" id="author" class="form-control" value="<?php
                if (isset($_SESSION['pseudo']))
                {
                    echo htmlspecialchars($_SESSION['pseudo']);
                }
                ?>"
                />
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-lg-3">Titre</label>
            <div class="col-lg-9">
                <input type="text" name="title" class="form-control" id="title" placeholder="Indiquez ici votre titre"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-lg-3">Chapitre</label>
            <div class="col-lg-9">
                <textarea name="content" id="content" class="form-control" placeholder="Indiquez ici votre chapitre"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-9">
                <button type="submit" name="envoyer" class="btn btn-primary">Envoyer</button>
            </div>
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); include('../V3/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V3/view/template.php'); ?>

