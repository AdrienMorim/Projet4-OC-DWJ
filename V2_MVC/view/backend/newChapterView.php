<?php $title = 'Créer un nouveau Chapitre - Billet simple pour l\'Alaska'; ?>

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

<h3>Création d'un nouveau chapitre</h3>

<form action="../V2_MVC/index.php?action=createChapter" method="POST">
    <p>
        <label for="author"> Auteur
            <input type="text" name="author" id="author" value="<?php
            if (isset($_SESSION['author'])){
                echo htmlspecialchars($_SESSION['author']);
            }?>"
            />
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
        <input type="submit" value="Envoyer"/>
    </button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

