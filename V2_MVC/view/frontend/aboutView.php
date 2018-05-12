<?php $title = 'À propos - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <ul> <!-- avec emmet: ul>li*5>a +[TAB]-->
        <li>
            <a href="../V2_MVC/index.php">Accueil</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=about">À propos</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=listChapters">Chapitres</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=login">Inscription/Connexion</a>
        </li>
    </ul>

<?php $toggle_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2>À propos de l'auteur</h2>

<p> Lorem Ipsum </p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
