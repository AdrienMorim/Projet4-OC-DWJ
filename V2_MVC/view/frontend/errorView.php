<?php $title = 'Erreur !'; ?>

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
            <<a href="../V2_MVC/index.php?action=login">Inscription/Connexion</a>
        </li>
    </ul>

<?php $toggle_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2> Erreur :</h2>

<h3><?= $errorMessage ?></h3>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>