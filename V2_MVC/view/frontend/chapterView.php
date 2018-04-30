<?php $title = 'Chapitre ' . htmlspecialchars($chapter['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <ul> <!-- avec emmet: ul>li*5>a +[TAB]-->
        <li>
            <a href="../V2-MVC/index.php">Accueil</a>
        </li>
        <li>
            <a href="about.php">À propos</a>
        </li>
        <li>
            <a href="../V2-MVC/index.php?action=listChapters">Chapitres</a>
        </li>
        <li>
            <a href="register.php">Inscription</a>
        </li>
        <li>
            <a href="login.php">Connexion</a>
        </li>
    </ul>

<?php $toggle_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
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
    <?php
}

$comments->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<div class="news">
    <form action="../V2-MVC/index.php?action=addComment&amp;id_chapter=<?= $_GET['id_chapter'];?>" method="POST">
        <h3> Ajouter votre commentaire:</h3>
        <p>
            <label for="author">Auteur
                <input type="text" name="author" id="author" placeholder="Indiquez ici votre nom" value="<?php
                if (isset($_SESSION['author'])){
                    echo htmlspecialchars($_SESSION['author']);
                }?>"
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