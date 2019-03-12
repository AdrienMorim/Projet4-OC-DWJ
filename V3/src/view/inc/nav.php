
<div id="navbar-body">
    <div id="navbar-overlay"></div>
    <div id="navbar-button" class="row">
        <h4 class="nav-link button-icon"><a id="icon-link" href="#"><i id="icon-button" class="fas fa-bars"></i></a></h4>
        <h4 class="nav-link button-title">MENU</h4>
    </div>
    <div id="navbar-content">

    <?php

    if(isset($_SESSION['id']) && $_SESSION['id_group'] == 1)
    {
        ?>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item nav-toggle">
                <a class="nav-link " href="../V3/index.php?action=dashbord"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=home"><i class="fas fa-home"></i> Accueil Visiteur</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=about"><i class="fas fa-chalkboard-teacher"></i> À propos</a>
            </li>
            <li class="nav-item dropright nav-toggle">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-edit"></i> Chapitres</a>
                <div class="dropdown-menu">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../V3/index.php?action=listChapters"><i class="far fa-list-alt"></i> Tous les chapitres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../V3/index.php?action=adminNewChapter"><i class="fas fa-pencil-alt"></i> Créer un chapitre</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropright nav-toggle">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-comment"></i> Commentaires</a>
                <div class="dropdown-menu">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../V3/index.php?action=adminListComments"><i class="far fa-comments"></i> Tous les Commentaires</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../V3/index.php?action=adminCommentsReport"><i class="far fa-bell"></i> Commentaires signalés</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item dropright nav-toggle">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i> Paramètres</a>
                <div class="dropdown-menu">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../V3/index.php?action=adminListUsers"><i class="fas fa-users"></i> Liste des utilisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../V3/index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>"><i class="fas fa-user-cog"></i> Mes paramètres</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=logout"><i class="fas fa-user-times"></i> Déconnexion</a>
            </li>
        </ul>
    <?php
    }
    elseif (isset($_SESSION['id']) && $_SESSION['id_group'] == 2)
    {
        ?>
        <ul class="nav flex-column">
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php"><i class="fas fa-home"></i> Accueil</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=about"><i class="fas fa-chalkboard-teacher"></i> À propos</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=listChapters"><i class="far fa-newspaper"></i> Chapitres</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>"><i class="fas fa-cog"></i> Mon profil</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=logout"><i class="fas fa-user-times"></i> Déconnexion</a>
            </li>
        </ul>
    <?php
    }
    else
    {
        ?>
        <ul class="nav flex-column">
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php"><i class="fas fa-home"></i> Accueil</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=about"><i class="fas fa-chalkboard-teacher"></i> À propos</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=listChapters"><i class="far fa-newspaper"></i> Chapitres</a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link" href="../V3/index.php?action=login"><i class="fas fa-user-alt"></i> Inscription / Connexion</a>
            </li>
        </ul>
    <?php
    }
    ?>

    </div>
</div>
