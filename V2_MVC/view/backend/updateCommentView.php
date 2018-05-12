<?php $title = 'Mise à jour du commentaire ' . htmlspecialchars($comment['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<ul> <!-- avec emmet: ul>li*5>a +[TAB]-->
    <li>
        <a href="../V2_MVC/index.php?action=dashbord">Tableau de bord</a>
    </li>
    <li>
        <a href="../V2_MVC/index.php?action=adminListChapters">Administration des chapitres</a>
    </li>
    <li>
        <a href="../V2_MVC/index.php?action=adminListComments">Administration des commentaires</a>
    </li>
    <li>
        <a href="../V2_MVC/index.php?action=logout">Déconnexion</a>
    </li>
</ul>

<?php $admin_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Admin - Billet simple pour l'Alaska</h1>
<h2>Nouveau Roman - Jean Forteroche</h2>

<div class="news">
    <h3>
        <?= htmlspecialchars($chapter['title']); ?>
        <em>le <?= $chapter['creation_date_fr']; ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($chapter['content'])); ?> <br/>
    </p>
</div>

<h3>Mise à jour du commentaire de <?= htmlspecialchars($comment['author']); ?>
    <em>du <?= htmlspecialchars($comment['comment_date_fr']); ?></em></h3>

<p> <?= htmlspecialchars($comment['comment']); ?> </p>

<form action="../V2_MVC/index.php?action=updateComment&amp;id_chapter=<?= $_GET['id_chapter']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST">
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

<?php require('template.php'); ?>