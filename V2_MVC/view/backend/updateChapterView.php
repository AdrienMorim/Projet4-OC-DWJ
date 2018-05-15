<?php $title = 'Mise à jour du chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V2_MVC/view/nav.php'); $menu = ob_get_clean(); ?>

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

<form action="../V2_MVC/index.php?action=updateChapter&amp;id_chapter=<?= $_GET['id_chapter']; ?>" method="POST">
    <p>
        <label for="author">Auteur</label>
        <input type="text" name="author" id="author" value="<?php
        if (isset($_COOKIE['pseudo']))
        {
            echo htmlspecialchars($_COOKIE['pseudo']);
        }
        ?>"
        />
    </p>
    <p>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title"/>
    </p>
    <p>
        <label for="content">Chapitre</label>
        <textarea name="content" id="content" placeholder="Indiquez ici votre chapitre"></textarea>
    </p>
    <button>
        <input type="submit" value="Éditer"/>
    </button>
</form>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); include('../V2_MVC/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>

