<?php $title = 'Mise à jour du chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

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

<h3>Mise à jour du chapitre <?= htmlspecialchars($chapter['title']); ?></h3>

<form action="../V2_MVC/index.php?action=updateChapter&amp;id_chapter=<?= $_GET['id_chapter']; ?>" method="POST">
    <p>
        <label for="author"> Auteur
            <input type="text" name="author" id="author"/>
        </label>
    </p>
    <p>
        <label for="title"> Titre
            <input type="text" name="title" id="title"/>
        </label>
        <label for="content">Chapitre
            <textarea name="content" id="content" placeholder="Indiquez ici votre chapitre"></textarea>
        </label>
    </p>
    <button>
        <input type="submit" value="Mise à jour"/>
    </button>

</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
