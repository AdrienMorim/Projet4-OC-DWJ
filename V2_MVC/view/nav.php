<?php

if(isset($_SESSION['id']) && $_SESSION['id_group'] == 1)
{
    ?>
    <ul>
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
            <a href="../V2_MVC/index.php?action=#">Administration des membres</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php">Accueil Visiteur</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=about">À propos</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=listChapters">Chapitres</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=adminParametre">Paramètres</a>
        </li>
    </ul>
    <ul>
        <li>
            <a href="../V2_MVC/index.php?action=logout">Déconnexion</a>
        </li>
    </ul>
<?php
}
elseif (isset($_SESSION['id']) && $_SESSION['id_group'] == 2)
{
    ?>
    <ul>
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
            <a href="../V2_MVC/index.php?action=parametres">Paramètres</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=logout">Déconnexion</a>
        </li>
    </ul>
<?php
}
else
{
    ?>
    <ul>
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
<?php
}
